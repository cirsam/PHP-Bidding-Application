<?php
require_once(__DIR__."/../../Models/DBconnect.php");
require_once(__DIR__."/../../Controllers/Items/AbsUpdateItem.php");
require_once(__DIR__."/../../Controllers/Items/IUpdateItem.php");

class UpdateItem extends AbsUpdateItem implements IUpdateItem
{
    private $itemid;
    private $itemdescription;
    private $itemname;
    private $price;
    private $quantity;
    private $expire_date;

    public function __construct()
    {

    }

    public function __set($name,$value)
    {
        if($name=="itemid")
        {
            $this->itemid = $value;
        }
        if($name=="itemname")
        {
            $this->itemname = $value;
        }
        if($name=="itemdescription")
        {
            $this->itemdescription = $value;
        }
        if($name=="expire_date")
        {
            $this->expire_date = $value;
        }
        if($name=="quantity")
        {
            $this->quantity = $value;
        }
        if($name=="price")
        {
            $this->price = $value;
        }
    }

    public function getUserItem($id)
    {
        $mysqli = parent::__construct();
        $stmt = $mysqli->prepare("SELECT * FROM items WHERE itemid=?");
        $stmt->bind_param('s', $itemid);
        $itemid = $id;

        /* execute prepared statement */
        if(!$stmt->execute())
        {
            echo "execution fialed";
        }

        $result = $stmt->get_result();

        $rows = $result->fetch_assoc();

        return $rows;
    }

    public function updateUserItem()
    {
        $this->updateItem();
    }

    private function updateItem()
    {
        $mysqli = parent::__construct();
        $stmt = $mysqli->prepare("UPDATE items SET itemname=?,itemdescription=?,price=?,quantity=?,expire_date=? WHERE itemid=?");
        $stmt->bind_param('ssssss',$itemname,$itemdescription,$price,$quantity,$expire_date,$itemid);
        $itemid = $this->itemid;
        $itemname = $this->itemname;
        $itemdescription = $this->itemdescription;
        $price = $this->price;
        $quantity = $this->quantity;
        $expire_date = $this->expire_date;

        /* execute prepared statement*/
        if(!$stmt->execute())
        {
            echo "execution fialed";
        }

        header('Location:/html/home.php?msg=Your item has been updated&status=success');
    } 
}

$newupdate = new UpdateItem;

if (isset($_POST["itemid"])) 
{
    $newupdate->itemid = $_POST["itemid"];    
}

if (isset($_POST["itemname"])) 
{
    $newupdate->itemname = $_POST["itemname"];    
}

if (isset($_POST["itemdescription"])) 
{
    $newupdate->itemdescription = $_POST["itemdescription"];
}

if (isset($_POST["quantity"])) 
{
    $newupdate->quantity = $_POST["quantity"];    
}

if (isset($_POST["expire_date"])) 
{
    $newupdate->expire_date = $_POST["expire_date"];
}

if (isset($_POST["price"])) 
{
    $newupdate->price = $_POST["price"];
}


if (isset($_POST["submit"])) 
{
    $newupdate->updateUserItem(); 
}

?>