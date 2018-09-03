<?php
require_once("../../Models/DBconnect.php");

class AddItems extends DBconnect
{
    private $mysqli;
    private $itemname;
    private $itemdescription;
    private $quantity;
    private $expire_date;
    private $price;
    private $msgs;

    function __construct()
    {

    }

    public function addItems()
    {
        $mysqli = parent::__construct();
        $stmt = $mysqli->prepare("INSERT INTO items (itemid,itemname,itemdescription,userid,expire_date,quantity,price) VALUES( ?,?,?,?,?,?,?)");
        $stmt->bind_param('sssssss',$itemid,$itemname,$itemdescription,$userid,$expire_date,$quantity,$price);

        $itemid = $mysqli->escape_string("");
        $itemname = $mysqli->escape_string($this->itemname);
        $itemdescription = $mysqli->escape_string($this->itemdescription);
        $userid = $_SESSION["userid"];
        $expire_date = $mysqli->escape_string($this->expire_date);
        $quantity = $mysqli->escape_string($this->quantity);
        $price = $mysqli->escape_string($this->price);

        if(!$stmt->execute())
        {
            echo "execution fialed";
        }

        header('Location:/html/home.php?msg=Your item has been added&status=success');
        die();
    }

    function __set($name,$value)
    {
        if($name=="itemname"){
            $this->itemname = $value;
        }
        if($name=="itemdescription"){
            $this->itemdescription = $value;
        }
        if($name=="expire_date"){
            $this->expire_date = $value;
        }
        if($name=="quantity"){
            $this->quantity = $value;
        }
        if($name=="price"){
            $this->price = $value;
        }
    }

}

$newitems = new AddItems;

if (isset($_POST["itemname"])) 
{
    $newitems->itemname = $_POST["itemname"];    
}

if (isset($_POST["itemdescription"])) 
{
    $newitems->itemdescription = $_POST["itemdescription"];
}

if (isset($_POST["quantity"])) 
{
    $newitems->quantity = $_POST["quantity"];    
}

if (isset($_POST["expire_date"])) 
{
    $newitems->expire_date = $_POST["expire_date"];
}

if (isset($_POST["price"])) 
{
    $newitems->price = $_POST["price"];
}

$newitems->additems($_POST);

