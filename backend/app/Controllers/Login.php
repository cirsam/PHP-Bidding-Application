<?php namespace Bidding\Controllers;

use Bidding\Models\LoginModel as LoginModels;
use Bidding\Interfaces\ILoginSystem as ILoginSystem;
use \Bidding\Models\DBconnect as DB;

class Login implements ILoginSystem
{
        function __contstuct()
        {
            $this->mysqli = new DB;
        }

        function index(){

            return "This is the Login page of the Bidding API";

        }

        public function signUp($request)
        {
            if(!isset($request['method']) OR $request['method']==null)
            {
                $params = explode("/", rtrim($request['uri']));
                $username = $params[2];
                $password = $params[3];
                $passwordConfirm = $params[4];
                $email = $params[5];
                $firstname = $params[6];
                $lastname = $params[7];
            }
            else
            {
                $username = $request['username'];
                $password = $request['password'];
                $passwordConfirm = $request['passwordConfirm'];
                $email = $request['email'];	
                $firstname = $request['firstname'];	
                $lastname = $request['lastname'];	
            }

            $model = new LoginModels;
            $result = $model->signUp($username, $password, $passwordConfirm, $email, $firstname, $lastname);

           return $result;
        }

        public function signIn($params)
        {

        }
        
        public function signOut()
        {

        }

}

?>