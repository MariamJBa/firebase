
<?php

//config.php

//Include Google Client Library for PHP autoload file
//require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('750041701748-h2qprdv8svbdns4td6ntnsbhcu8tpqrl.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('noFgEw9BARi_rfS4L1DTU5RQ');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/firebase_crud/public/loginByGoogleEmail');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();

?>
