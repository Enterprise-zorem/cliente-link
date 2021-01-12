<?php
header('Access-Control-Allow-Origin:*');
if(!isset($_POST['cuenta__nombres']) || empty($_POST['cuenta__nombres']))
{
    exit("El campo Nombres esta Vacio");
}

function update()
{   
    $session=new Session();
    $session=$session->getValue('links__id_user');

    $user=new clientes(new Connexion);
    $user->setpk($session);
    $user->setnombre($_POST['cuenta__nombres']);
    $user->settelefono($_POST['cuenta__telefono']);
    return $user->update1();
}

echo update();