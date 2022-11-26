<?php 
    session_start();
    include "../classes/classes.php";
    $template="certificat";
    $user=new user_manager();
    $mode_visibiltes=$user->getModeAffichage($_SESSION['idUser']);
    $show=null;
    $page_titel="certificat";
    include "../layout.phtml";
?>