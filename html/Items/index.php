<?php
//selence is golden
?>

SELECT users.fullname,bids.*,items.*,COUNT(DISTINCT(bids.bidid)) as count FROM `bids` 
LEFT JOIN items on bids.itemid=items.itemid
LEFT JOIN users on users.userid=bids.userid GROUP BY bids.itemid