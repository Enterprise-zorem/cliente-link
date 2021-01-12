<?php


/**
 * 
 */
class links_reserved
{
    private static $tablename = "links_reserved";

    private $con;

    private $id;
    private $token;
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
    public function settoken($name)
    {
        $this->token = $this->con->real_escape_string($name);
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
    public function getAllByToken()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE token='$this->token'";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }

    //FUNCIONES
    public function insert()
    {

        $query = "INSERT INTO " . self::$tablename . " ( `token`, `created_at`, `updated_at`)";

        $query .= " VALUES ('$this->token','$this->created_at','$this->updated_at')";

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
        
        $query = "UPDATE " . self::$tablename . "  SET `token`='$this->token',`updated_at`='$this->updated_at'";

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