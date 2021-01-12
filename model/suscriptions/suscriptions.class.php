<?php

class suscriptions
{
    private static $tablename = "suscriptions";

    private $con;

    private $pk_suscriptions;
    private $user_id; 
    private $plan_id;  
    private $started_at;
    private $finish_at; 
    private $renewal;
    private $ended_at;
    private $renewal_cancelled_at;
    private $created_at;


    function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    //variables
    public function setpk($name)
    {
        $this->pk_suscriptions = $this->con->real_escape_string($name);
    }
    public function setuser_id($name)
    {
        $this->user_id = $this->con->real_escape_string($name);
    }
    public function setplan_id($name)
    {
        $this->plan_id = $this->con->real_escape_string($name);
    }
    public function setstarted_at($name)
    {
        $this->started_at = $this->con->real_escape_string($name);
    }
    public function setfinish_at($name)
    {
        $this->finish_at = $this->con->real_escape_string($name);
    }
    public function setrenewal($name)
    {
        $this->renewal = $this->con->real_escape_string($name);
    }
    public function setended_at($name)
    {
        $this->ended_at = $this->con->real_escape_string($name);
    }
    public function setrenewal_cancelled_at($name)
    {
        $this->renewal_cancelled_at = $this->con->real_escape_string($name);
    }
    public function setcreated_at($name)
    {
        $this->created_at = $this->con->real_escape_string($name);
    }
    
    


    //selecteds

    public function getAll()
    {
        $query = "SELECT * FROM " . self::$tablename . " ORDER BY pk_suscriptions DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllisActive()
    {
        $query = "SELECT * FROM " . self::$tablename . " where is_active=1 ORDER BY pk_suscriptions DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllByUser()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE user_id=$this->user_id ORDER BY pk_suscriptions DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }

    //FUNCIONES
    public function insert()
    {

        $query = "INSERT INTO " . self::$tablename . "(`user_id`, `plan_id`, `started_at`, `finish_at`, `created_at`)";

        $query .= " VALUES ('$this->user_id','$this->plan_id','$this->started_at','$this->finish_at','$this->created_at')";

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
        

        $query .= " WHERE pk_suscriptions='$this->pk_suscriptions'";
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
        $query = "DELETE FROM " . self::$tablename . " WHERE pk_suscriptions=$this->pk_suscriptions";
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