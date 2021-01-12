<?php

class short_links
{
    private static $tablename = "short_links";

    private $con;

    private $id;
    private $user_id; //usuario registrado -- 0 no registrado
    private $link;  //url a la que se redireccionara
    private $token; //codigo para la url corta
    private $type; //link normal o api whatsapp
    private $created_at;
    private $counter; //contador de visitas // tiene otro tabla de contador de visitas por dispositivo rastreando cuantas veces ingresa al link
    private $enabled; // activo e inactivo
    private $updated_at;
    private $title;


    function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    //variables
    public function setpk($name)
    {
        $this->id = $this->con->real_escape_string($name);
    }
    public function setuser_id($name)
    {
        $this->user_id = $this->con->real_escape_string($name);
    }
    public function setlink($name)
    {
        $this->link = $this->con->real_escape_string($name);
    }
    public function settoken($name)
    {
        $this->token = $this->con->real_escape_string($name);
    }
    public function settype($name)
    {
        $this->type = $this->con->real_escape_string($name);
    }
    public function setcreated_at($name)
    {
        $this->created_at = $this->con->real_escape_string($name);
    }
    public function setupdated_at($name)
    {
        $this->updated_at = $this->con->real_escape_string($name);
    }
    public function setcounter($name)
    {
        $this->counter = $this->con->real_escape_string($name);
    }
    public function setenabled($name)
    {
        $this->enabled = $this->con->real_escape_string($name);
    }
    public function settitle($name)
    {
        $this->title = $this->con->real_escape_string($name);
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

    public function getAllByToken()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE token='$this->token'";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    
    public function getAllByuser_id()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE user_id='$this->user_id'";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }

    //FUNCIONES
    public function insert()
    {

        $query = "INSERT INTO " . self::$tablename . " ( `title`,`user_id`,`link`, `token`, `type`, `created_at`, `updated_at`, `counter`, `enabled`)";

        $query .= " VALUES ('$this->title','$this->user_id','$this->link','$this->token','$this->type','$this->created_at','$this->updated_at','$this->counter','$this->enabled')";

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
        
        $query = "UPDATE " . self::$tablename . "  SET title='$this->title', token='$this->token',updated_at='$this->updated_at' ";
        

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
        
        $query = "UPDATE " . self::$tablename . "  SET title='$this->title',updated_at='$this->updated_at' ";
        

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
    public function update_counter()
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