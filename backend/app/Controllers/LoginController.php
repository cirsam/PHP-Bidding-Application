<?php namespace Bidding\Controllers;
//echo "goet here";
use Bidding\Models\LoginModel as Login;
use Controllers\HomeController;

class LoginController extends Login
{
        function __contstuct()
        {
            echo "this is the controller";
        }

        function index(){
            echo "this is the index";
        }

}
$test = new LoginController();

?>