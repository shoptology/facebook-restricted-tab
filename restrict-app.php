<?php
require __DIR__ . '/config.php';

// This only needs to be called when you want to change the restrictions
// Don't do it every time the app runs
// More info here: http://developers.facebook.com/docs/reference/rest/admin.setRestrictionInfo
// Country list is here: http://www.iso.org/iso/country_codes/iso_3166_code_lists/english_country_names_and_code_elements.htm
$result = $facebook->api("/{$appId}", 'POST', array(
	'restrictions' => array(
		'location' => 'US'
	)
));

echo $appId . "\n";
if ($result) {
	echo "successfully set restrictions\n";
} else {
	echo "error setting restrictions\n";
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