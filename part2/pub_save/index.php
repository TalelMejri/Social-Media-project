<?php

session_start();
include "../classes/classes.php";

include "../classes/classes.php";
if(!isset($_SESSION['nameUser'])){
    header("location:../auth/login");
    exit;
}
$pub=new pub_manage();
$user=new user_manager();
$all_pub=$pub->get_all_pub_save($_SESSION['idUser']);
if(!$all_pub){
    $all_pub="vide";
}

if(isset($_GET['idpub'])){
    $pub->deletePubSave($_GET['idpub']);
    $all_pub=$pub->get_all_pub_save($_SESSION['idUser']);
    if(!$all_pub){
        $all_pub="vide";
    }
}

function userFromId($id){
    $user=new user_manager();
    return $user->get_user($id);
}

function pubFromId($id){
    $pub=new pub_manage();
    return $pub->get_pub($id);
}

$mode_visibiltes=$user->getModeAffichage($_SESSION['idUser']);
$show=false;    
$template="pub_save";
$page_titel="Save";
include "../layout.phtml";

?>