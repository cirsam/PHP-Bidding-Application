<?php
abstract class DBconnect
{
    const servername = "localhost";
    const username = "datumuser";
    const password = "datumadmin";
    const database = "datumbidding";
    private $dbconnect;
    public $msg;

    function __construct()
    {
        if(!session_id())
        {
            session_start();
        }

        try
        {
            $this->dbconnect = new mysqli(DBconnect::servername,DBconnect::username,DBconnect::password,DBconnect::database);

            $this->msg ="connected";

            return $this->dbconnect;
        }
        catch(\Exception $e)
        {
            $this->msg = "failed";
        }
    }


    function __destruct()
    {
        mysqli_close($this->dbconnect);
    }
}
?>