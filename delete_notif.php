<?php 

    include "./classes/classes.php";
    if(!isset($_SESSION['nameUser'])){
        header("location:./auth/login");
        exit;
    }

    $user=new user_manager();
    $user->delete_notif_by_id($_GET['id']);
    header("location:./ProfilUser");
    exit;
?>
