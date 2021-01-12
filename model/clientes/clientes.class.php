<?php

class clientes
{
    private static $tablename = "users";

    private $con;

    private $id;
    private $nombre; 
    private $apellido;  
    private $email;
    private $password; 
    private $whatsapp;
    private $enabled; 
    private $imagen;
    private $email_verified_at;
    private $remember_token;
    private $created_at;
    private $updated_at;
    private $telefono;



    function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    //variables
    public function setpk($name)
    {
        $this->id = $this->con->real_escape_string($name);
    }
    public function setnombre($name)
    {
        $this->nombre = $this->con->real_escape_string($name);
    }
    public function settelefono($name)
    {
        $this->telefono = $this->con->real_escape_string($name);
    }
    public function setemail($name)
    {
        $this->email = $this->con->real_escape_string($name);
    }
    public function setpassword($name)
    {
        $this->password = $this->con->real_escape_string($name);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }
    public function setwhatsapp($name)
    {
        $this->whatsapp = $this->con->real_escape_string($name);
    }
    public function setenabled($name)
    {
        $this->enabled = $this->con->real_escape_string($name);
    }
    public function setimagen($name)
    {
        $this->imagen = $this->con->real_escape_string($name);
    }
    public function setemail_verified_at($name)
    {
        $this->email_verified_at = $this->con->real_escape_string($name);
    }
    public function setremember_token($name)
    {
        $this->remember_token = $this->con->real_escape_string($name);
    }
    public function setcreated_at($name)
    {
        $this->created_at = $this->con->real_escape_string($name);
    }
    public function setupdated_at($name)
    {
        $this->updated_at = $this->con->real_escape_string($name);
    }
    
    


    //selecteds

    public function getAll()
    {
        $query = "SELECT * FROM " . self::$tablename . " ORDER BY id DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllById()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE id=$this->id";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllByEmail()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE email='$this->email'";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }

    //FUNCIONES
    public function insert()
    {

        $query = "INSERT INTO " . self::$tablename . " (`role_id`,`nombres`, `email`, `password`, `whatsapp`, `enabled`, `imagen`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`)";

        $query .= " VALUES ('4','$this->nombre','$this->email','$this->password','$this->whatsapp','$this->enabled','$this->imagen','$this->email_verified_at','$this->remember_token','$this->created_at','$this->updated_at')";

        $this->con->query($query);

        if (mysqli_error($this->con)) {
            $result = mysqli_error($this->con);
            mysqli_close($this->con);
            return $result;
        } else {
            $id_operacion = mysqli_insert_id($this->con);
            mysqli_close($this->con);
            return $id_operacion;
        }
    }
    
    public function update()
    {
        
        $query = "UPDATE " . self::$tablename . "  SET counter= LAST_INSERT_ID(counter) + 1 ";
        

        $query .= " WHERE id='$this->id'";
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

    public function update1()
    {
        
        $query = "UPDATE " . self::$tablename . "  SET nombres='$this->nombre', telefono='$this->telefono'";
        

        $query .= " WHERE id='$this->id'";
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

    public function update2()
    {
        
        if(empty($this->password))
        {
            $query = "UPDATE " . self::$tablename . "  SET email='$this->email'";
        }
        else
        {
            $query = "UPDATE " . self::$tablename . "  SET email='$this->email', password='$this->password'";
        }
        

        $query .= " WHERE id='$this->id'";
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
        $query = "DELETE FROM " . self::$tablename . " WHERE id=$this->id";
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