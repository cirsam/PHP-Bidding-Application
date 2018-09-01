<?php
require_once '../index.php';
use \Bidding\Controllers\Login as Login;
use \Bidding\Models\Connectors as Connectors;

class LoginSystemTest extends PHPUnit\Framework\TestCase
{
	public function loginIndexPageShouldReturnString()
	{
		$login = New Login;
		$result = $login->index();
		$this->assertEquals("This is the Login page of the Bidding API",$result);
	}

	//Signup process test
	public function testSignUpPasswordMatchSucess()
	{	
		$login = new Login;
		$params = array("username"=>"cirsam","password"=>"test","passwordConfirm"=>"test","email"=>"cirsam@gmail.com","firstname"=>"Samuel","lastname"=>"Antwi","method"=>"post");		
		$signUp = $login->signUp($params);
		$this->assertSame("The user has been created",$signUp);
	}
	
	public function testSignUpPasswordMatchUserAlreadyExist()
	{
		$login = new Login;
		$params = array("username"=>"cirsam","password"=>"test","passwordConfirm"=>"test","email"=>"cirsam@gmail.com","firstname"=>"Samuel","lastname"=>"Antwi","method"=>"post");		
		$signUp = $login->signUp($params);
		$this->assertSame("The user already exist",$signUp);
	}

	public function testSignUpPasswordDoesNotMatch()
	{
		$login = new Login;
		$params = array("username"=>"cirsam","password"=>"test","passwordConfirm"=>"test1","email"=>"cirsam@gmail.com","firstname"=>"Samuel","lastname"=>"Antwi","method"=>"post");		
		$signUp = $login->signUp($params);
		$this->assertSame("The password does not match",$signUp);
	}

	public function testSignUpUserIsNull()
	{
		$login = new Login;
		$params = array("username"=>"","password"=>"","passwordConfirm"=>"","email"=>"","firstname"=>"","lastname"=>"",""=>"","method"=>"post");		
		$signUp = $login->signUp($params);
		$this->assertSame("Complete the form",$signUp);
	}

}


