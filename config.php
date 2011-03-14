<?php

$appId = 'ENTER YOUR APP ID HERE';
$appSecret = 'ENTER YOUR APP SECRET HERE';
$cacheId = 1; // bump this up when changing images or css so facebook grabs a new version for its cache 

// "secure browsing" feature forces us to support https
$protocol = "http://";
$ssl = false;
if (isset($_SERVER['HTTPS'])) {
	$protocol = "https://";
	$ssl = true;
}

$callbackUrl = $protocol . $_SERVER['HTTP_HOST'] . '/restricted-app/webroot'; // trailing slash is not expected here 
$canvasUrl = $protocol . 'apps.facebook.com/restricted-app'; // trailing slash is not expected here 

require __DIR__ . '/lib/facebook-sdk/facebook.php';
$facebook = new Facebook(array(
	'appId' => $appId, 
	'secret' => $appSecret,
	'cookie' => true, 
	'fileUpload' => true
));

$signedRequest = $facebook->getSignedRequest();
$appData = array();
if (isset($signedRequest['app_data'])) {
	$appData = json_decode($signedRequest['app_data'], true);
}


function escape($string, $context = 'html') {

}


