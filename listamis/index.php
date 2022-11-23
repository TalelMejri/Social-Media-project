<?php

session_start();
include "../classes/classes.php";

$user=new user_manager();
$all_friends=$user->get_all_friend($_SESSION['idUser']);
$all_user_filter=[];

foreach($all_friends as $item){
    if($user->get_user_filter_friend($item['iduser'],$_SESSION['idUser'])){
        array_push($all_user_filter,$item);
    }
}

if(empty($all_user_filter)){
    $all_user_filter="vide";
}

$mode_visibiltes=$user->getModeAffichage($_SESSION['idUser']);

$show=false;
$template="listamis";
$page_titel="Amis";
include "../layout.phtml";
?>