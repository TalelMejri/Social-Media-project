<?php
    session_start();

    if(!isset($_SESSION['nameUser'])){
        header("location:../auth/login");
        exit;
    }

    $show=false;
    $template="ProfilUser";
    $page_titel=$_SESSION['nameUser'];
    include "../layout.phtml";
?>