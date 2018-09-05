<?php
require_once("../Models/DBconnect.php");
require_once("../Controllers/Validate.php");
require_once("../Auth/ILogin.php");

class Register extends DBconnect implements ILogin
{
    private $mysqli;
    private $fullname;
    private $username;
    private $password;
    private $email;
    private $msgs;

    function __construct()
    {

    }

    public function validateUserInput($params)
    {
        $validate = new Validate;

        if(($msgs = $validate->checkUserDataRegister($this->username,$this->email,$this->password1,$this->password2,$this->fullname)) != null)
        {
            header('Location:/html/register.php?msg='.$msgs.'&status=fail');
            die();
        }
    }

    public function registerUser()
    {
        $params["username"] = $this->username;
        $params["password1"] = $this->password1;
        $params["password2"] = $this->password2;
        $params["fullname"] = $this->fullname;

        $this->validateUserInput($params);
        
        $mysqli = parent::__construct();
        $stmt = $mysqli->prepare("INSERT INTO users (userid,username,fullname,email,password) VALUES( ?,?,?,?,?)");
        $stmt->bind_param('sssss',$userid,$usernames,$fullname,$email,$password);

        $userid = $mysqli->escape_string("");
        $usernames = $mysqli->escape_string($this->username);
        $fullname = $mysqli->escape_string($this->fullname);
        $email = $mysqli->escape_string($this->email);
        $password = $mysqli->escape_string(hash("sha512",$this->password1));

        if(!$stmt->execute())
        {
            echo "execution fialed";
        }

        header('Location:/html/login.php?msg=Your account has successfully been created you may now login&status=success');
        die();
    }

    function __set($name,$value)
    {
        if($name=="fullname"){
            $this->fullname = $value;
        }
        if($name=="username"){
            $this->username = $value;
        }
        if($name=="email"){
            $this->email = $value;
        }
        if($name=="password1"){
            $this->password1 = $value;
        }
        if($name=="password2"){
            $this->password2 = $value;
        }
    }

}

$newrgister = new Register;

if (isset($_POST["usernames"])) 
{
    $newrgister->username = $_POST["usernames"];    
}

if (isset($_POST["email"])) 
{
    $newrgister->email = $_POST["email"];
}

if (isset($_POST["fullname"])) 
{
    $newrgister->fullname = $_POST["fullname"];    
}

if (isset($_POST["password1"])) 
{
    $newrgister->password1 = $_POST["password1"];
}

if (isset($_POST["password2"])) 
{
    $newrgister->password2 = $_POST["password2"];
}

$newrgister-> registerUser();

