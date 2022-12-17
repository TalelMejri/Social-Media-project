<?php 

    include "./classes/classes.php";
<<<<<<< HEAD
    session_start();
    
    if(!isset($_SESSION['nameUser'])){
        header("location:./auth/login");
        exit;
    }
=======
    
>>>>>>> 937619ed86e16409819a0302c45fdb5238fc8ef1

    $user=new user_manager();
    $user->delete_notif_by_id($_GET['id']);
    header("location:./ProfilUser");
    exit;
?>
