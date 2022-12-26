<?php 

session_start();

if(!array_key_exists('id_user',$_GET) or !ctype_digit($_GET['id_user'])){
    header("location:../profilUser?type=danger&msg=id incorrect !");
    exit();
} 
include "../classes/classes.php";

if(!isset($_SESSION['nameUser'])){
    header("location:../auth/login");
   
}
$user=new user_manager();
if (isset($_GET['id_user'])){
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
}


$mode_visibiltes=$user->getModeAffichage($_SESSION['idUser']);
$show=null;
$template="Account_User";
$page_titel="Account";
include "../layout.phtml";
?>
