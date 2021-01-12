<?php
header('Access-Control-Allow-Origin:*');
$usuario = $_POST['login__email'];
$password = $_POST['login__password'];
if (empty($usuario) || empty($password)) {
    exit("Usuario o Contraseña no Digitados");
}

$login = new Login(new Connexion);
$login->setemail($usuario);
$login->setpasword($password);
$row = $login->signIn();

if ($row) {

    $session = new Session();
    $session->addValue('links__id_user', $row['id']);
    echo "defaultValue";

} else {
    echo "No existe registro";
}