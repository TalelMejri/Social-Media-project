<?php 

session_start();
include "../classes/classes.php";
$user=new user_manager();

$id=$_GET['id_user'];
$count=ceil($user->countFriend($id));
$all_friends=$user->get_all_friend_daccord($id);
if(!$all_friends){
    $all_friends='vide';
 }
function userFromId($id){
    $user=new user_manager();
    return $user->get_user($id);
}


$mode_visibiltes=$user->getModeAffichage($_SESSION['idUser']);
$show=null;
$template="Account_User";
$page_titel="Account";
include "../layout.phtml";
?>