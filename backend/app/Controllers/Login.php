<?php namespace Bidding\Controllers;
//echo "goet here";
use Bidding\Models\LoginModel as LoginModel;
use Controllers\HomeController;

class Login extends LoginModel
{
        function __contstuct()
        {
            echo "this is the controller";
        }

        function index(){
            echo "this is the index";
        }

}

?>