<?php

    session_start();

    if(!isset($_SESSION['id'])){
        header("location:../../auth/login");
        exit;
    }

    include "../classes/classes.php";

    $user=new user_manager();
    $number_all_user=$user->get_number_all_user();
    $number_all_pub=$user->get_number_all_pub();
    $number_all_story=$user->get_number_all_story();
    $nbr_liked=$user->get_number_all_like();
    $nbr_comment=$user->get_number_all_comment();

    
    $show=false;
    $template="ProfilAdmin";
    $page_titel="Bizo";
    include "../layout.phtml";

?>