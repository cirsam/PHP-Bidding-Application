<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bidding App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="/static/css/main.css" />
    <script src="/static/js/main.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <?php
        require_once("../Controllers/Items/GetItems.php");
        include_once("../menu.php");
        if(!isset($_SESSION["islogined"]))
        {
            die();
        }
        $newitems = new GetItems;
        $results = $newitems->rows;
    ?>
    <div class="container">
        <center><h1>My Items <a href="/html/items/additem.php" class="btn" >Add Item</a></h1></center>
        <table class="table table-striped table-dark">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Item Name</th>
            <th scope="col">Item Description</th>
            <th scope="col">Bids</th>
            <th scope="col">Closing Date</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($rows = $results->fetch_assoc())
                {
                    echo '
                    <tr>
                        <th scope="row">'.$rows["itemid"].'</th>
                        <th>'.htmlentities(stripslashes($rows["itemname"])).'</th>
                        <td>'.$rows["itemdescription"].'</td>
                        <td>'.$rows["totalbids"].'</td>
                        <td>'.$rows["expire_date"].'</td>
                        <td>
                            <a href="/html/items/updateitem.php?id='.$rows["itemid"].'" class="btn btn-info mr-sm-2" >Update</a>
                        </td>
                        <td>
                            <a href="/Controllers/Items/DeleteItem.php?id='.$rows["itemid"].'" class="btn btn-danger mr-sm-2" >Delete</a>
                        </td>
                        <td>
                            <a href="/html/bids/?itemid='.$rows["itemid"].'&itemname='.$rows["itemname"].'" class="btn btn-primary mr-sm-2" >View Bids</a>
                        </td>
                    </tr>                   
                    ';
                }
            ?>
        </tbody>
        </table>
    </div>
    <footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </footer>
</body>
</html>