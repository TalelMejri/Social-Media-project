<?php 
 
    include "./classes/classes.php";
    $user=new user_manager();
    $NbrUser=$user->countUser();
    $show=false;
    $page_titel="Bizo Mejri";
    $template="";
    include "./layout.phtml";
?>
