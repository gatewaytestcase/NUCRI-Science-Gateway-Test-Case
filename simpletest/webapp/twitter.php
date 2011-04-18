<?php
// twitter config
#$twitterUrl = "http://twitter.com/statuses/user_timeline.json?screen_name=gisolve_tg&count=10";
$twitterUrl = "http://twitter.com/statuses/user_timeline.json?screen_name=YOUR_TWITTER_ACCOUNT&count=10";

header('Content-type: text/plain');

$curl = curl_init();

curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl, CURLOPT_HEADER, false);
//curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($curl, CURLOPT_URL, $twitterUrl);

$result = curl_exec($curl);
curl_close($curl);

print $result;

?>
