<?php
session_set_cookie_params(0);
session_start();
if(isset($_SESSION['user']) && strlen($_SESSION['user']) > 0) {
	$user = $_SESSION['user'];	
	$password = $_SESSION['password'];
}
else {
	$user = '';
	$password='';
}

?>

<!--
<?php
//retrieve session data
echo $user = $_SESSION['user'];
?>
-->



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>SimpleGrid 2.0</title>
<style type="text/css">
/*margin and padding on body element
  can introduce errors in determining
  element position and are not recommended;
  we turn them off as a foundation for YUI
  CSS treatments. */
body {
	margin:0;
	padding:0;
}

</style>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/container/assets/skins/sam/container.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/reset-fonts-grids/reset-fonts-grids.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/menu/assets/skins/sam/menu.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/resize/assets/skins/sam/resize.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/layout/assets/skins/sam/layout.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/button/assets/skins/sam/button.css" />
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/yahoo/yahoo-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/utilities/utilities.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/container/container_core-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/container/container-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/resize/resize-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/layout/layout-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/button/button-min.js"></script>

<!-- begin: google map overlay support -->
<!--cigi
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAASpvywBJfnraJgUWw9G7HzxTxbb4qqy26YI4q6R4LKRUP50jTXhQvm726JCaaj5CwbtSL0LHPNcX-uQ" type="text/javascript"></script> 
-->
<!--quarry --> 
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAASpvywBJfnraJgUWw9G7HzxRMxKYdGeke-GB44l1JpCYe8B1EVhSqiK4RptVzGmD86tCN78YgTQ6cgQ" type="text/javascript"></script>
<!-- -->
<!-- NCSA
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAASpvywBJfnraJgUWw9G7HzxQY5ULES1MY_fnb7A6_PCxryWfy1BT27GLDiG_gB6ED6oga7v8j55bQWg" type="text/javascript"></script>
  -->
<script type="text/javascript" src="./lib/gisolverlay_google.js"></script>
<!-- end: google map overlay support -->

<!-- begin: datatable includes -->
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/datatable/assets/skins/sam/datatable.css" />
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/element/element-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/connection/connection-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/datatable/datatable-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/json/json-min.js"></script>

<style type="text/css">
/* custom styles for this example */
.yui-skin-sam .yui-dt-body { cursor:pointer; } /* when rows are selectable */
#single { margin-top:2em; }
#dmsbuttons {

    border: 0px groove #ccc;
    margin: .5em;
    padding: .5em;

}
</style>
<!-- end: datatable includes -->

<!-- begin: dialog and overlay style -->
<style>
#example {height:30em;}
label { display:block;float:left;width:45%;clear:left; }
.clear { clear:both; }
#dialog-status {
    text-align: center;
    color:#f5f5f5;
    background: #a52a2a;
}
</style>
<!-- end: dialog and overlay style -->

<style>
    #productsandservices2 {        
        position: static;
    }

    /*
        For IE 6: trigger "haslayout" for the anchor elements in the root Menu by 
        setting the "zoom" property to 1.  This ensures that the selected state of 
        MenuItems doesn't get dropped when the user mouses off of the text node of 
        the anchor element that represents a MenuItem's text label.
    */

    #productsandservices2 .yuimenuitemlabel {
        _zoom: 1;
    }

    #productsandservices2 .yuimenu .yuimenuitemlabel {
        _zoom: normal;
    }
    /*
        Turn off the border on the top unit since Menu has it's own border
    */
    .yui-skin-sam .yui-layout .yui-layout-unit-top div.yui-layout-bd {
        border: none;
    }
    /*
        Change some of the Menu colors
    */
    .yui-skin-sam .yuimenu .bd {
        background-color: #F2F2F2;
    }
    #productsandservices2 .bd {
        border: none;
    }
    #productsandservices2 .bd .first-of-type .bd {
        border: 1px solid #808080;
    }
</style>

<!-- begin: google mapping functions -->

<!-- end: google mapping functions -->

<!-- begin: drag & drop features -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.1/build/dragdrop/dragdrop-min.js"></script>
<script type="text/javascript">
	var joblistdd, mapdd;
	var joblist_pos;
