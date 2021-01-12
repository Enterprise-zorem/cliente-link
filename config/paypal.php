<?php
require_once './vendor/autoload.php';

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AYWyhoL5TksEkh7n13QEWQrGLcyM0QLc5XJtyMbG4RSXCdGwxUH7LN9HAptgw_4NsWb-ghUhJDRf71eS',     // ClientID
        'ECIFWJNMngyLR1mghGJFajj3icMwOzLZgL4ko7Fk2XKYzUtFTnUQVq5Q_oO6X-ViYnuI2BZKK9kP1I_b'      // ClientSecret
    )
);