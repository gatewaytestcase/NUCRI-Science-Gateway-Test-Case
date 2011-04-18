<?php
require_once('libphp/nusoap.php');
require_once('libphp/Properties.php');
require_once('libphp/twitterUpdate.php');

ini_set('error_reporting', E_ALL | E_STRICT);
error_reporting(E_ALL  | E_STRICT);
ini_set("log_errors" , "1");
ini_set("error_log" , "/tmp/dms.log");
ini_set("display_errors" , "0");

header('Content-type: text/plain');

$myhome = isset($_ENV['SIMPLEGRID_HOME'])?$_ENV['SIMPLEGRID_HOME']:"/opt/simpletest";
$myconfig = new Properties();
$myconfig->load(file_get_contents($myhome . '/etc/simplegrid.properties'));
// service URL
$dmsServiceHandle = $myconfig->getProperty('app.dms.serviceurl');
// database config
$dbhost = $myconfig->getProperty('db.host');
$dbuser = $myconfig->getProperty('db.user');
$dbpass = $myconfig->getProperty('db.pass');
$dbname = $myconfig->getProperty('db.db');
// data config
$rootdir = realpath('.');
$datasetdir = 'datasets';
$resultdir = 'results';
$resourcedir = 'resources';
$imagedir = 'images';
$bndfile = 'bnd_uspolygon.dat';
// url config
$rooturl = 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['SCRIPT_NAME']);

