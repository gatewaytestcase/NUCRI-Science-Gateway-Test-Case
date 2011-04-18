<?php  

function twitterUpdate($msg = "") {
if (empty($msg)) {
	return;
}
$username = "YOUR_TWITTER_ACCOUNT";  
$password = "YOUR_TWITTER_PASSWORD"; 
$twitterHost = "http://twitter.com/statuses/update.json";
$curl;  
  
$curl = curl_init();  
  
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);  
curl_setopt($curl, CURLOPT_HEADER, false);  
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);  
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");  
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);  
curl_setopt($curl, CURLOPT_URL, $twitterHost);  
curl_setopt($curl, CURLOPT_POSTFIELDS, "status=". urlencode(stripslashes(urldecode($msg))));

curl_setopt($curl, CURLOPT_POST, 1);
//curl_setopt($curl, CURLOPT_VERBOSE, 1);
  
$result = curl_exec($curl); 
curl_close($curl);  
  
}

?>
