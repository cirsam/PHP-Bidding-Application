<?php
require_once("../Models/DBconnect.php");
require_once("../Controllers/Validate.php");

class Changepassword extends DBconnect
{
    private $mysqli;
    private $oldpassword;
    private $password;
    private $msgs;

    function __construct()
    {

    }

    public function changerUserPassword()
    {
        $validate = new Validate;

        if(($msgs = $validate->checkUserDataChangePassword($this->password1,$this->password2,$this->oldpassword)) != null)
        {
            header('Location:/html/register.php?msg='.$msgs.'&status=fail');
            die();
        }

        $mysqli = parent::__construct();
        $stmt = $mysqli->prepare("Update users SET password=? WHERE userid=?");
        $stmt->bind_param('ss',$password,$userid);

        $userid = $_SESSION["userid"];
        $password = $mysqli->escape_string(hash("sha512",$this->password1));

        if(!$stmt->execute())
        {
            echo "execution fialed";
        }

        header('Location:/html/changepassword.php?msg=Your password has been changed: '.$_SESSION["fullname"].'&status=success');
        die();
    }

    function __set($name,$value)
    {
        if($name=="oldpassword"){
            $this->oldpassword = $value;
        }
        if($name=="password1"){
            $this->password1 = $value;
        }
        if($name=="password2"){
            $this->password2 = $value;
        }
    }
}

$newrgister = new Changepassword;

if (isset($_POST["oldpassword"])) 
{
    $newrgister->oldpassword = $_POST["oldpassword"];    
}

if (isset($_POST["password1"])) 
{
    $newrgister->password1 = $_POST["password1"];
}

if (isset($_POST["password2"])) 
{
    $newrgister->password2 = $_POST["password2"];
}

$newrgister-> changerUserPassword();

