<?php
$_POST = json_decode(file_get_contents("php://input"), true);
header('Access-Control-Allow-Origin:*');
if(!isset($_POST['link']) || empty($_POST['link']))
{
    $result="El Campo url es invalido";
        print json_encode($result,JSON_UNESCAPED_UNICODE);
        exit();
}
if(!isset($_POST['title']) || empty($_POST['title']))
{
    $result="El Campo nombre es invalido";
        print json_encode($result,JSON_UNESCAPED_UNICODE);
        exit();
}

if (!filtroUrl($_POST['link'])) {	
    $result=array('result'=>'La URL es incorrecta, Asegurese de usar http o https');
    print json_encode($result,JSON_UNESCAPED_UNICODE);
    exit();
}

function create()
{   
    $session=new Session();
    $session=$session->getValue('links__id_user');
    $token= getShortCode();
    //insert
    $short=new short_links(new Connexion);
    $short->setuser_id($session);
    $short->settitle($_POST['title']);
    $short->setlink($_POST['link']);
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
        $result="defaultValue";
        return json_encode($result,JSON_UNESCAPED_UNICODE);
    }
    else
    {   
        return json_encode($result,JSON_UNESCAPED_UNICODE);
    }
}
echo create();

function getShortCode()
{
    for ($i=0; $i < 100; $i++) { 
        $code=new GetDataServer();
        $code=$code->generateRandomString();
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

function filtroUrl($valor){
    if(trim($valor) == ''){
        //echo 'No has introducido ningun valor<br>';
        return false;
    }else{
        if (!filter_var($valor, FILTER_VALIDATE_URL)) {
            //echo 'La direccion introducida no es valida<br>';
            return false;
        }
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|](\.)[a-z]{2}/i",$valor)) {
            //echo 'La direccion introducida no es valida<br>';
            return false;
        }else{
            //echo 'Direccion valida<br>';
            return true;
        }
    }
}

