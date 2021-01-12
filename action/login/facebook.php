<?php
header('Access-Control-Allow-Origin:*');
include_once "config/facebook.php";


if (!session_id()) {
    session_start();
}


$session=new Session();
$token=$session->getValue('access_token');

if($session->issetValue('access_token'))
{
    $access_token = $session->getValue('access_token');
}
else
{

    $access_token = $facebook_helper->getAccessToken();

    $session->addValue("access_token",$access_token);
   
    $facebook->setDefaultAccessToken($access_token);
}


$graph_response = $facebook->get("/me?fields=name,email", $access_token);

$facebook_user_info = $graph_response->getGraphUser();

if(!empty($facebook_user_info['id']))
{
 $session->addValue("user_image",'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture');
}

if(!empty($facebook_user_info['name']))
{
 $session->addValue("user_name",$facebook_user_info['name']);
}

if(!empty($facebook_user_info['email']))
{
 $session->addValue("user_email_address",$facebook_user_info['email']);
}

//buscar en la base de datos
$cliente=new clientes(new Connexion);
$cliente->setemail($session->getValue('user_email_address'));
$cliente=$cliente->getAllByEmail();
$cliente=$cliente->fetch_array(MYSQLI_ASSOC);

if($cliente)
{
    //hay datos solo logueamos
    $session->addValue('links__id_user',$cliente['id']);
    header('Location: '.RUTA);
    //echo "LOGEADO CORRECTAMENTE";
}
else
{
    //registramos al usuario
    $cliente=new clientes(new Connexion);
    $cliente->setnombre($session->getValue('user_name'));
    $cliente->setemail($session->getValue('user_email_address'));
    $cliente->setenabled(1);
    $cliente->setimagen($session->getValue('user_image'));
    $date=new DateTime();
    $datetime=$date->format('Y-m-d H:i:s');
    $cliente->setemail_verified_at($datetime);
    $cliente->setcreated_at($datetime);
    $cliente->setupdated_at($datetime);
    $result=$cliente->insert();

    if(is_numeric($result))
    {
        //REGISTRADO CORRECTAMENT
        $session->addValue('links__id_user',$result);
        header('Location: '.RUTA);
        //echo "REGISTRADO CORRECTAMENTE";
    }
    else
    {
        //ERROR AL REGISTRAR USUARIO
        header('Location: '.RUTA);
        //echo "ERROR AL REGISTRAR";
    }

}

  
