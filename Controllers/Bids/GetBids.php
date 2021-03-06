<?php
require_once(__DIR__."/../../Models/DBconnect.php");
require_once(__DIR__."/../../Controllers/Bids/AbsGetBids.php");
require_once(__DIR__."/../../Controllers/Bids/IGetBids.php");

class GetBids extends AbsGetBids implements IGetBids
{
    private $rows;
    private $itemid;

    public function __construct()
    {

    }

    public function __get($name)
    {
        switch($name){
            case "rows":
                return $this->rows = $this->getAllBids();
                break;
            default:
                throw new Exception("Property $name does not exist.");
                break;
        }
    }

    public function __set($name,$value)
    {
        return $this->itemid = $value;
    }

    private function getAllBids()
    {
        $mysqli = parent::__construct();
        $stmt = $mysqli->prepare("SELECT bids.bidid,users.fullname,bids.bidamount,bids.created_at FROM `bids`
        LEFT JOIN items on bids.itemid=items.itemid
        LEFT JOIN users on users.userid=bids.userid WHERE items.itemid=? ORDER BY CAST(bidamount AS UNSIGNED ) DESC");
        $stmt->bind_param('s', $itemid);
        $itemid = $this->itemid;

        /* execute prepared statement */
        if(!$stmt->execute())
        {
            echo "execution fialed";
        }

        $result = $stmt->get_result();

        return $result;      
    }
}
?>