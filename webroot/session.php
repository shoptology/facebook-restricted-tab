<?php
/**
 * Simple debug script to output graph api data
 * 
 * @copyright Affinitive, LLC
 * @author Rob Marscher (@rmarscher)
 */

require realpath(__DIR__ . '/../config.php');
echo "Signed Request:\n";
print_r($facebook->getSignedRequest());
echo "Session:\n";
print_r($facebook->getSession());
$me = $facebook->api('/me');
if ($me) {
	echo "Me:\n";
	print_r($me);
}

