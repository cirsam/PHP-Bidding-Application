<?php
require_once '../Controllers/Validate.php';
require_once '../Models/DBconnect.php';

class CalculatorTest extends PHPUnit\Framework\TestCase
{
	public function testValidateUserCredentials_all_null()
	{
        $validateCredentials = New Validate;
        $oldpassword = "";
        $password1 = "";
        $password2 = "";

		$result = $validateCredentials->checkUserDataChangePassword($password1,$password2,$oldpassword);
		$this->assertEquals("Your old password cannot be empty",$result);
    }

	public function testValidateUserCredentials_password1_null()
	{
        $validateCredentials = New Validate;
        $oldpassword = "Testpassword2";
        $password1 = "";
        $password2 = "";

		$result = $validateCredentials->checkUserDataChangePassword($password1,$password2,$oldpassword);
		$this->assertEquals("You forgot to put in your password",$result);
    }

	public function testValidateUserCredentials_password2_null()
	{
        $validateCredentials = New Validate;
        $oldpassword = "Testpassword2";
        $password1 = "Testpassword1";
        $password2 = "";

		$result = $validateCredentials->checkUserDataChangePassword($password1,$password2,$oldpassword);
		$this->assertEquals("You forgot to put in your confirmation password",$result);
    }

    public function testValidateUserCredentials_password_lessthan5()
	{
        $validateCredentials = New Validate;
        $oldpassword = "Testpassword2";
        $password1 = "Testpassword1";
        $password2 = "Testpassword1";

        $result = $validateCredentials->checkUserDataChangePassword($password1,$password2,$oldpassword);
		$this->assertEquals("Your new passwords is too short",$result);
    }
    
	public function testValidateUserCredentials()
	{
        $validateCredentials = New Validate;
        $oldpassword = "Testpassword2";
        $password1 = "Testpassword1";
        $password2 = "Testpassword1";

		$result = $validateCredentials->checkUserDataChangePassword($password1,$password2,$oldpassword);
		$this->assertEquals("",$result);
	}


}