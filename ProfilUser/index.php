<?php
    session_start();
    include "../classes/classes.php";
    if(!isset($_SESSION['nameUser'])){
        header("location:../auth/login");
        exit;
    }
    $user=new user_manager();
    $mode_visibiltes=$user->getModeAffichage($_SESSION['idUser']);
    $show=false;
    $template="ProfilUser";
    $page_titel=$_SESSION['nameUser'];
    include "../layout.phtml";
?>