<?php
    session_start();
    if(!isset($_SESSION['idUser'])){
        header("location:../auth/login");
        exit;
    }
    if(!array_key_exists('id',$_GET)){
        header("location:../auth/login");
        exit;
    }
    include "./classes/classes.php";
    $user=new user_manager();
    $user->delete_notif_by_id($_GET['id']);
    header("location:./ProfilUser");
    exit;
?>