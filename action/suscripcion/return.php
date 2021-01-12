<?php

include_once "config/paypal.php";
$paymentId=$_GET['paymentId'];
$payerId=$_GET['PayerID'];
$token=$_GET['token'];

if(!$payerId || !$payerId || !$token)
{   
    //Error al procesar Pago
    $session=new Session();
    $session->addValue('status_paypal','Error al Procesar Pago');
    //header("Location: ".RUTA."suscripcion/verify");
    //echo "error al procesar pago";
    echo "<script>window.location.replace('".RUTA."suscripcion/verify'); </script>";

}
else
{
    $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
    $execution = new \PayPal\Api\PaymentExecution();
    $execution->setPayerId($payerId);

    $result=$payment->execute($execution,$apiContext);

    //echo $result->getState();
    if($result->getState()=="approved")
    {   $session=new Session();
        $session->addValue('status_paypal','approved');
        //registrar pago
        $usuario=$session->getValue('links__id_user');
        $plan=$session->getValue('plan_id');
        $suscription=new suscriptions(new Connexion);
        $suscription->setuser_id($usuario);
        $suscription->setplan_id($plan);
        $date=new DateTime();
        $datetime=$date->format('Y-m-d');
        $suscription->setstarted_at($datetime);//fecha de inicio de la suscripcion
        $datetime=date("Y-m-d",strtotime($datetime."+ 1 month"));
        $suscription->setfinish_at($datetime);//fehca de finalizacion de la suscripcion mensual
        $date=new DateTime();
        $datetime=$date->format('Y-m-d H:i:s');
        $suscription->setcreated_at($datetime);
        $suscription->insert();
        $session->removeValue('plan_id');
        //pago realizado correctamente
        //header("Location: ".RUTA."suscripcion/verify");
        echo "<script>window.location.replace('".RUTA."suscripcion/verify'); </script>";

        
    }
}