function dmsNew($jname, $rx, $ry, $k, $inputData) {
	$now = date("Y-m-d H:i:s");
	$now2 = time();
	if (empty($jname)) {
		$jname = "default";
	}
	$jid = $jname . $now2;
	$rxx = (int) $rx;
	$ryy = (int) $ry;
	$kk = (int) $k;

	// submit job to grid
	global $username, $dmsServiceHandle, $rootdir, $rooturl, $datasetdir, $resultdir, $imagedir, $bndfile;
	$client = new nusoap_client($dmsServiceHandle, true);
	
	global $dbhost, $dbuser, $dbpass, $dbname;
	$dbconn = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
	mysql_select_db($dbname) or die(mysql_error());
	
	$sql = "SELECT name FROM dms ORDER BY name";
	$results = mysql_query($sql);
	while($row = mysql_fetch_object($results)) {
		if(strcasecmp($row->name,$jname)==0)
			return "failed: error job name already exists";
	}
	// Call the SOAP method
	$result = $client->call('submit', array(
	   'args0' => $jid,
	   'args1' => $rootdir . '/' . $datasetdir . '/' . $inputData,
	        ));
	
	if ($client->fault || $client->getError() || preg_match('/failed|error/', $result['return']) ) {
        return "failed: error calling gisolve job submission service";
    }
    
    $gridjobid = $result['return'];
	$newstatus = "submitted";
	// update db
	
	$sql = "INSERT INTO dms VALUES ('$jid','$jname',$rxx, $ryy, '$k', '$inputData', '', '$now', '$username', '$newstatus', '$gridjobid', '', 0)";
	$results = mysql_query($sql);
	if (!$results) {
		return "failed: insert error on " . $sql . "\n" . mysql_error();
	}
	
	mysql_close($dbconn);
	//twitterUpdate($username . ' submitted a new DMS analysis ('. $jid . ') on dataset '. $inputData . " to TeraGrid");
	return "success";
}
function dmsDelete($jobid = null, $username = '') {
	global $dbhost, $dbuser, $dbpass, $dbname;
	$dbconn = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
	mysql_select_db($dbname) or die(mysql_error());
	//$sql = "DELETE FROM dms WHERE id='$jobid'";
	$sql = "UPDATE dms SET dirty=1 WHERE id='" . $jobid . "' and user='" . $username . "'";
	$results = mysql_query($sql);
	if (!$results) {
		return "failed: delete error on " . $sql . "\n" . mysql_error();
	}
	mysql_close($dbconn);
	return "success";
}
function dmsRefresh($idlist) {
	global $dbhost, $dbuser, $dbpass, $dbname;
	$dbconn = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
	mysql_select_db($dbname) or die(mysql_error());
	
	if (empty($idlist)) {
		$idarray = array();
		$sql = "SELECT id FROM dms";
		$results = mysql_query($sql);
		if (!$results) {
			return "failed: select error on " . $sql . "\n" . mysql_error() . "\n";
		}
		while (($row = mysql_fetch_assoc($results))){
			$idarray[] = $row['id'];
		}
	} else {
		$idarray = explode(',', $idlist);
	}
	// update job status
	
	global $username, $dmsServiceHandle, $rootdir, $rooturl, $datasetdir, $resultdir, $resourcedir, $imagedir, $bndfile;
	$msg = "";
	foreach ($idarray as $jid) {
		// look at status in db first
		$sql = "SELECT id,k,status,gridjobid FROM dms WHERE id='$jid'";
		$results = mysql_query($sql);
		if (!$results) {
			$msg .= "failed[".$jid."]: select error on " . $sql . "\n" . mysql_error() . "\n";
		}
		$status = "";
		if (($row = mysql_fetch_assoc($results))) {
			$status = $row['status'];
		} else {
			$msg .= "failed[".$jid."]: job not found, job id=" . $jid . "\n";
		}
		if (!empty($status) && !preg_match("/failed|error/", $status) && $status != "finished")	{
			// Call the SOAP method to update status for unfinished jobs
			$client = new nusoap_client($dmsServiceHandle, true);
			$result = $client->call('getStatus', array(
			   'args0' => $row['gridjobid']
			        ));
			if ($client->fault || $client->getError() || preg_match('/failed|error/', $result['return']) ) {
                            if(preg_match('/socket read of headers timed out/i',$client->getError()) && strlen($status) > 0) {
                                $newstatus='finished';
                            }
                            else {
                                $msg .= "failed[".$jid."]: error retrieving job status" . "\n";
                            }
                        }
                        else {
                            $newstatus = $result['return'];
                        }

		    // update status if different from previous
			if ($newstatus != $status) {
				// if finished, get result url
				$sql_update_output="";
				if ($newstatus == "finished") {
					twitterUpdate($username . ' finished a DMS analysis ('. $jid . ') on TeraGrid');
					$resultfilename = $jid . '.dat';
					$result = $client->call('getResult', array(
					   'args0' => $jid,
					   'args1' => $row['gridjobid'],
					   'args2' => $rootdir . '/' . $resultdir . '/' . $resultfilename
					        ));
					$resulturl = $rooturl . '/' . $resultdir . '/' . $resultfilename;
					if ($client->fault || $client->getError() || preg_match('/failed|error/', $result['return']) ) {
				        $msg .= "failed [".$jid."]: error getting job output handle" . "\n";
				    } else {
				    	$sql_update_output = ",outputdata='$resulturl'";
				    	// visualize result
				    	$imagefilename = $jid . '.jpg';
				    	$result = $client->call('visualize', array(
						   'args0' => $rootdir . '/' . $resultdir . '/' . $resultfilename,
						   'args1' => $rootdir . '/' . $resourcedir . '/' . $bndfile,
						   'args2' => $rootdir . '/' . $imagedir . '/' . $imagefilename
					        ));
					    $imageurl = $rooturl . '/' . $imagedir . '/' . $imagefilename;
					    $sql_update_viz = ",image='$imageurl'";
				    }
				    twitterUpdate($username . ' has published the result of DMS analysis ('. $jid .')');
				}
				$sql = "UPDATE dms SET status='".$newstatus."'".$sql_update_output.$sql_update_viz." WHERE id='$jid'";
				$results2 = mysql_query($sql);
				if (!$results2) {
					$msg .= "failed [".$jid."]: select error on " . $sql . "\n" . mysql_error() . "\n";
				}
			}
		}
	}
	mysql_close($dbconn);
	return (empty($msg)?"success":$msg);
}
function dmsList() {
	global $dbhost, $dbuser, $dbpass, $dbname;
	$dbconn = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
	mysql_select_db($dbname) or die(mysql_error());
	$results = mysql_query("SELECT * FROM dms WHERE dirty=0");

	while (($row = mysql_fetch_assoc($results))){
		//$ks = split(",",$row['k']);
		print $row['id']."\t".$row['name']."\t".$row['resolutionx']."\t".$row['resolutiony']."\t".$row['k']."\t".$row['inputdata']."\t".$row['outputdata']."\t".$row['date']."\t".$row['user']."\t".$row['status']."\t".$row['gridjobid']."\t".$row['image']."\n";
	}
	mysql_close($dbconn);
	
}
function isValid($username = "") {
	global $dbhost, $dbuser, $dbpass, $dbname;
	// in real world, we need to validate user's session
	if (empty($username)) {
		return false;
	} else {
		$dbconn = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
		mysql_select_db($dbname) or die(mysql_error());
		$num = 0;
		$results = mysql_query("SELECT * FROM user WHERE uid='" . $username . "'");
		if ($results) {
			$num = mysql_num_rows($results);
		}
		mysql_close($dbconn);
		if ($num <= 0) {
			return false;
		} else {
			return true;
		}
	}
}
/* main */


$action = html_entity_decode(urldecode($_GET['command']));
$username = html_entity_decode(urldecode($_GET['uid']));
if (isValid($username) || $action == 'list' || empty($action)) {
	switch ($action) {
		case 'new':
			$jname = $username . '_' . html_entity_decode(urldecode($_GET['jname']));
			$rx = html_entity_decode(urldecode($_GET['resolutionx']));
			$ry = html_entity_decode(urldecode($_GET['resolutiony']));
			$k = html_entity_decode(urldecode($_GET['k']));
			$inputdata = html_entity_decode(urldecode($_GET['inputData']));
			print dmsNew($jname, $rx, $ry, $k, $inputdata);
			
			break;
		case 'delete':
			$did = html_entity_decode(urldecode($_GET['jobId']));
			print dmsDelete($did, $username);
			break;
		case 'refresh':
			// update status first
			$jlist = html_entity_decode(urldecode($_GET['jobList']));
			$rrr = dmsRefresh($jlist);
			/* do not return list here, browser will load it automatically
			if ($rrr == "success") {
				dmsList();
			} else {
				print $rrr;
			}if (empty($idlist)) {
			*/
			print $rrr;
			break;
		case 'list':
		default:
			dmsList(); // print is inside of this func
			break;
	}
} else {
	print "failed: please login first!";
}
	

?>
