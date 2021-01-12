<?php
$token=$_GET['token'];

if(!$token)
{
    echo "<script>window.location.replace('".RUTA."404');</script>";
}
else{
    $session=new Session();
    $session->addValue('status_paypal','Pago Cancelado');
    header("Location: ".RUTA."suscripcion/verify");
}