<?php namespace Bidding\Interfaces;

interface ILoginSystem
{
	function signUp($params);
	function signIn($params);
	function signOut();
}
?>