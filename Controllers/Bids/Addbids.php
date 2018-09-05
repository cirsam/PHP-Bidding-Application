<?php
require_once("../../Models/DBconnect.php");
require_once(__DIR__."/../../Controllers/Bids/AbsAddBids.php");
require_once(__DIR__."/../../Controllers/Bids/IAddBids.php");

if(!is_numeric($_POST["bidamount"]))
{
    $row = [];
    $row["status"] = "";
    $row["msg"] = "Only numbers are allowed";

    echo Json_encode($row);

    return;
}

class AddBids extends AbsAddBids implements IAddBids
{
    private $mysqli;
    private $bidamount;
    private $itemid;

    public function __construct()
    {

    }

    public function addbids()
    {
        if($this->checkIsHighestBid()>=$this->bidamount)
        {
            $row = [];
            $row["status"] = "";
            $row["msg"] = "Your bid $".$this->bidamount." is lower than or same as the highest bid $".$this->checkIsHighestBid();
            
            echo Json_encode($row);

            return; 
        }

        $mysqli = parent::__construct();
        $stmt = $mysqli->prepare("INSERT INTO bids (bidid,itemid,userid,bidamount) VALUES(?,?,?,?)");
        $stmt->bind_param('ssss',$bidid,$itemid,$userid,$bidamount);

        $bidid = $mysqli->escape_string("");
        $itemid = $mysqli->escape_string($this->itemid);
        $userid = $_SESSION["userid"];
        $bidamount = $mysqli->escape_string($this->bidamount);

        if(!$stmt->execute())
        {
            echo "execution fialed";
        }

        echo $this->getBidData($itemid);
    }

    public function __set($name,$value)
    {
        if($name=="itemid"){
            $this->itemid = $value;
        }
        if($name=="bidamount"){
            $this->bidamount = $value;
        }
    }

    private function getbidData()
    {
        $mysqli = parent::__construct();
        $stmt = $mysqli->prepare("SELECT COUNT(bids.itemid) as totalbids FROM `bids`
        LEFT JOIN items on bids.itemid=items.itemid WHERE items.itemid=? GROUP BY items.itemid");
        $stmt->bind_param('s', $itemid);
        $itemid = $this->itemid;

        /* execute prepared statement */
        if(!$stmt->execute())
        {
            echo "execution fialed";
        }

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        $row["status"]="OK";

        return Json_encode($row);
    }

    private function checkIsHighestBid()
    {
        $mysqli = parent::__construct();
        $stmt = $mysqli->prepare("SELECT bids.bidid,users.fullname,bids.bidamount,bids.created_at FROM `bids`
        LEFT JOIN items on bids.itemid=items.itemid
        LEFT JOIN users on users.userid=bids.userid WHERE items.itemid=? ORDER BY CAST(bidamount AS UNSIGNED ) DESC LIMIT 1");
        $stmt->bind_param('s', $itemid);
        $itemid = $this->itemid;

        /* execute prepared statement */
        if(!$stmt->execute())
        {
            echo "execution fialed";
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["bidamount"];  
    }

}

$newbids = new Addbids;

if (isset($_POST["id"])) 
{
    $newbids->itemid = $_POST["id"];    
}

if (isset($_POST["bidamount"])) 
{
    $newbids->bidamount = $_POST["bidamount"];
}

$newbids->addbids($_POST);

