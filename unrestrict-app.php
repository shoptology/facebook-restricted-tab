<?php
require __DIR__ . '/config.php';

/* it doesn't seem possible to use the graph api to unset the restrictions
 * @link https://developers.facebook.com/bugs/230288283693263?browse=search_4e9dda658001d8f76072914

$result = $facebook->api("/{$appId}", 'POST', array(
	'restrictions' => array()
));

*/

// use old rest api until bug is fixed with removing restrictions with the graph api
$result = $facebook->api(array(
	'method' => 'admin.setRestrictionInfo',
	'restriction_str' => array()
));

echo $appId . "\n";
if ($result) {
	echo "successfully unset restrictions\n";
} else {
	echo "error unsetting restrictions\n";
}

sleep(2);

$result = $facebook->api("/{$appId}?fields=restrictions");
$restrictions = null;
if (isset($result['restrictions'])) {
	$restrictions = $result['restrictions'];
}
echo "current restrictions:\n";
if ($restrictions !== false && !empty($restrictions)) {
	print_r($restrictions);
} else {
	echo "none\n";
}
echo "\n";
