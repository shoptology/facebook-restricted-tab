<?php
require __DIR__ . '/config.php';

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