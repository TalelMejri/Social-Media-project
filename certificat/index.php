<?php 
    session_start();
    include "../classes/classes.php";
    $template="certificat";

    if(!isset($_SESSION['nameUser'])){
        header("location:../login");
        exit;
    }
    $user=new user_manager();
    $mode_visibiltes=$user->getModeAffichage($_SESSION['idUser']);
    $show=null;
    $page_titel="certificat";
    include "../layout.phtml";
?>