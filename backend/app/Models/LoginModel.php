<?php namespace Bidding\Models;
use \Bidding\Models\DBconnect as DB;

class LoginModel
{
    function __construct()
    {
    }

    public function signUp($username,$password,$passwordConfirm,$email,$firstname,$lastname)
    {
        if($username!=null && $email!=null && $password!=null && $passwordConfirm!=null)
        {
            if($password === $passwordConfirm)
            {
                $localhost = "localhost";
                $username = "datumuser";
                $password = "datumadmin";
                $database = "datumbidding";
                $con = new \mysqli($localhost,$username,$password,$database);
                echo "got here";
        /*         $conn = new DB;
                //$result_user = $conn->query("Select * From users");
                //print_r($result_user);
                // $mysqle = parent::connect();
                //$mysqle->connect();
             /*   $mysqli = $mysqle->getConnection();
                print_r($mysqle->getConnection());
                print_r($mysqle->getConnection()); */

/*                 if(self::checkUser($email)===false)
                {
					$stmt = $mysqli->prepare("INSERT INTO users (username, password, email, firstname, lastname,hash, last_login) VALUES( ?,?,?,?,?,?,?)");
					$stmt->bind_param('sssssss', $username, $password, $email, $firstname, $lastname, $hash, $time);
					$username = $username;
					$password = $password;
					$hash = hash('sha512', $password);
					$email = $email;
					$firstname = $firstname;
					$lastname = $lastname;
					$time = time();

                    $stmt->execute();
                } */
            }
            else
            {
				return "The password does not match";	
			}
		}else{
			return "Complete the form";
		}		
	}	

    public function signIn($params)
    {

    }
    
    public function signOut()
    {

    }


    public function checkUser($email){
        $mysqli = $this->mysqli;
		
		$query = 'SELECT * FROM users WHERE email = "'.$email.'"';			 
		$result = $mysqli->query($query);
		if($result->num_rows > 0) {
			return true;
		}else{
			return false;
		}		
	}	
	
/* 	public function checkEmailConfirmed($email){
		$mysqle = new DB;
		$mysqli = $mysqle->mysqli;
		
		$query = 'SELECT * FROM users WHERE email = "'.$email.'" AND status=1';			 
		$result = $mysqli->query($query);
		if($result->num_rows > 0) {
			return true;
		}else{
			return false;
		}		
	} */

}

?>