<?php

session_start();
include "../classes/classes.php";

$user=new user_manager();
$all_friends=$user->get_all_friend($_SESSION['idUser']);

$show=false;
$template="listamis";
$page_titel="Amis";
include "../layout.phtml";
?>