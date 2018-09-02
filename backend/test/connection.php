<?php namespace Bidding\Models;

use Bidding\Model\DBconnect as DB;
use \mysqli;

class DBconnect
{	
    const servername = "localhost";
    const username = "datumuser";
    const password = "datumadmin";
    const database = "datumbidding";

    public function __construct()
    {
		return $this->Connect();	
	}
	
    private function Connect()
    {
        try
        {
			$this->mysqli = new mysqli('localhost', 'datumuser', 'datumadmin', 'datumbidding');		
			$this->msg = "connected";
        }
        Catch(\Exception $e)
        { 
            echo $e->getMessage();
			$this->msg = "failed";
		}
	}
	
    public function __destruct ()
    {
	/* 	$thread = $this->mysqli->thread_id;
		$this->mysqli->kill($thread);
		$this->mysqli->close(); */
	}	
	
}
?>