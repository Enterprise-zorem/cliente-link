<?php

class links_counters
{
    private static $tablename = "links_counters";

    private $con;

    private $id;
    private $short_link_id; //clase short_links
    private $platform;  //plataforma android o windows  o mac 
    private $browser; //navegador web
    private $geolocation; //array de la ip
    private $ismobile; //si es un mobil 0 - 1
    private $counter;
    private $continent; //continente
    private $country; // pais
    private $created_at;
    private $updated_at;


    function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    //variables
    public function setpk($name)
    {
        $this->id = $this->con->real_escape_string($name);
    }
    public function setshort_link_id($name)
    {
        $this->short_link_id = $this->con->real_escape_string($name);
    }
    public function setplatform($name)
    {
        $this->platform = $this->con->real_escape_string($name);
    }
    public function setbrowser($name)
    {
        $this->browser = $this->con->real_escape_string($name);
    }
    public function setgeolocation($name)
    {
        $this->geolocation = $name;
    }
    public function setismobile($name)
    {
        $this->ismobile = $this->con->real_escape_string($name);
    }
    public function setcounter($name)
    {
        $this->counter = $this->con->real_escape_string($name);
    }
    public function setcontinent($name)
    {
        $this->continent = $this->con->real_escape_string($name);
    }
    public function setcountry($name)
    {
        $this->country = $this->con->real_escape_string($name);
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

    public function getAllByShortLinkId()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE short_link_id=$this->short_link_id";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }

    //FUNCIONES
    public function insert()
    {

        $query = "INSERT INTO `links_counters`(`short_link_id`, `platform`, `browser`, `geolocation`, `ismobile`, `counter`, `continent`, `country`, `created_at`, `updated_at`)";

        $query .= " VALUES ('$this->short_link_id','$this->platform','$this->browser','".json_encode($this->geolocation)."','$this->ismobile','$this->counter','$this->continent','$this->country','$this->created_at','$this->updated_at')";

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
        
        $query = "UPDATE " . self::$tablename . "  SET `direccion`='$this->direccion',`nombres`='$this->nombres',`telefono`='$this->telefono',`identificacion`='$this->identificacion',`correo`='$this->correo',`password`='$this->password'";
        

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
    public function delete_link_id()
    {
        $query = "DELETE FROM " . self::$tablename . " WHERE short_link_id=$this->short_link_id";
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