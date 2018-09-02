<?php
class Connectors
{  
    private $username;
    private $password;
    private $database;
    private $conn;

    public function __construct()
    {

    }
	
    public function connect()
    {      
        $servername = "localhost";
        $username = $this->username;
        $password = $this->password;
        $dbname = $this->database;

        try
        {
            // Create connection
            $this->conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($this->conn->connect_error) 
            {
                throw new Exception("<h1 style=\"color:red;\" >Could not connect.</h1>");
                die();     
            }
            else
            {
                return $this->conn;
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    function __set($name,$value)
    {
        switch($name)
        {
            case "username":
                $this->username = $value;
            case "password":
                $this->password = $value;
            case "database":
                $this->database = $value;
        }
    }

    function __destruct()
    {
       // mysqli_close($this->conn);
    }
}

$newconnent = NEW Connectors();

if(isset($_REQUEST["setup"]) && $_REQUEST["setup"]!="true")
{
    $newconnent->username = $_REQUEST["username"];
    $newconnent->password = $_REQUEST["password"];
    $newconnent->database = $_REQUEST["database"];
}
else
{
    $newconnent->username = "datumuser";
    $newconnent->password = "datumadmin";
    $newconnent->database = "datumbidding";
}
?>