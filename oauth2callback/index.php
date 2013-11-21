<?php
// oauth2callback/index.php


require('../settings.php');

require_once('../classes/Google_OAuth2_Token.class.php');
require_once('../classes/Google_Contact.class.php');

	
/**
 * the OAuth server should have brought us to this page with a $_GET['code']
 */
if(isset($_GET['code'])) {
    // try to get an access token
    $code = $_GET['code'];
 
	// authenticate the user
	$Google_OAuth2_Token = new Google_OAuth2_Token();
	$Google_OAuth2_Token->code = $code;
	$Google_OAuth2_Token->client_id = $settings['oauth2']['oauth2_client_id'];
	$Google_OAuth2_Token->client_secret = $settings['oauth2']['oauth2_secret'];
	$Google_OAuth2_Token->redirect_uri = $settings['oauth2']['oauth2_redirect'];
	$Google_OAuth2_Token->grant_type = "authorization_code";

	try {
		$Google_OAuth2_Token->authenticate();
	} catch (Exception $e) {
		// handle this exception
		print_r($e);
	}

	// A user just logged in.  Let's insert a contact
	if ($Google_OAuth2_Token->authenticated) {
		
		$Google_Contact = new Google_Contact($Google_OAuth2_Token);
		$Google_Contact->id = $settings['service']['contact_id'];
		$Google_Contact->displayName = $settings['service']['contact_displayName'];
		$Google_Contact->addImageUrl($settings['service']['contact_icon']);
		$Google_Contact->priority = 7;
		
		
		try {
			$Google_Contact->insert();
		} catch (Exception $e) {
			print_r($e);
		}
		
		
		
	}
}

?>
<h1>Google Contact:</h1>
<dl>
<dt>ID</dt>
<dd><?= $Google_Contact->id; ?></dd>
<dt>Name</dt>
<dd><?= $Google_Contact->displayName; ?></dd>
<dt>Icon</dt>
<dd><img alt="image" src="<?= $Google_Contact->imageUrls[0]; ?>" /></dd>
</dl>