<?php
/**
 * Canvas page index shows facebook provided location data
 * plus shows that normal geo-ip location techniques are
 * available.
 * 
 * @copyright Affinitive, LLC
 * @author Rob Marscher (@rmarscher)
 */

require realpath(__DIR__ . '/../config.php');

$page = false;
if (isset($signedRequest['page'])) {
	$page = $facebook->api('/' . $signedRequest['page']['id']);

	// $tabLink is used later to demonstrate passing data to an iframe tab
	$tabLink = $page['link'];
	if (strpos('?', $tabLink) ) {
		$tabLink .= "?";
	} else {
		$tabLink .= "&";
	}
	$tabLink .= "sk=app_" . $appId;

	$dataToPass = array(
		'some_data' => array(1,2,3),
		'other' => 'hey now'
	);
	$tabLink .= "&" . json_encode($dataToPass);
}

?>
<!doctype html>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Geo Restricted App Demo</title>
    <link href="<?php echo $callbackUrl; ?>/css/main.css.php?cb=<?php echo $cacheId; ?>" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
    
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-206611-44']);
      _gaq.push(['_setDomainName', '.affinispace.com']); // note that the GA domain is your server, not .facebook.com
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    
    </script>
</html>
<body>
	<div id="fb-root"></div>
	<script>
		window.fbAsyncInit = function() {
			FB.init({ 
				appId: <?php echo $appId; ?>, cookie:true, 
				status:true, xfbml:true 
			});
			FB.Event.subscribe('edge.create', function(data) {
				console.log('Like');
				console.log(data);
				FB.Canvas.setSize();
			});
			FB.Event.subscribe('edge.remove', function(data) {
				console.log('Unlike');
				console.log(data);
				FB.Canvas.setSize();
			});
			FB.Canvas.setAutoResize(true);
			window.setTimeout(function() {
				FB.Canvas.setAutoResize(false);
			}, 10000);
		};
		(function() {
			var e = document.createElement('script'); e.async = true;
			e.src = document.location.protocol +
				'//connect.facebook.net/en_US/all.js';
			document.getElementById('fb-root').appendChild(e);
		}());
	</script>

	<p class="info">Canvas pages and iframe tabs are accessed directly by the browser, so normal GeoIp techniques can be used.</p>
	<p>Your IP is <?php echo $_SERVER['REMOTE_ADDR']; ?></p>
	<p>Your country code by IP is <span id="countryCode"></span></p>

	<p class="info">Note that facebook country codes follow the <a href="http://www.iso.org/iso/country_codes/iso_3166_code_lists/english_country_names_and_code_elements.htm" target="_new">ISO 3166 alpha 2 code list</a></p>
	<p>Your country according to facebook is <?php echo $signedRequest['user']['country']; ?></p>
	<p>Your language/locale according to facebook is <?php echo $signedRequest['user']['locale']; ?></p>

	<fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>
	<p class="info">
		If you want to deauthorize the app so you can test again, 
		click the [x] to the right of <b>Tab Iframe Test</b> on this page:  
		<a href="https://www.facebook.com/settings/?tab=applications" target="_new">https://www.facebook.com/settings/?tab=applications</a>
	</p>

	<?php if ($page !== false) { ?>
		<div>
			You are viewing this in a page tab.
			<div class="debug">
				<pre><?php print_r($page); ?></pre>
			</div>
			<?php if ($signedRequest['page']['like']) { ?>
				<p>You like this page.</p>
			<?php } else { ?>
				<p>You don't like this page.</p>
			<?php } ?>
			<?php if ($signedRequest['page']['admin']) { ?>
				<p>You are an admin of this page.</p>
			<?php } else { ?>
				<p>You are not an admin of this page.</p>
			<?php } ?>
			<p><a href="<?php echo escape($tabLink); ?>">Pass some data to this tab</a></p>
		</div>
		<div>
			Like button:<br />
			<fb:like href="<?php echo $page['link']; ?>" />
		</div>
	<?php } ?>

	<div class="debug">
		<h4>Request Vars</h4>
		<pre><?php print_r($_REQUEST); ?></pre>
	</div>
	<div class="debug">
		<h4>Signed Request</h4>
		<pre><?php print_r($signedRequest); ?></pre>
	</div>
	<div class="debug">
		<h4>App Data</h4>
		<pre><?php print_r($appData); ?></pre>
	</div>

	<p><a href="restricted-app.zip">Download Source</a></p>
	<script type="text/javascript" src="<?php echo $protocol; ?>ajax.microsoft.com/ajax/jquery/jquery-1.5.min.js"></script>
	<script type="text/javascript" src="<?php echo $protocol; ?>j.maxmind.com/app/geoip.js"></script>
	<script type="text/javascript">
		$('#countryCode').text(geoip_country_code());
	</script>
</body>
</html>
