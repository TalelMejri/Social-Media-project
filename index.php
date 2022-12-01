<?php 
 
    include "./classes/classes.php";
    session_start();
    
    if(!isset($_SESSION['lang'])){
        $_SESSION['lang']='fr';
    }

    require_once "./languages/".$_SESSION['lang'].".php";
    $user=new user_manager();
    $NbrUser=$user->countUser();
    $show=false;
    $page_titel="Bizo Mejri";
    $template="";
    include "./layout.phtml";
?>
