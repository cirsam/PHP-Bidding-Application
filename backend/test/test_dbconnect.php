<?php namespace Tests;
require_once '../index.php';

use Bidding\Models\DBconnect;

Class TestLoginController extends \PHPUnit\Framework\TestCase
{
    public function testLoginConnected()
    {
		$results = new DBConnect;
		$this->assertSame("connected",$results->msg);
    }
    
    public function testLoginNotConnected()
    {
		$results = new DBConnect;
		$this->assertNotSame("failed",$results->msg);
		$this->assertTrue(True);
	}
}

?>