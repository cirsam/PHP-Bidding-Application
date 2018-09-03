
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bidding App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="/static/css/main.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="/static/js/main.js"></script>
</head>
<body>
    <?php 
        include_once("../../menu.php");
        require_once("../../Controllers/Items/UpdateItem.php");
        $newupdate = new UpdateItem;
        $row = $newupdate->getUserItem($_GET["id"]);
    ?>
    <div class="container" >
    <center><h1>Updating Items</h1></center>
    <form method="POST" action="/Controllers/Items/Updateitem.php" enctype="multipart/form-data" >
        <input type="hidden" name="itemid" value="<?php echo $_GET["id"]; ?>" />
        <div class="form-group">
            <label for="exampleInputEmail1">Item Name</label>
            <input type="text" class="form-control" id="itemname" aria-describedby="emailHelp" placeholder="Enter item name" name="itemname" value="<?php echo $row["itemname"]; ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Item Description</label>
            <br />
            <textarea class="form-control" name="itemdescription" placeholder="Enter the description for the item" ><?php echo $row["itemdescription"]; ?></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Available Quantity</label>
            <input type="text" class="form-control" id="availablequantity" placeholder="Quantity available" name="quantity" value="<?php echo $row["quantity"]; ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Price</label>
            <input type="text" class="form-control" id="price" placeholder="Enter price" name="price" value="<?php echo $row["price"]; ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Expiration Date</label>
            <input type="date" class="form-control datepicker" id="expire_date" name="expire_date" data-provide="datepicker" value="<?php echo $row["expire_date"]; ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="submit" >Submit</button>
    </form>   
    </div>
    <footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </footer>
</body>
</html>