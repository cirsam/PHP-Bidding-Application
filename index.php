<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bidding App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="static/css/main.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
    <script src="static/js/main.js"></script>
</head>
<body>
<?php include_once("menu.php"); ?>
<?php
    require_once("./Controllers/Items/GetItems.php");
    $newitems = new GetItems;
    $results = $newitems->getAllItems();
    ?>
    <div class="container" >
        <center>
            <h1 id="header1" >Welcome to the Bidding APP</h1>
            <h4 id="header4" >List of items and bids</h4>
        </center>
        <div class="row">
            <?php
                if(isset($_SESSION["islogined"]))
                {
                    while ($rows = $results->fetch_assoc())
                    {
                        echo '
                        <div class="col-6 col-lg-4" style="min-hieght:400px;" >
                        <h2>'.$rows["itemname"].'</h2>
                        <p>'.$rows["itemdescription"].'</p>
                        <p id="numofbids_'.$rows["itemid"].'" >Number of bids:<strong> '.$rows["totalbids"].'</strong></p>
                        ';
                        if($rows["expire_date"] > date("Y-m-d H:i:s"))
                        {
                            echo'
                            <p>
                                <span id="bidstatus_'.$rows["itemid"].'" style="color:red;" ></span>
                                <input type="text" id="bidamount_'.$rows["itemid"].'" class="form-control col-6" placeholder="Enter Bid Amount" style="display:inline-block;" >
                                <a class="btn btn-primary col-3" href="#" role="button" id="'.$rows["itemid"].'" onclick="bidnow(this.id);return false;" style="display:inline-block;">Bid Now</a>
                            </p>
                            <p>Closing Date: '.$rows["expire_date"].'</p>
                            <p>
                                <a class="btn btn-secondary col-12" href="/html/bids/?itemid='.$rows["itemid"].'&itemname='.$rows["itemname"].'" role="button" style="virtical-align:bottom;" >View Bids >></a>
                            </p>
                            ';
                        }
                        else{
                            echo'
                                <p><strong id="closing" >Closed on: '.$rows["expire_date"].'</p>
                            ';                          
                        }
                        echo'
                        </div><!--/span-->                 
                        ';                       
                    }
                }
                else
                {
                    while ($rows = $results->fetch_assoc())
                    {
                        echo '
                        <div class="col-6 col-lg-4" style="min-hieght:400px;" >
                        <h2>'.$rows["itemname"].'</h2>
                        <p>'.$rows["itemdescription"].'</p>
                        <p id="numofbids_'.$rows["itemid"].'" >Number of bids:<strong> '.$rows["totalbids"].'</strong></p>
                        <p>Closing Date: '.$rows["expire_date"].'</p>
                        <p>
                        <a class="btn btn-secondary col-12" href="/html/bids/?itemid='.$rows["itemid"].'&itemname='.$rows["itemname"].'" role="button" style="virtical-align:bottom;" >View Bids >></a>
                        </p>
                        </div><!--/span-->                   
                        ';                      
                    }
                }
            ?>
        </div>
    </div>
    <footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </footer>
</body>
</html>