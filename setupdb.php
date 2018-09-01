
<!docType html>
<head>
	<title>Setup System</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
	<body class="container" >
	<h1><center>Setup Page to create tables</center></h1>
		<?php
		if(isset($_REQUEST["setup"]) && $_REQUEST["setup"]!="true"){
			require_once("Backend/app/Models/Connectors.php");
			$noerror = true;
			
			$result_user = $newconnent->connect()->query("CREATE TABLE IF NOT EXISTS  `users` (
					`userid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
					`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
					`remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
					PRIMARY KEY (userid),
					UNIQUE KEY (email)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
				");

			if($result_user!=1){
				echo "<h1 style=\"color:red;\" >Error Creating the user table try again</h1>";
				$noerror = true;
			}

			$result_items = $newconnent->connect()->query("CREATE TABLE IF NOT EXISTS  `items` (
				`itemid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
				`itemname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`itemdescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`userid` int(10) COLLATE utf8_unicode_ci NOT NULL,
				`expire_date` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
				`quantity` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
				`price` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
				PRIMARY KEY (itemid),
				UNIQUE KEY (itemid)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
			");

			if($result_items!=1){
				echo "<h1 style=\"color:red;\" >Error Creating the items table try again</h1>";
				$noerror = true;
			}

			$result_bids = $newconnent->connect()->query("CREATE TABLE IF NOT EXISTS `bids` (
				`bidid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
				`userid` int(10) COLLATE utf8_unicode_ci NOT NULL,
				`itemid` int(10) COLLATE utf8_unicode_ci NOT NULL,
				PRIMARY KEY (bidid),
				UNIQUE KEY (bidid),
				CONSTRAINT FK_itemid FOREIGN KEY (itemid) REFERENCES items(itemid)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
			");

			if($result_bids!=1){
				echo "<h1 style=\"color:red;\" >Error Creating the bids table try again</h1>";
				$noerror = true;
			}

			if($noerror)
			{
				echo "<h1 style=\"color:green;\" >Setup is complete. You can now start using your application</h1>";			
			}
		}
		?>
		<div>
		Create a database and using the connection data to complete the forms.

		This will create your needed tables in the database.

		Got to auth/connoctors.php and update that file with your database credentials. Call 9375369660 for help.
		</div>
		<form action="" method="post" >
			<div class="form-group" >
				<label for="dbname">Database</label>
				<input type="text" class="form-control" id="database" name="database" placeholder="">
			</div>
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" name="username" placeholder="">
			</div>
			<div class="form-group">
				<label for="username">Password</label>
				<input type="text" class="form-control" id="password" name="password" placeholder="">
			</div>
			<input type="submit" class="btn btn-primary" name="setup" >
		</form>
	</body>
</html>
