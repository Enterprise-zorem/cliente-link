<?php
session_start();


try
{
    // Run CSRF check, on POST data, in exception mode, for 10 minutes, in one-time mode.
    NoCSRF::check( 'csrf_token', $_POST, true, 60*10, false );
    // form parsing, DB inserts, etc.
    // ...
    $result = 'CSRF check passed. Form parsed.';
}
catch ( Exception $e )
{
    // CSRF attack detected
    $result = $e->getMessage() . ' Form ignored.';
}


if(!isset($_POST['generator__url']) || empty($_POST['generator__url']))
{
    exit("El Campo URL es invalido");
}

function create()
{
    $token= getShortCode();
    //insert
    $short=new short_links(new Connexion);
    $short->setlink($_POST['generator__url']);
    $short->settoken($token);
    $short->settype(0);//tipo 0 url comun
    $date=new DateTime();
    $datetime=$date->format('Y-m-d H:i:s');
    $short->setcreated_at($datetime);
    $short->setupdated_at($datetime);
    $short->setcounter(0);
    $short->setenabled(1);
    $result=$short->insert();
    if($result=="defaultValue")
    {   
        $result=array('token'=>RUTA.$token,'result'=>'defaultValue');
        return json_encode($result);
    }
    else
    {
        return $result;
    }
}
echo create();

function getShortCode()
{
    for ($i=0; $i < 100; $i++) { 
        $code = GetDataServer::generateRandomString();
        $short=new short_links(new Connexion);
        $short->settoken($code);
        $short=$short->getAllByToken();
        $short=$short->fetch_array(MYSQLI_ASSOC);
        if($short)
        {
            //hay datos || repetir
        }
        else
        {
            return $code;
        }
    }
    return "No se puede generar código corto. Incrementar Rango";
}