</script>
<style type="text/css">
#gisolve-viz-proxy {
	background:url(./images/viz-proxy.png) 0 0 no-repeat;
    border:0px solid black;
    z-index:10;
    cursor:default;
    width: 80px;
    height: 40px;
    visibility: hidden; 
    text-align: center;
    color:#f5f5dc;
}
</style>
<!-- end: drag & drop features -->

<!-- begin: gisolve service interaction features -->
<style type="text/css">
#gisolve-service-status {
    visibility: hidden; 
    text-align: center;
    color:#f5f5dc;
}
#gisolve-service-busy {
    text-align: center;
    color:#f5f5f5;
    background: #a52a2a;
}
#usr-dialog-warning {
    text-align: center;
    color:#f5f5f5;
    background: #a52a2a;
}
#usr-login-dialog-warning {
    text-align: center;
    color:#f5f5f5;
    background: #a52a2a;
}
#twitter-status {
    text-align: center;
    color:#f5f5f5;
    background: #a52a2a;
}
</style>

<!-- end: gisolve service interaction features -->

</head>

<body class=" yui-skin-sam" onunload=GUnload()>
<div id="top1">
    <div id="topbanner">
	<table border="0"><tr>
    <td width="35%"><a href="http://gisolve.org" target="_blank"><img src="./images/gisolve_logo.jpg" height="80" border="0" align="left"></a></td>
    <td width="50%"><font size=5 color="darkblue">SimpleGrid 2.0 Tutorial</font></td>
    <td width="5%" ><span id="usrButtons"></span></td>
    </tr></table>
    </div>
</div>
<div id="bottom1">
<table border="0"><tr>
<td width="5%"><a href="http://nsf.gov" target="_blank"><img src="./images/nsf_logo.jpg" height="38" align="left" border="0"></a></td>
<td width="5%"><a href="http://teragrid.org" target="_blank"><img src="./images/tg_logo.gif" height="40" align="left" border="0"></a></td>
<td width="70%" align="right"><font size=1>Copyright (C) 2008-2009 CyberInfrastructure and Geospatial Information Laboratory (CIGI), University of Illinois. All rights reserved.</font></td>
</tr></table>
</div>
<div id="right1">
    <div id="dmstable" class="yui-skin-sam"></div>
    <div id="dmsbuttons"></div>
</div>
<div id="left1">
	<div id="twitterButtonDiv" align="center"></div>
	<div id="twitter-status"></div>
	<div id="collab" class="yui-skin-sam"></div>
</div>
<div id="center1">
	<div id="gisolve-service-busy"></div>
    <div id="map" style="width:577px; height:440px" class="yui-skin-sam"></div>
</div>

<!-- gisolve hidden elements -->
<div id="gisolve-viz-proxy"></div>
<div id="gisolve-service-status"></div>

<!-- hidden dialog for dms NEW action -->
<div id="dmsnewDialog">
<div class="hd">Please specify experiment parameters</div>
<div class="bd">
<form method="GET" action="dms.php">
	<label for="jname">Analysis Name:</label><input type="text" id="dmsnew_jname" name="jname" value="myDms"/>
	<div class="clear"></div> 
	<label for="resolutionx">Horizontal Resolution (500-2000):</label><input type="text" id="dmsnew_resolutionx" name="resolutionx" value="500"/>
	<div class="clear"></div> 
	<label for="resolutiony">Vertical Resolution (500-2000):</label><input type="text" id="dmsnew_resolutiony" name="resolutiony" value="500"/>
	<div class="clear"></div> 
	<label for="k">K-value:</label><input type="text" id="dmsnew_k" name="k" value="5"/>
	<div class="clear"></div>
	<label for="inputdata">Input Dataset:</label><input type="text" id="dmsnew_inputdata" name="inputdata" value="sample" />
	<div class="clear"></div> 
</form>
</div>
</div>

