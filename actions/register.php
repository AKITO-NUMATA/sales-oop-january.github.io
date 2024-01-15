<?php

include '../classes/User.php';

// Create an object
$user = new User;

//call the method
//all date handle $_post
$user->store($_POST);

?>