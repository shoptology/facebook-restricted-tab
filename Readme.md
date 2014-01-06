Sample Facebook Tab iFrames and Restrictions App
================================================

This app demonstrates the capabilities of an iframe Page tab.

Edit config.php with your app id, secret, and urls then add the app to a Page on Facebook.

If you run `php restrict-app.php` from the command-line, you can run and it will make it so you app and tab will only be visible to users logged into Facebook with accounts from the US.

If you run `php unrestrict-app.php` from the command-line, it will unset all of the restrictions so the app is visible to all.

Note that restrictions can now be managed via [Facebook's Developer app](https://developers.facebook.com/apps) so it's no longer necessary to do it via the API. Also note that if there are restrictions, people that are logged out of Facebook cannot see your app. We recommend viewing your application while logged out so you can see if using Facebook's app restrictions is the right experience for your apps.

When you load the app in an iframe tab, it will show

*   Graph API info about the current page
*   Whether or not you like the page
*   Whether or not you are an admin of the page
*   Your geo-ip detected country (using MaxMind's free GeoIP country lookup)
*   Your Facebook country and locale settings
*   A login button to authorize the app to access your basic info (note that the app itself does not save any data and all of the info is passed on the client-side with the javsascript sdk)
*   A dump of the request data passed to the app
*   A dump of the contents of the signed request
*   An example of passing data to a Page tab iframe using the app_data var


