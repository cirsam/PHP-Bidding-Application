<?php

// make a new goddamn user

if (!isset($_POST['email']) || trim($_POST['email']) == '') {
	header('Location:/html/login.php?msg=you forgot to put in an email address.');
	die();
}

if (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
	header('Location:/html/login.php?msg=the email address you put in is invalid.');
	die();
}

if (!isset($_POST['password1']) || trim($_POST['password1']) == '') {
	header('Location:/html/login.php?msg=you forgot to put in your password.');
	die();
}

if (strlen($_POST['password1'])<5) {
	header('Location:/html/login.php?msg=your passwords is too short.');
	die();
}