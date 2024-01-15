<?php
include '../classes/User.php';

$user = new User;

//array the item of file uploated the current script
$user->update($_POST, $_FILES);
?>