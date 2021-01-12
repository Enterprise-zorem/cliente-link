<?php
header('Access-Control-Allow-Origin:*');
$_POST = json_decode(file_get_contents("php://input"), true);


if(!isset($_POST['id']) || empty($_POST['id']))
{
    $result="El Campo ID es Invalido";
        print json_encode($result,JSON_UNESCAPED_UNICODE);
        exit();
}
if(!isset($_POST['link']) || empty($_POST['link']))
{
    $result="El Campo url es Invalido";
        print json_encode($result,JSON_UNESCAPED_UNICODE);
        exit();
}
if(!isset($_POST['title']) || empty($_POST['title']))
{
    $result="El Campo title es Invalido";
        print json_encode($result,JSON_UNESCAPED_UNICODE);
        exit();
}

//verificar si el token no es un link separado
$link=new links_reserved(new Connexion);
$link->settoken($_POST['link']);
$link=$link->getAllByToken();
$link=$link->fetch_array(MYSQLI_ASSOC);
if($link)
{
    $result="La Nueva URL es un Link Separado, intente con una diferente";
    print json_encode($result,JSON_UNESCAPED_UNICODE);
    exit();
}
//verificar si el token no es un link separado

$short=new short_links(new Connexion);
$short->settoken($_POST['link']);
$short=$short->getAllByToken();
$short=$short->fetch_array(MYSQLI_ASSOC);
if($short)
{
   //el campo url ya existe entonces no reemplazar
   $short=new short_links(new Connexion);
   $short->setpk($_POST['id']);
   $short->settitle($_POST['title']);
   $date=new DateTime();
   $datetime=$date->format('Y-m-d H:i:s');
   $short->setupdated_at($datetime);
   $short->update2();
   $result="No se Modifo la URL";
        print json_encode($result,JSON_UNESCAPED_UNICODE);
        exit();
}
else
{
    $short=new short_links(new Connexion);
$short->setpk($_POST['id']);
$short->settoken($_POST['link']);
$short->settitle($_POST['title']);
$date=new DateTime();
$datetime=$date->format('Y-m-d H:i:s');
$short->setupdated_at($datetime);
$result=$short->update();
        print json_encode($result,JSON_UNESCAPED_UNICODE);
        exit();
}

