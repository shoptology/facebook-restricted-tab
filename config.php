<?php

// "secure browsing" feature forces us to support https
$protocol = "http://";
$ssl = false;
if (isset($_SERVER['HTTPS'])) {
	$protocol = "https://";
	$ssl = true;
}

$localConfig = __DIR__ . '/config.local.php';
if (!file_exists($localConfig)) {
	$appId = 'ENTER YOUR APP ID HERE';
	$appSecret = 'ENTER YOUR APP SECRET HERE';
	$callbackUrl = $protocol . $_SERVER['HTTP_HOST'] . '/restricted-app/webroot'; // trailing slash is not expected here
	$canvasUrl = $protocol . 'apps.facebook.com/restricted-app'; // trailing slash is not expected here
	$cacheId = 1; // bump this up when changing images or css so facebook grabs a new version for its cache
} else {
	require $localConfig;
}

require __DIR__ . '/lib/facebook-sdk/facebook.php';
$facebook = new Facebook(array(
	'appId' => $appId,
	'secret' => $appSecret,
	'fileUpload' => true
));

$signedRequest = $facebook->getSignedRequest();
$appData = array();
if (isset($signedRequest['app_data'])) {
	$appData = json_decode($signedRequest['app_data'], true);
}


/**
 * Shortens the amount of typing required to escape a string for output
 *
 * @param string $string The string to escape
 * @param string $context The following options are valid:
 *     'html': escapes for html output
 *     'json': escapes for json or javascript output (note - adds double quotes around strings)
 */
function escape($string, $context = 'html')
{
	$return = '';
	switch ($context) {
		default:
		case 'html':
			$return = htmlentities($string, ENT_COMPAT, 'UTF-8');
			break;
		case 'json':
			$return = json_encode($string);
			break;
	}
	return $return;
}

