<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('691705410807-qdpc77m05jvcahp74tt5n4ht9ajk3lto.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('zbnBCyZP3EL5s2avBsmW1SCg');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://cliente.links.pe/process.php/login/google/');

//
$google_client->addScope('email');

$google_client->addScope('profile');

if (!session_id()) {
    session_start();
}

?>