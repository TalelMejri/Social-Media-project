<?php

session_start();
include "../classes/classes.php";
$pub=new pub_manage();
$user=new user_manager();
$all_pub=$pub->get_all_pub_save($_SESSION['idUser']);
$mode_visibiltes=$user->getModeAffichage($_SESSION['idUser']);
$show=false;    
$template="pub_save";
$page_titel="Save";
include "../layout.phtml";

?>