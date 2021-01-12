<?php
if (!session_id()) {
    session_start();
}

require_once  './vendor/autoload.php'; 

 //login facebook
 $facebook = new Facebook\Facebook([
    'app_id' => "178291067297700",
    'app_secret' => 'd20d7629c7d0f1a046415ec6b131dad2',
    'default_graph_version' => 'v2.10',
    ]);

    $facebook_helper = $facebook->getRedirectLoginHelper();

    $facebook_permissions = ['email']; // Optional permissions

    $facebook_login_url = $facebook_helper->getLoginUrl(RUTA.'process.php/login/facebook/', $facebook_permissions);
