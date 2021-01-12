<?php 
header('Access-Control-Allow-Origin:*');
$_POST = json_decode(file_get_contents("php://input"), true);

if(!isset($_POST['numero']) || empty($_POST['numero']))
{
    $result="El Campo Numero es invalido";
        print json_encode($result,JSON_UNESCAPED_UNICODE);
        exit();
}
if(!isset($_POST['title']) || empty($_POST['title']))
{
    $result="El Campo nombre es invalido";
        print json_encode($result,JSON_UNESCAPED_UNICODE);
        exit();
}


function createwsp()
{   //usuario
    $session=new Session();
    $session=$session->getValue('links__id_user');
    //===
    $link="https://api.whatsapp.com/send?phone=+51";
    $link=$link.$_POST['numero']."&text=";
    $link=$link.urlencode($_POST['mensaje']);
    //generate token
    $token= getShortCode();
    //insert
    $short=new short_links(new Connexion);
    $short->settitle($_POST['title']);
    $short->setuser_id($session);
    $short->setlink($link);
    $short->settoken($token);
    $short->settype(1);//tipo 0 url comun wsp 1 
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

echo createwsp();

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