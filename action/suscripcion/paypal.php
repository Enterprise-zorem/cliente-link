<?php
header('Access-Control-Allow-Origin:*');
$_POST = json_decode(file_get_contents("php://input"), true);

if(!isset($_POST['id']))
{   
    $result=array("status"=>'ERROR',"message"=>'NO POST');
    print json_encode($result,JSON_UNESCAPED_UNICODE);
    exit();
}
//verificar si ya tiene un suscripcion
$session=new Session(new Connexion);
$session=$session->getValue('links__id_user');
$suscripcion=new suscriptions(new Connexion);
$suscripcion->setuser_id($session);
$suscripcion=$suscripcion->getAllByUser();
$suscripcion=$suscripcion->fetch_array(MYSQLI_ASSOC);
if($suscripcion)
{
    $date=new DateTime();
    $datetime=$date->format('Y-m-d');
    if($suscripcion['finish_at']>=$datetime)
    {
        $result=array("status"=>'ERROR',"message"=>'YA REGISTRO UN PAGO');
        print json_encode($result,JSON_UNESCAPED_UNICODE);
        exit();
    }
}



$plan=new plan(new Connexion);
$plan->setpk($_POST['id']);
$plan=$plan->getAllById();
$plan=$plan->fetch_array(MYSQLI_ASSOC);
if($plan)
{
    $monto=$plan['price_mounth'];
}
else
{
    $result="ERROR";
    print json_encode($result,JSON_UNESCAPED_UNICODE);
    exit();
}


include_once "config/paypal.php";

// After Step 2
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$amount = new \PayPal\Api\Amount();
$amount->setTotal($monto);
$amount->setCurrency('USD');

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl(RUTA."process.php/suscripcion/return/")
    ->setCancelUrl(RUTA."process.php/suscripcion/cancel/");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

    // After Step 3
try {
    $payment->create($apiContext);
    //echo $payment;

    //echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
    //plan id
    $session=new Session(new Connexion);
    $session->addValue('plan_id',$_POST['id']);
    //$result=$payment->getApprovalLink();
    $result=array("status"=>'CORRECTO',"message"=>$payment->getApprovalLink());
    print json_encode($result,JSON_UNESCAPED_UNICODE);
    exit();

}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
    $result=array("status"=>'ERROR',"message"=>$ex->getData());
    print json_encode($result,JSON_UNESCAPED_UNICODE);
    exit();
    
}
