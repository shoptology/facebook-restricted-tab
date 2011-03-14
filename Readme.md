Sample Facebook Tab Iframes and Restrictions App
================================================

This app demonstrates the capabilities of an iframe Page tab.

Edit config.php with your app id, secret, and urls then add the app to a Page on Facebook.

From the command-line, you can run
    php restrict-app.php
And it will make it so you app and tab will only be visible to users logged into Facebook with accounts from the US.

From the command-line, if you run
    php unrestrict-app.php
It will unset all of the restrictions so the app is visible to all.

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


