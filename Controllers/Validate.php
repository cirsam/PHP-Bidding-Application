<?php
require_once(__DIR__."/IValidate.php");
require_once(__DIR__."/../Models/DBconnect.php");

class Validate  extends DBconnect implements IValidate
{
    private $userdata;
    
    function __construct(){
 
    }

   public function checkUserDataRegister($username, $email, $password1, $password2,$fullname)
   {
        if (trim($username)==="") 
        {
            return "Your have to put in a username";
        }
        
        if (strlen($username)<5) 
        {
            return "Your username is too short";
        }
        
        if (preg_match('/[^A-Za-z-0-9]/', $username)) 
        {
            return "Your username must contain only letters and numbers";
        }
        
        if (trim($email) == "") 
        {
            return "Your email address cannot be empty";
        }
        
        if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) 
        {
            return "The email address you put in is not invalid.";
        }
        
        if (trim($password1) == "") 
        {
            return "You forgot to put in your password";
        }
        
        if (trim($password2) == "") 
        {
            return "You forgot to put in your password again";
        }
        
        if (trim($password1) != trim($password2)) 
        {
            return "Sorry but your passwords do not match";
        }
        
        if (strlen($password1) < 6) 
        {
            return "Your passwords is too short";
        }
        
        if($this->userExists($username, $email))
        {
            return "A user with your username or email already esist in the system";
        }        
    }

   public function checkUserDataChangePassword($password1,$password2,$oldpassword)
   {
        if (trim($oldpassword)==="") 
        {
            return "Your old password cannot be empty";
        }
        
        if (strlen($oldpassword)<5) 
        {
            return "Your username is too short";
        }
        
        if (trim($password1) == "") 
        {
            return "You forgot to put in your password";
        }
        
        if (trim($password2) == "") 
        {
            return "You forgot to put in your confirmation password";
        }
        
        if (trim($password1) != trim($password2)) 
        {
            return "Sorry but your new passwords do not match";
        }
        
        if (strlen($password1) < 6) 
        {
            return "Your new passwords is too short";
        }      
    }

   public function checkUserDataLogin($username,$password)
   {
        if (trim($username) == "") 
        {
            return "Your have to put in a username";
        }
        
        if (strlen($username)<5) 
        {
            return "Your username is too short";
        }
        
        if (preg_match( '/[^A-Za-z-0-9]/', $username)) 
        {
            return "Your username must contain only letters and numbers";
        }
        
        if (trim($password) == "") 
        {
            return "You forgot to put in your password";
        }
        
        if (strlen($password) < 6) 
        {
            return "Your password is too short";
        }
        
        //validate assci char
        if(count($this->getCheckUserData($username, $password))==0)
        {
            return "Your account has not been created yet. You need to create an account";
        }
    }

    function userExists($username, $email)
    {
        //echo $username;
        $mysqli = parent::__construct();
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE username=? || email=?");
        $stmt->bind_param('ss', $username, $email);
        $username = $username;
        $email = $email;

        /* execute prepared statement */
        if(!$stmt->execute())
        {
            echo "execution fialed";
        }

        $result = $stmt->get_result();

        if($result->num_rows==0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    function getCheckUserData($username, $password)
    {
        $mysqli = parent::__construct();
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE username=? && password=?");
        $stmt->bind_param('ss', $username, $hash);
        $username = $username;
        $hash = hash("sha512", $password);

        /* execute prepared statement */
        if(!$stmt->execute())
        {
            echo "execution fialed";
        }

        $result = $stmt->get_result(); 
        $row = $result->fetch_assoc();

        return $row;
    }
}
?>