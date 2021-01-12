<?php 
header('Access-Control-Allow-Origin:*');
include_once "./config/google.php";


//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 if(!isset($token['error']))
 {
  //Set the access token used for requests
  $google_client->setAccessToken($token['access_token']);

  //Store "access_token" value in $_SESSION variable for future use.
  $_SESSION['access_token'] = $token['access_token'];

  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($google_client);

  //Get user profile data from google
  $data = $google_service->userinfo->get();
  
 // var_dump($data);
  
    //INSERT O LOGUEAR 
    //BUSCAMOS EN LA BASE DE DATOS EL EMAIL
    
    $cliente=new clientes(new Connexion);
    $cliente->setemail($data['email']);
    $cliente=$cliente->getAllByEmail();
    $cliente=$cliente->fetch_array(MYSQLI_ASSOC);
    if($cliente)
    {
        //hay datos loguear
        $session=new Session();
        $session->addValue('links__id_user',$cliente['id']);
        //echo "LOGUEADO CORRECTAMENTE";
        header('Location: '.RUTA);
    }
    else
    {
        //registrar usuario
        $cliente=new clientes(new Connexion);
        $cliente->setnombre($data["given_name"]);
        //$cliente->setapellido($data["family_name"]);
        $cliente->setemail($data['email']);
        $cliente->setenabled(1);
        
        $cliente->setimagen($data['picture']);
        $date=new DateTime();
        $datetime=$date->format('Y-m-d H:i:s');
        $cliente->setemail_verified_at($datetime);
        $cliente->setcreated_at($datetime);
        $cliente->setupdated_at($datetime);
        $result=$cliente->insert();
        if(is_numeric($result))
        {
            //registrado correctamente
            $session=new Session();
            $session->addValue('links__id_user',$result);
            //echo "REGISTRADO Y LOGUEADO CORRECTAMENTE";
            header('Location: '.RUTA);
        }
        else
        {
            //error al registrar usuario
            //echo "ERROR AL REGISTRAR USUARIO";
            header('Location: '.RUTA);
        }
    }
  
 }
}
