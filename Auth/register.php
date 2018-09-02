<?php
if (!isset($_POST['username']) || trim($_POST['username']) == '') 
{
	header('Location:/html/register.php?msg=you forgot to put in your username.');
	die();
}

if (strlen($_POST['username'])<5) 
{
	header('Location:/html/register.php?msg=your username is too short.');
	die();
}

if (preg_match('/[^\x20-\x7f]/', $_POST['username'])) 
{
	header('Location:/html/register.php?msg=your username must contain only letters and numbers.');
	die();
}

if (!isset($_POST['email']) || trim($_POST['email']) == '') 
{
	header('Location:/html/register.php?msg=you forgot to put in an email address.');
	die();
}

if (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) 
{
	header('Location:/html/register.php?msg=the email address you put in is invalid.');
	die();
}

if (!isset($_POST['password1']) || trim($_POST['password1']) == '') 
{
	header('Location:/html/register.php?msg=you forgot to put in your password.');
	die();
}

if (!isset($_POST['password2']) || trim($_POST['password2']) == '') 
{
	header('Location:/html/register.php?msg=you forgot to put in your password again.');
	die();
}

if (trim($_POST['password1']) != trim($_POST['password2'])) 
{
	header('Location:/html/register.php?msg=your passwords do not match.');
	die();
}

if (strlen($_POST['password1'])<5) 
{
	header('Location:/html/register.php?msg=your passwords is too short.');
	die();
}

//validate assci char