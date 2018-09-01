<?php namespace Bidding\Controllers;

use Bidding\Models\LoginModel as LoginModel;
use Controllers\HomeController;
use Bidding\Interfaces\ILoginSystem as ILogin;

class Login extends LoginModel implements ILogin
{
        function __contstuct()
        {
           
        }

        function index(){

            return "This is the Login page of the Bidding API";

        }

        public function signUp($params)
        {

        }

        public function signIn($params)
        {

        }
        
        public function signOut()
        {

        }

}

?>