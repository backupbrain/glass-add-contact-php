Add Your Service as a Contact
=============================
This code shows how to add your service to a Google Glass user's contacts, so that
they can share timeline items with your service

It is intended as a complement to my tutorial:
http://20missionglass.tumblr.com/post/67676363275/add-your-service-as-a-contact

Configuration
--------------
Set up an OAuth2 Client App in the Google Code Console:
https://code.google.com/apis/console/

Once you register an app, create  you will get a client id and client secret. 
You will also need to create a Browser API Key for the Google Maps API.  

Edit your settings.php to reflect your oauth2 client app's settings.

$settings['oauth2']['oauth2_client_id'] = 'YOURCLIENTID.apps.googleusercontent.com';
$settings['oauth2']['oauth2_secret'] = 'YOURCLIENTSECRET';
$settings['oauth2']['oauth2_redirect'] = 'https://example.com/oauth2callback';
$settings['oauth2']['api_key'] = 'API_KEY';


Be sure to name your service and create a 320x240 pixel contact icon.

$settings['service']['contact_id'] = 'example.com_service';
$settings['service']['contact_displayName'] = 'Example Service Name';
$settings['service']['contact_icon'] = 'https://example.com/glass_contact_icon.png';


Now you should be good to go.


