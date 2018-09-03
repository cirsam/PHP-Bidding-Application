
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
        require_once("../../Controllers/Bids/GetBids.php");
        include_once("../../menu.php");
        $newbids = new GetBids;
        $newbids->itemid = $_GET["itemid"];
        $results = $newbids->rows;
    ?>
    <div class="container">
        <center><h1>Bids for item: <?php echo $_GET["itemname"]; ?></h1></center>
        <table class="table table-striped table-dark">
        <thead>
            <tr>
            <th scope="col">Bid #</th>
            <th scope="col">Bidder</th>
            <th scope="col">Bid Amount</th>
            <th scope="col">Date Bidded</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($rows = $results->fetch_assoc())
                {
                    echo '
                    <tr>
                        <th scope="row">'.$rows["bidid"].'</th>
                        <td>'.$rows["fullname"].'</td>
                        <td>$'.$rows["bidamount"].'</td>
                        <td>'.date('d/m/Y',strtotime($rows["created_at"])).'</td>
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