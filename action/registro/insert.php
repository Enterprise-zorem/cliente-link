<?php
header('Access-Control-Allow-Origin:*');
$nombre = $_POST['registro__nombre'];
$email = $_POST['registro__email'];
$password = $_POST['registro__password'];
if (empty($email) || empty($password)|| empty($nombre)) {
    exit("Usuario o Contraseña o Nombre no Digitados");
}


function insert()
{  
    
    $cliente=new clientes(new Connexion);
    $cliente->setemail($_POST['registro__email']);
    $cliente=$cliente->getAllByEmail();
    $cliente=$cliente->fetch_array(MYSQLI_ASSOC);
    if($cliente)
    {
        //hay datos 
        return "El correo ya se encuentra registrado";
    }
    else
    {   //registrar cliente
        $cliente=new clientes(new Connexion);
        $cliente->setnombre($_POST['registro__nombre']);
        $cliente->setemail($_POST['registro__email']);
        $cliente->setpassword($_POST['registro__password']);
        $cliente->setenabled(1);
        $date=new DateTime();
        $datetime=$date->format('Y-m-d H:i:s');
        $cliente->setcreated_at($datetime);
        $cliente->setupdated_at($datetime);
        $result=$cliente->insert();
        if(is_numeric($result))
        {
            //registrado correctamente
            $session=new Session();
            $session->addValue('links__id_user',$result);
            return "defaultValue";
        }
        else
        {
            return $result;
        }
    }

}

echo insert();