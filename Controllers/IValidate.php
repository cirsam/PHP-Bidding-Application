<?php
interface IValidate
{
    function userExists($username, $email);
    function getCheckUserData($username, $password);
}
?>