<!-- hidden dialog for user login -->
<div id="usrLoginDialog">
<div class="hd" id="usrLoginDialogHeader">User Login</div>
<div class="bd">
<form method="GET" action="NA.php">
    <div id="usr-login-dialog-warning"></div>
    <div class="clear"></div> 
	<label for="usrLoginId">Name:</label><input type="text" id="usrLoginId" name="usrLoginId" value=""/>
	<div class="clear"></div> 
	<label for="usrLoginPass">Password:</label><input type="password" id="usrLoginPass" name="usrLoginPass" value=""/>
	<div class="clear"></div> 
</form>
</div>
</div>

<script>
(function() {
	// dragdrop: as long as draged object intersects with target, bingo
	// commented because if set, onDragDrop input param changes to DDArray, which 
	// is the set of intersected elements
	//YAHOO.util.DragDropMgr.mode = YAHOO.util.DragDropMgr.INTERSECT;

	var dmsJobTable;
	var myDataSource;
	var dmsnewDialog;
	var dmsreportOverlay;
	var dmsServiceHost = "dms.php";
	var gisolve_viz_jobid;
	var overlaymap; 
	var usrLoginButton, usrDialog, usrLoginDialog, gisolveUsrName="<?php echo $user; ?>";
	var timerId = "";
	
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

	// for all GET requests to web server's dms processing, post-handling is here
	function dmsRequestSuccess(o) {
		var rv = o.responseText;
		// GET is okey, let's see service result
		if (rv.indexOf("success") == 0) { 
			// any action OK leads to datatable refresh
			dmsJobTable.getDataSource().sendRequest(
					'',
					{ success: dmsJobTable.onDataReturnInitializeTable,
					scope:  dmsJobTable}
			);
			document.getElementById("gisolve-service-busy").innerHTML="";
		} else {
			document.getElementById("gisolve-service-busy").innerHTML="Status: "+rv;
		}
	}
	function dmsRequestFailure(o) {
		document.getElementById("gisolve-service-busy").innerHTML="Failed: "+ o.status;
	}
	// New button click handler:
	function onNewButtonClick(p_oEvent) {

        dmsnewDialog.show();
    	// submit will be handled by dialog's submit handler
    }
	// Refresh button click handler:
	function onRefreshButtonClick(p_oEvent) {
		document.getElementById("gisolve-service-busy").innerHTML="Refreshing job table. Please wait ...";
		// use conn man to call
		var mycallback = {
				  success:dmsRequestSuccess,
				  failure:dmsRequestFailure,
				  cache: false
		};
		var reqstr = "dms.php?command=refresh" + ((gisolveUsrName == "")?"":"&uid="+gisolveUsrName);
		YAHOO.util.Connect.asyncRequest('GET', reqstr, mycallback);
		//TODO: if it takes long, show a message
    }
	// New button click handler:
	function onDeleteButtonClick(p_oEvent) {
		var jid = "";
		// get selected row
		var rowlist = dmsJobTable.getSelectedRows();
		if (rowlist.length > 0) {
			var rowRecord = dmsJobTable.getRecord(rowlist[0]);
			jid = rowRecord.getData("Id");
			// use conn man to call
			var mycallback = {
					  success:dmsRequestSuccess,
					  failure:dmsRequestFailure,
					  cache: false
			};
			var reqstr = "dms.php?command=delete&jobId="+jid + ((gisolveUsrName == "")?"":"&uid="+gisolveUsrName);
			YAHOO.util.Connect.asyncRequest('GET', reqstr, mycallback);
			//TODO: if it takes long, show a message    
		} else {
			alert("Please select a job first!");
		}
    }

	// begin: dms NEW dialog definition
	// Define various event handlers for Dialog
	function dmsnewSubmit() {
		document.getElementById("gisolve-service-busy").innerHTML="Submitting to TeraGrid. Please wait ...";
		// get form data
		//TODO: syntax check on input values
		var jname = document.getElementById("dmsnew_jname").value;
		var resolutionx = document.getElementById("dmsnew_resolutionx").value;
		var resolutiony = document.getElementById("dmsnew_resolutiony").value;
		var k = document.getElementById("dmsnew_k").value;
		var inputdata = document.getElementById("dmsnew_inputdata").value;

		// use conn man to call
		var reqstr = "dms.php?command=new"+"&jname="+jname
				+"&resolutionx="+resolutionx+"&resolutiony="+resolutiony
				+"&k="+k+"&inputData="+inputdata + ((gisolveUsrName == "")?"":"&uid="+gisolveUsrName);
		//alert(reqstr);
		var mycallback = {
				  success:dmsRequestSuccess,
				  failure:dmsRequestFailure,
				  cache: false
		};
		YAHOO.util.Connect.asyncRequest('GET', reqstr, mycallback);
		//TODO: if it takes long, show a message
		this.submit();
	}
	function dmsnewCancel() {
		//dmsnewDialog.hide();
		this.cancel();
	}
	function dmsnewSuccess(o) {
		var response = o.responseText;
		//alert("dmsDialog: success. "+response);
	}
	function dmsnewFailure(o) {
		//alert("dmsDialog: Submission failed. " + o.status);
	}
	// end: dms NEW dialog definition  

	//==user login functions==
	function onUsrLoginButtonClick() {
		if (gisolveUsrName == "") {
			usrLoginDialog.show();
		} else {
			usrLoginSubmit(); // logout
		}
	}
	
	/////////////amer/////////////////star
	
	function onLoad(){
		usrLoginButton.set("label", "Logout");
	}
	
	//////////////////amer///////////////end
	
	function usrLoginRequestSuccess(o) {
		var rv = o.responseText;
		if (gisolveUsrName=="") { //login
			// request is okey, let's see service result
			if (rv.indexOf("success") == 0) { 
				// upon success, we change login and register element
				usrLoginButton.set("label", "Logout");
				var tmp = rv.split(/\s*=\s*/);
				gisolveUsrName = tmp[1];
				//alert("User "+gisolveUsrName+" is logged in.");
				// cancel the dialog
				usrLoginDialog.submit();
				document.getElementById("usr-login-dialog-warning").innerHTML="";
			} else {
				document.getElementById("usr-login-dialog-warning").innerHTML=rv;
			}
		} else { //logout
			usrLoginButton.set("label", "Login");
			gisolveUsrName="";
			document.getElementById("usr-login-dialog-warning").innerHTML="";
		}
		// clear message area
		document.getElementById("gisolve-service-busy").innerHTML="";
		
		// When Logged out, clear the map from the current display output
		overlaymap = new gisolverlay("map");
		var formatUrl = function(elCell, oRecord, oColumn, sData) { 
			elCell.innerHTML = "";
            	}
	}
	function usrLoginRequestFailure(o) {
		alert("usrLoginDialog: Could not call remote action. HTTP status: " + o.status);
		if (gisolveUsrName=="") {
			usrLoginDialog.cancel();
		}
	}
	function usrLoginSubmit() {
		var reqstr = "", usrId="", usrPass="";
		if (gisolveUsrName=="") {
			// get form data
			//TODO: syntax check on input values
			usrId = document.getElementById("usrLoginId").value;
			usrPass = document.getElementById("usrLoginPass").value;
			reqstr = "command=login"+"&uid="+escape(usrId)+"&password="+escape(usrPass);
		} else {
			usrId = gisolveUsrName;
			reqstr = "command=logout"+"&uid="+escape(usrId);
		}
		//alert(reqstr);
		var mycallback = {
				  success:usrLoginRequestSuccess,
				  failure:usrLoginRequestFailure,
				  cache: false
		};
		YAHOO.util.Connect.asyncRequest('POST', "usr.php", mycallback, reqstr);
		document.getElementById("usr-login-dialog-warning").innerHTML="Sending login info...";
	}
	function usrLoginCancel() {
		document.getElementById("usr-login-dialog-warning").innerHTML="";
		this.cancel();
	}
	function usrLoginSuccess(o) {
			
		//var response = o.responseText;
		//alert("usrDialog: success. "+response);
		document.getElementById("usr-login-dialog-warning").innerHTML="";
	}
	function usrLoginFailure(o) {
		alert("usrLoginDialog: Submission failed. " + o.status + ":::" + o.responseText);
		document.getElementById("usr-login-dialog-warning").innerHTML="";
	}

	// twitter updates on simplegrid activities
	function twitterFollow() {
		document.getElementById("twitter-status").innerHTML = "Updating SimpleGrid tweets ...";
		var mycallback = {
				  success: function(o) {
						twitterMsg(o.responseText); 
						document.getElementById("twitter-status").innerHTML = "";
					},
				  failure: function(o) {
						document.getElementById("twitter-status").innerHTML = "Couldn't follow. HTTP status: " + o.status;
					}, 
				  cache: false
		};
		var reqstr = "twitter.php" + ((gisolveUsrName == "")?"":"?uid="+gisolveUsrName);
		YAHOO.util.Connect.asyncRequest('GET', reqstr, mycallback);
	}
	
	function twitterMsg(msg) {
        try {
            var messages = YAHOO.lang.JSON.parse(msg);
            //var messages = eval( msg);
            var htmlStr = ""; var timeStr=""; var textStr="";
            for (var i = 0, len = messages.length; i < len; ++i) {
				if (messages[i].created_at != undefined) {
					timeStr = messages[i].created_at;
				}                
				if (messages[i].text != undefined) {
					textStr = messages[i].text;
				}
				htmlStr += "<p><b>Time</b>: <i>"+timeStr+"</i></p>";
				htmlStr += "<p><font color=\"blue\">"+textStr+"</font></p><hr/>";
				timeStr=""; textStr="";
            }
            document.getElementById("collab").innerHTML = htmlStr;
        } catch (x) {
            document.getElementById("collab").innerHTML = "JSON Parse failed!";
        }
	}
	
	// initialize UI
    Event.onDOMReady(function() {
        var layout = new YAHOO.widget.Layout({
            units: [
                { position: 'top', height: 108, body: 'top1', scroll: null, zIndex: 2 },
                { position: 'right', header: 'DMS Interpolation', width: 400, resize: true, collapse: true, scroll: true, body: 'right1', animate: true, gutter: '5' },
                { position: 'bottom', height: 42, body: 'bottom1' },
                { position: 'left', header: 'User Activities', width: 300, body: 'left1', gutter: '5', collapse: true, scroll: true, zIndex: 1 },
                { position: 'center', body: 'center1', scroll: true, gutter: '5 0' }
            ]
        });
        layout.render();
        
    	//== load google map==
		overlaymap = new gisolverlay("map");

        //== load job list==
        // output link formatter
        var formatUrl = function(elCell, oRecord, oColumn, sData) { 
        	if (sData != "") {
            	elCell.innerHTML = "<a href='" + sData + "' target='_blank'>Available</a>"; 
            } else {
               	elCell.innerHTML = "";
            }
        };
		// header definition
       	var myColumnDefs = [
               {key:"Id", sortable:true},
               {key:"Name", sortable:true},
               {key:"ResolutionX", sortable:false},
               {key:"ResolutionY", sortable:false},
               {key:"Ks", sortable:true},
               {key:"Dataset", sortable:true},
               {key:"Output", sortable:false, formatter:formatUrl},
               {key:"Date", sortable:true},
               {key:"User", sortable:true},
               {key:"Status", sortable:true},
               {key:"Gridjobid", sortable:true},
               {key:"Image", sortable:true}
           ];

        // Use an XHRDataSource
        myDataSource = new YAHOO.util.XHRDataSource("dms.php");
        // Set the responseType
        myDataSource.responseType = YAHOO.util.XHRDataSource.TYPE_TEXT;
        // Define the schema of the delimited results
        myDataSource.responseSchema = {
            recordDelim: "\n",
            fieldDelim: "\t",
            fields: ["Id","Name","ResolutionX","ResolutionY","Ks","Dataset","Output","Date","User","Status","Gridjobid","Image"]
        };
        // Enable caching
        //myDataSource.maxCacheEntries = 5;

        dmsJobTable = new YAHOO.widget.DataTable("dmstable",
                myColumnDefs, myDataSource, {
                    caption:"Experiment List",
                    selectionMode:"single" 
                });
        // hide unnecessary columns
        dmsJobTable.hideColumn("Id");
        dmsJobTable.hideColumn("ResolutionX");
        dmsJobTable.hideColumn("ResolutionY");
        dmsJobTable.hideColumn("Ks");
        dmsJobTable.hideColumn("Dataset");
        dmsJobTable.hideColumn("Gridjobid");
        dmsJobTable.hideColumn("Image");
        // sort
        dmsJobTable.sortColumn("Date");
        // Subscribe to events for row selection
        dmsJobTable.onEventSelectRow = function(e, r) {
			this.unselectAllRows();
			var target = Event.getTarget(e);
			this.selectRow(target);
			if (gisolveUsrName == "") {
				alert("Please login to view details!");
				return;
			}
			var sr = dmsJobTable.getRecord(target);
			dmsreportOverlay.setHeader("Experiment Report: "+sr.getData("Name"));
            var htmlstr = "<table>"
                            +"<tr><td align='center'>ID:</td><td width=\"5%\"></td><td align='left'>"+sr.getData("Id")+"</td></tr>"
                            +"<tr><td align='center'>Horizontal Resolution:</td><td width=\"5%\"></td><td align='left'>"+sr.getData("ResolutionX")+"</td></tr>"
                            +"<tr><td align='center'>Vertical Resolution:</td><td width=\"5%\"></td><td align='left'>"+sr.getData("ResolutionY")+"</td></tr>"
                            +"<tr><td align='center'>K-values:</td><td width=\"5%\"></td><td align='left'>"+sr.getData("Ks")+"</td></tr>"
                            +"<tr><td align='center'>Input Dataset:</td><td width=\"5%\"></td><td align='left'>"+sr.getData("Dataset")+"</td></tr>"
                            +"<tr><td align='center'>Output Dataset:</td><td width=\"5%\"></td><td align='left'>"+sr.getData("Output")+"</td></tr>"
                            +"<tr><td align='center'>Submission Date:</td><td width=\"5%\"></td><td align='left'>"+sr.getData("Date")+"</td></tr>"
                            +"<tr><td align='center'>Status:</td><td width=\"5%\"></td><td align='left'>"+sr.getData("Status")+"</td></tr>"
                            +"</table>";
            dmsreportOverlay.setBody(htmlstr);
            var now = new Date();
            dmsreportOverlay.setFooter(now.toLocaleString());
            dmsreportOverlay.show();
		};
        dmsJobTable.subscribe("rowMouseoverEvent", dmsJobTable.onEventHighlightRow);
        dmsJobTable.subscribe("rowMouseoutEvent", dmsJobTable.onEventUnhighlightRow);
        dmsJobTable.subscribe("rowClickEvent", dmsJobTable.onEventSelectRow);
        dmsJobTable.subscribe("tableBlurEvent", function(){dmsreportOverlay.hide();});
        
        // Programmatically select the first row
        dmsJobTable.selectRow(dmsJobTable.getTrEl(0));
        
		var joblist_el = Dom.get("dmstable");
        joblist_pos = Dom.getXY(joblist_el);

        mapdd = new YAHOO.util.DDTarget("map", "viz");
        joblistdd = new YAHOO.util.DDProxy(dmsJobTable.getTbodyEl(), "viz", { 

                // Define a custom proxy element.  It will be
                // created if not already on the page.
                dragElId: "gisolve-viz-proxy", 

                // When a drag starts, the proxy is normally
                // resized.  Turn this off so we can keep a
                // fixed sized proxy.
                resizeFrame: false
            });
        // mouseup means drop is finished
        joblistdd.onMouseUp = function(e) {
        	Dom.setXY(this.getEl(), joblist_pos);
        };
        var ddOverRow;
		joblistdd.onMouseDown = function(ev) {
			ddOverRow = Event.getTarget(ev);
			var sr = dmsJobTable.getRecord(ddOverRow);
		};
		joblistdd.onDrag = function(e) {
			dmsJobTable.highlightRow(ddOverRow);
		}

		joblistdd.onMouseUp = function(e) {
	        Dom.setXY(this.getEl(), joblist_pos);
	    };
        joblistdd.onDragDrop = function(e, id) {
            if (gisolveUsrName == "") {
				alert("Please login first!");
				return;
            }
        	Dom.setXY(this.getEl(), joblist_pos);
        	if (id == "map") {
				var rowRecord = dmsJobTable.getRecord(ddOverRow);
				var fireUrl = rowRecord.getData("Image");
				if (fireUrl=="") {
					alert("Visualization result is not available yet");
				} else {
					overlaymap.putOverlay(fireUrl);
				}
        	}
        	dmsJobTable.unhighlightRow(ddOverRow);
        };
        joblistdd.onInvalidDrop = function(e) {
        	Dom.setXY(this.getEl(), joblist_pos);
        	dmsJobTable.unhighlightRow(ddOverRow);
        };

        // control buttons
        var newButton = new YAHOO.widget.Button({ 
				id: "dmsNew",
				type: "button",
				label: "New",  
				container: "dmsbuttons",
        		onclick: { fn: onNewButtonClick } 
    		});
        var refreshButton = new YAHOO.widget.Button({ 
			id: "dmsRefresh",
			type: "button",
			label: "Refresh",  
			container: "dmsbuttons",
    		onclick: { fn: onRefreshButtonClick } 
		});        
        var deleteButton = new YAHOO.widget.Button({ 
			id: "dmsDelete",
			type: "button",
			label: "Delete",  
			container: "dmsbuttons",
    		onclick: { fn: onDeleteButtonClick } 
		});

    	// Instantiate the new job Dialog
    	dmsnewDialog = new YAHOO.widget.Dialog("dmsnewDialog", 
    							{ width : "30em",
    							  fixedcenter : true,
    							  visible : false,
    							  modal: true, 
    							  constraintoviewport : true,
    							  postmethod : "none",
    							  buttons : [ { text:"Submit", handler:dmsnewSubmit, isDefault:true },
    								      { text:"Cancel", handler:dmsnewCancel } ]
    							});
    	// Wire up the success and failure handlers
    	dmsnewDialog.callback = { success: dmsnewSuccess,
    						     failure: dmsnewFailure
    						     };
    	
    	// Render the Dialog
    	dmsnewDialog.render();

    	// Instantiate the user login Dialog
    	usrLoginDialog = new YAHOO.widget.Dialog("usrLoginDialog", 
    							{ width : "30em",
    							  fixedcenter : true,
    							  visible : false,
    							  modal: true, 
    							  constraintoviewport : true,
    							  postmethod : "none",
    							  buttons : [ { text:"Submit", handler:usrLoginSubmit, isDefault:true },
    								      { text:"Cancel", handler:usrLoginCancel } ]
    							});
    	// Wire up the success and failure handlers
    	usrLoginDialog.callback = { success: usrLoginSuccess,
    						     failure: usrLoginFailure
    						     };
    	// Render the Dialog
    	usrLoginDialog.render();
        
    	// Check if the user is logged in or not, to set the button label
        var loginButtonLabel = 'Login';
    	if(gisolveUsrName!="")
    		loginButtonLabel = 'Logout';
		
        // control buttons
        usrLoginButton = new YAHOO.widget.Button({ 
			id: "usrLoginButton",
			type: "button",
			label: loginButtonLabel,  
			container: "usrButtons",
    		onclick: { fn: onUsrLoginButtonClick } 
		});

    	// Instantiate dmsreport overlay
		dmsreportOverlay = new YAHOO.widget.Panel("dmsreportOverlay", { width:"320px", visible:false, draggable:true, close:true } );
		dmsreportOverlay.setHeader("Experiment Progress Report");
		dmsreportOverlay.setBody("No report content is available");
		dmsreportOverlay.setFooter("Date Time");
		dmsreportOverlay.render("right1");

        var twitterButton = new YAHOO.widget.Button({ 
			id: "twitterButton",
			type: "button",
			label: "Follow SimpleGrid Tweets",  
			container: "twitterButtonDiv",
    		onclick: { fn: twitterFollow } 
		});
		// set timer for twitter updates
		//timerId = setInterval(twitterFollow, 60000);
    });
})();

</script>


</body>
</html>
