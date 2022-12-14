<?php 

    include "./classes/classes.php";
    

    $user=new user_manager();
    $user->delete_notif_by_id($_GET['id']);
    header("location:./ProfilUser");
    exit;
?>
