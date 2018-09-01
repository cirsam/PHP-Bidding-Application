<?php namespace Bidding\Interfaces;

interface ILoginSystem
{
	public function signUp($params);
	public function signIn($params);
	public function signOut();
}
?>