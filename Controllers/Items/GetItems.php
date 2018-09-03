<?php
require_once(__DIR__."/../../Models/DBconnect.php");
class GetItems extends DBconnect
{
    private $rows;
    private $firstitem;
    private $results;

    function __construct()
    {

    }

    function __get($name)
    {
        switch($name){
            case "rows":
                return $this->rows = $this->getUserItems();
                break;
            case "firstitem":
                return $this->firstitem = $this->getUserItems()[0];
                break;
            default:
                throw new Exception("Property $name does not exist.");
                break;
        }
    }

    public function getAllItems()
    {
        $mysqli = parent::__construct();
        $stmt = $mysqli->prepare("SELECT items.itemid,fullname,items.itemname,items.itemdescription,items.expire_date,COUNT(bids.itemid) as totalbids,bids.bidamount FROM `items` 
        LEFT JOIN bids on bids.itemid=items.itemid
        LEFT JOIN users on users.userid=items.userid GROUP BY items.itemid ORDER BY items.itemid DESC");

        /* execute prepared statement */
        if(!$stmt->execute())
        {
            echo "execution fialed";
        }

        $results = $stmt->get_result();

        return $results;
    }

    private function getUserItems()
    {
        $mysqli = parent::__construct();
        $stmt = $mysqli->prepare("SELECT items.userid,items.itemid,fullname,items.itemname,items.itemdescription,items.expire_date,COUNT(bids.itemid) as totalbids,bids.bidamount FROM `items` 
        LEFT JOIN bids on bids.itemid=items.itemid
        LEFT JOIN users on users.userid=items.userid WHERE items.userid=? GROUP BY items.itemid  ORDER BY items.itemid DESC");
        $stmt->bind_param('s', $userid);
        $userid = $_SESSION["userid"];

        /* execute prepared statement */
        if(!$stmt->execute())
        {
            echo "execution fialed";
        }

        $results = $stmt->get_result();

        return $results;
    }
}
?>