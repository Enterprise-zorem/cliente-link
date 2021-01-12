<?php

/**
 * 
 */
class Login
{
    public static $tablename = "users";
    public static $create_at = "NOW()";

    private $con;

    public $pk_usuario;
    public $pasword;
    public $correo;
    public $is_active;


    function __construct(Connexion $con)
    {
        $this->con = $con;
    }
    //variables
    public function setpkusuario($name)
    {
        $this->pk_usuario = $this->con->real_escape_string($name);
    }
    public function setpasword($name)
    {
        $this->pasword = $this->con->real_escape_string($name);
    }
    public function setemail($name)
    {
        $this->correo = $this->con->real_escape_string($name);
    }
    public function setaudanulado($name)
    {
        $this->is_active = $this->con->real_escape_string($name);
    }


    public function signIn()
    {
        $row = $this->getArrayQueryResult();

        if ($row) {
            if ($this->passwordVerify($row['password'])) {
                return $row;
            }
        }
        return false;
    }
    public function signIn2()
    {
        $row2 = $this->getArrayQueryResult2();

        if ($row2) {
            if ($this->passwordVerify($row2['password'])) {
                return $row2;
            }
        }
        return false;
    }
    public function getArrayQueryResult2()
    {
        $query = "SELECT * FROM usuario WHERE usuario='$this->correo'";
        $result = $this->con->query($query);
        return $result->fetch_array(MYSQLI_ASSOC);
    }

    public function getAllById()
    {
        $query = "SELECT * FROM usuario where pk_usuario=$this->pk_cliente";
        $res = $this->con->query($query);
        return $res;
    }

    public function getArrayQueryResult()
    {
        $query = "SELECT * from " . self::$tablename . " where email='$this->correo'";
        $result = $this->con->query($query);
        return $result->fetch_array(MYSQLI_ASSOC);
    }
    public function passwordVerify($password)
    {
        return  password_verify($this->pasword, $password);
    }


    public function getAll()
    {
        $query = "SELECT * FROM " . self::$tablename . "";
        $res = $this->con->query($query);
        return $res;
    }
}