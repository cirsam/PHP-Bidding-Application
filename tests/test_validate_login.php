<?php
require_once '../Controllers/Validate.php';
require_once '../Models/DBconnect.php';

class RegisterUserTest extends PHPUnit\Framework\TestCase
{
	public function testValidateUserCredentials_username_null()
	{
        $validateCredentials = New Validate;
        $username = "";
        $password = "Testpassword";

		$result = $validateCredentials->checkUserDataLogin($username,$password);
		$this->assertEquals("Your have to put in a username",$result);
    }

	public function testValidateUserCredentials_username_lessthan5()
	{
        $validateCredentials = New Validate;
        $username = "Testu";
        $password = "Testpassword";

		$result = $validateCredentials->checkUserDataLogin($username,$password);
		$this->assertEquals("Your username is too short",$result);
    }

	public function testValidateUserCredentials_username_containsASCII()
	{
        $validateCredentials = New Validate;
        $username = "Testusername^&";
        $password = "Testpassword";

		$result = $validateCredentials->checkUserDataLogin($username,$password);
		$this->assertEquals("Your username must contain only letters and numbers",$result);
    }

	public function testValidateUserCredentials_password_null()
	{
        $validateCredentials = New Validate;
        $username = "Testusername";
        $password = "";

		$result = $validateCredentials->checkUserDataLogin($username,$password);
		$this->assertEquals("You forgot to put in your password",$result);
    }

	public function testValidateUserCredentials_password_lessthan6()
	{
        $validateCredentials = New Validate;
        $username = "Testusername";
        $password = "Testp";

		$result = $validateCredentials->checkUserDataLogin($username,$password);
		$this->assertEquals("Your password is too short",$result);
    }

/* 	public function testValidateUserCredentials_user_already_exists()
	{
        $validateCredentials = New Validate;
        $username = "Testusername";
        $password = "Testpaword";

        $result = $validateCredentials->checkUserDataLogin($username,$password);
        $validateCredentials->getCheckUserData($username, $password);
		$this->assertEquals("Your account has not been created yet. You need to create an account",$result);
    } */

}