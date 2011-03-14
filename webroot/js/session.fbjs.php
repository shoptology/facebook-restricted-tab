function updateSession(requireLogin) {
	console.log('triggered');
	var ajax = new Ajax();
	ajax.responseType = Ajax.RAW;
	if (requireLogin) {
		ajax.requireLogin = true;
	}
	ajax.ondone = function(results) {
		document.getElementById('results').setTextValue(results);
	}
	// Display error dialog in event of AJAX/network error.
	ajax.onerror = function() {
		// Hide "loading" image
		document.getElementById('results').setTextValue('An error occurred grabbing the signed request.');
	}
	// Submit entry via AJAX
	console.log('sending <?php echo $callbackUrl; ?>/session.php');
	ajax.post("<?php echo $callbackUrl; ?>/session.php", {});
}
