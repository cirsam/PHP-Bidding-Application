<?php
require_once(__DIR__."/../../Models/DBconnect.php");
class DeleteItem extends DBconnect
{
    private $itemid;

    function __construct()
    {

    }

    public function deleteItem()
    {
        $this->deleteUserItems();
    }

    function __set($id,$value)
    {
        $this->itemid = $value;
    }

    private function deleteUserItems()
    {
        $mysqli = parent::__construct();
        $stmt = $mysqli->prepare("DELETE FROM items WHERE itemid=?");
        $stmt->bind_param('s', $itemid);
        $itemid = $this->itemid;

        /* execute prepared statement */
        if(!$stmt->execute())
        {
            echo "execution fialed";
        }

        header('Location:/html/home.php?msg=Your item has been deleted&status=success');
    }
}

$objdelete = new DeleteItem;
$objdelete->itemid = $_GET["id"];
$objdelete->deleteItem();
?>