<?php
session_start();

require_once('libphp/Properties.php');

$myhome = isset($_ENV['SIMPLEGRID_HOME'])?$_ENV['SIMPLEGRID_HOME']:"/opt/simplegrid2";
$myconfig = new Properties();
$myconfig->load(file_get_contents($myhome . '/etc/simplegrid.properties'));
// database config
$dbhost = $myconfig->getProperty('db.host');
$dbuser = $myconfig->getProperty('db.user');
$dbpass = $myconfig->getProperty('db.pass');
$dbname = $myconfig->getProperty('db.db');
$dbtable = "user";

function loginUser($user = array()) {
	global $dbhost, $dbuser, $dbpass, $dbname, $dbtable;
	$dbconn = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
	mysql_select_db($dbname) or die(mysql_error());
	$results = mysql_query("SELECT password FROM ".$dbtable." WHERE uid='".$user['uid']."'");

	$row = mysql_fetch_assoc($results);
	if (!$row) {
		mysql_close($dbconn);
		return "failed: User ".$user['uid']." does NOT exist. Please register first!";
	} else {
		$pass2 = $row['password'];
		if (md5($user['password']) != $pass2) {
			mysql_close($dbconn);
			return "failed: User ID or password ".$user['uid']." does NOT match our record. Please try again!";
		}
	}
	//TODO: create session for the user
	//TODO: update user table for login time

$_SESSION['user']=$user['uid'];
$_SESSION['password']=$pass2;
	mysql_close($dbconn);
	return "success=".$user['uid'];
}

/* main */
header('Content-type: text/plain');
$action = html_entity_decode(urldecode($_POST['command']));
switch ($action) {
	case 'login':
		$user = array();
		$user['uid'] = html_entity_decode(urldecode($_POST['uid']));
		$user['password'] = html_entity_decode(urldecode($_POST['password']));
		print loginUser($user);
		break;
	case 'logout':
		$user = array();
		$user['uid'] = html_entity_decode(urldecode($_POST['uid']));
		print "success"; // nothing to at server side for now
		break;
	default:
		print "success"; // print is inside of this func
		break;
}
	

?>
