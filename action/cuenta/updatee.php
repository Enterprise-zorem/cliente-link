<?php
header('Access-Control-Allow-Origin:*');
if(!isset($_POST['cuenta__email']) || empty($_POST['cuenta__email']))
{
    exit("El campo Email esta Vacio");
}

function update()
{   
    $session=new Session();
    $session=$session->getValue('links__id_user');

    $user=new clientes(new Connexion);
    $user->setpk($session);
    $user->setemail($_POST['cuenta__email']);
    $user->setpassword($_POST['cuenta__password']);
    return $user->update2();
}

echo update();