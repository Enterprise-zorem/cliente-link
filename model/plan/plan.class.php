<?php

class plan
{
    private static $tablename = "plan";

    private $con;

    private $pk_plan;
    private $name; 
    private $price_mounth;  
    private $price_yearly;
    private $content; 
    private $is_active;
    private $created_at;
    private $updated_at;



    function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    //variables
    public function setpk($name)
    {
        $this->pk_plan = $this->con->real_escape_string($name);
    }
    public function setname($name)
    {
        $this->name = $this->con->real_escape_string($name);
    }
    public function setprice_mounth($name)
    {
        $this->price_mounth = $this->con->real_escape_string($name);
    }
    public function setprice_yearly($name)
    {
        $this->price_yearly = $this->con->real_escape_string($name);
    }
    public function setcontent($name)
    {
        $this->content = $this->con->real_escape_string($name);
    }
    public function setis_active($name)
    {
        $this->is_active = $this->con->real_escape_string($name);
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
        $query = "SELECT * FROM " . self::$tablename . " ORDER BY pk_plan DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllisActive()
    {
        $query = "SELECT * FROM " . self::$tablename . " where is_active=1 ORDER BY pk_plan DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllById()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE pk_plan=$this->pk_plan";
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
   
    public function delete()
    {
        $query = "DELETE FROM " . self::$tablename . " WHERE pk_plan=$this->pk_plan";
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