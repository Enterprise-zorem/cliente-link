<?php
$_POST = json_decode(file_get_contents("php://input"), true);
header('Access-Control-Allow-Origin:*');
$link=new short_links(new Connexion);
$link->setpk($_POST['id']);
$link=$link->getAllById();
$link=$link->fetch_array(MYSQLI_ASSOC);
if($link)
{
    $link=new short_links(new Connexion);
    $link->setpk($_POST['id']);
    echo $link->delete();
}
else
{
    echo "Error al Eliminar";
}