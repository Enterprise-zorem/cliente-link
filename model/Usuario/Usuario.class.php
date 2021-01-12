<?php


/**
 * 
 */
class Usuario
{
    private static $tablename = "usuario";
    private static $create_at = "NOW()";

    private $con;

    private $pk_usuario;
    private $usuario;
    private $password;
    private $empresa;

    function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    //variables
    public function setpk($name)
    {
        $this->pk_usuario = $this->con->real_escape_string($name);
    }
    public function setusuario($name)
    {
        $this->usuario = $this->con->real_escape_string($name);
    }
    public function setpassword($name)
    {
        $this->password = $this->con->real_escape_string($name);
    }
    public function setempresa($name)
    {
        $this->password = $this->con->real_escape_string($name);
    }
    


    //selecteds

    public function getAll()
    {
        $query = "SELECT * FROM " . self::$tablename . " ORDER BY pk_usuario DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllById()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE pk_usuario=$this->pk_usuario";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }

    public function getAllByUsuario()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE usuario='$this->usuario'";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }

    //FUNCIONES
    public function insert()
    {

        $query = "INSERT INTO `usuario`( `usuario`, `password`, `empresa`, `created_at`)";

        $query .= " VALUES ('$this->usuario','$this->password','$this->empresa'," . self::$create_at . ")";

        $this->con->query($query);

        if (mysqli_error($this->con)) {
            $result = mysqli_error($this->con);
            mysqli_close($this->con);
            return $result;
        } else {
            mysqli_close($this->con);
            return "defaultValue";
        }
    }
    
    public function update()
    {
        if (empty($this->password)) {
            $query = "UPDATE " . self::$tablename . "  SET `direccion`='$this->direccion',`nombres`='$this->nombres',`telefono`='$this->telefono',`identificacion`='$this->identificacion',`correo`='$this->correo'";
        } else {
            $query = "UPDATE " . self::$tablename . "  SET `direccion`='$this->direccion',`nombres`='$this->nombres',`telefono`='$this->telefono',`identificacion`='$this->identificacion',`correo`='$this->correo',`password`='$this->password'";
        }

        $query .= " WHERE pk_usuario='$this->pk_usuario'";
        $this->con->query($query);

        if (mysqli_error($this->con)) {
            $result = mysqli_error($this->con);
            mysqli_close($this->con);
            return $result;
        } else {
            mysqli_close($this->con);
            return "defaultValue";
        }
    }
   
    public function delete()
    {
        $query = "DELETE FROM " . self::$tablename . " WHERE pk_usuario=$this->pk_usuario";
        $this->con->query($query);

        if (mysqli_error($this->con)) {
            $result = mysqli_error($this->con);
            mysqli_close($this->con);
            return $result;
        } else {
            mysqli_close($this->con);
            return "defaultValue";
        }
    }
}