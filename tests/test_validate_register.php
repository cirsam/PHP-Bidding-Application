<?php
require_once '../Controllers/Validate.php';
require_once '../Models/DBconnect.php';

class RegisterUserTest extends PHPUnit\Framework\TestCase
{
	public function testValidateUserCredentials_username_null()
	{
        $validateCredentials = New Validate;
        $username = "";
        $email = "";
        $password1 = "";
        $password2 = "";
        $fullname = "";

		$result = $validateCredentials->checkUserDataRegister($username, $email, $password1, $password2,$fullname);
		$this->assertEquals("Your have to put in a username",$result);
    }

	public function testValidateUserCredentials_username_lesthan5()
	{
        $validateCredentials = New Validate;
        $username = "Testu";
        $email = "";
        $password1 = "";
        $password2 = "";
        $fullname = "";

		$result = $validateCredentials->checkUserDataRegister($username, $email, $password1, $password2,$fullname);
		$this->assertEquals("Your email address cannot be empty",$result);
    }

	public function testValidateUserCredentials_username_containsASCII()
	{
        $validateCredentials = New Validate;
        $username = "Testusername^&";
        $email = "";
        $password1 = "";
        $password2 = "";
        $fullname = "";

		$result = $validateCredentials->checkUserDataRegister($username, $email, $password1, $password2,$fullname);
		$this->assertEquals("Your username must contain only letters and numbers",$result);
    }

	public function testValidateUserCredentials_email_lessthan5()
	{
        $validateCredentials = New Validate;
        $username = "Testpassword2";
        $email = "";
        $password1 = "";
        $password2 = "";
        $fullname = "";

		$result = $validateCredentials->checkUserDataRegister($username, $email, $password1, $password2,$fullname);
		$this->assertEquals("Your email address cannot be empty",$result);
    }

	public function testValidateUserCredentials_invalid_email()
	{
        $validateCredentials = New Validate;
        $username = "Testpassword2";
        $email = "cirsam@";
        $password1 = "";
        $password2 = "";
        $fullname = "";

		$result = $validateCredentials->checkUserDataRegister($username, $email, $password1, $password2,$fullname);
		$this->assertEquals("The email address you put in is not invalid.",$result);
    }

	public function testValidateUserCredentials_password1_null()
	{
        $validateCredentials = New Validate;
        $username = "Testpassword2";
        $email = "cirsam@testmail.com";
        $password1 = "";
        $password2 = "";
        $fullname = "";

		$result = $validateCredentials->checkUserDataRegister($username, $email, $password1, $password2,$fullname);
		$this->assertEquals("You forgot to put in your password",$result);
    }

	public function testValidateUserCredentials_password2_null()
	{
        $validateCredentials = New Validate;
        $username = "Testpassword2";
        $email = "cirsam@testmail.com";
        $password1 = "Testpassword1";
        $password2 = "";
        $fullname = "";

		$result = $validateCredentials->checkUserDataRegister($username, $email, $password1, $password2,$fullname);
		$this->assertEquals("You forgot to put in your password again",$result);
    }

    public function testValidateUserCredentials_password_lessthan5()
	{
        $validateCredentials = New Validate;
        $username = "Testpassword2";
        $email = "cirsam@testmail.com";
        $password1 = "Testp";
        $password2 = "Testp";
        $fullname = "";

		$result = $validateCredentials->checkUserDataRegister($username, $email, $password1, $password2,$fullname);
		$this->assertEquals("Your passwords is too short",$result);
    }

    public function testValidateUserCredentials_passwords_do_not_match()
	{
        $validateCredentials = New Validate;
        $username = "Testpassword2";
        $email = "cirsam@testmail.com";
        $password1 = "Testpassword1";
        $password2 = "Testpassword2";
        $fullname = "";

		$result = $validateCredentials->checkUserDataRegister($username, $email, $password1, $password2,$fullname);
		$this->assertEquals("Sorry but your passwords do not match",$result);
    }
    
	public function testValidateUserCredentials_fullname_null()
	{
        $validateCredentials = New Validate;
        $username = "Testpassword2";
        $email = "cirsam@testmail.com";
        $password1 = "Testpassword1";
        $password2 = "Testpassword1";
        $fullname = "";

		$result = $validateCredentials->checkUserDataRegister($username, $email, $password1, $password2,$fullname);
		$this->assertEquals("Your fullname cannot be empty",$result);
	}
    
	public function testValidateUserCredentials_fullname_lessthan6()
	{
        $validateCredentials = New Validate;
        $username = "Testpassword2";
        $email = "cirsam@testmail.com";
        $password1 = "Testpassword1";
        $password2 = "Testpassword1";
        $fullname = "Sam";

		$result = $validateCredentials->checkUserDataRegister($username, $email, $password1, $password2,$fullname);
		$this->assertEquals("Your fullname is too short",$result);
	}
    
	public function testValidateUserCredentials_user_already_exists()
	{
        $validateCredentials = New Validate;
        $username = "Testpassword2";
        $email = "cirsam@testmail.com";
        $password1 = "Testpassword1";
        $password2 = "Testpassword1";
        $fullname = "Samuel Antwi";

		$result = $validateCredentials->checkUserDataRegister($username, $email, $password1, $password2,$fullname);
		$this->assertEquals("",$result);
	}


}