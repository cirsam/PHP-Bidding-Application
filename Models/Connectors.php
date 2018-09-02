<?php
class Connector
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
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) 
            {
                throw new Exception("<h1 style=\"color:red;\" >Could not connect.</h1>");
                die();     
            }
            else
            {
                return $conn;
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
/*     function __get($username){
       $this->username = $username;

      switch($name){
            case "username":
            case "password":
                $this->password = $name;
            case "database":
                $this->database = $name;
        } 
    } */

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
        mysqli_close($this->connect());
    }
}

$newconnent = NEW Connector();

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