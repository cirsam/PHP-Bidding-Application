
<?php
require_once("../Models/DBconnect.php");
require_once("../Controllers/Validate.php");

class Login
{
    private $mysqli;
    private $fullname;
    private $password;

    function __construct()
    {
    }

    public function logUserIn()
    {
        $validate = new Validate;

        if(($msg = $validate->checkUserDataLogin($this->username,$this->password)) != null)
        {
           	header('Location:/html/login.php?msg='.$msg.'&status=fail');
            die();
		}

		$userdata = $validate->getCheckUserData($this->username, $this->password);
		$_SESSION["userid"] = $userdata["userid"]; 
		$_SESSION["username"] = $userdata["username"]; 
		$_SESSION["fullname"] = $userdata["fullname"]; 
		$_SESSION["email"] = $userdata["email"];
		$_SESSION["islogined"] = true;

		header('Location:/html/home.php');
		
        die();
    }

    function __set($name,$value)
    {
        switch($name)
        {
            case "username":
                $this->username = $value;
            case "password":
                $this->password = $value;
        }
    }

}

$newLogin = new Login;

if (isset($_POST["username"])) 
{
    $newLogin->username = $_POST["username"];    
}

if (isset($_POST["password"])) 
{
    $newLogin ->password = $_POST["password"];
}

$newLogin -> LogUserIn();

