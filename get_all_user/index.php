<?php 


    $user=new user_manager();
    $all_user=$user->get_all_users($_SESSION['idUser']);
    
    if(isset($_GET['id_ajouter'])){
         $user->Ajouter_ami($_SESSION['idUser'],$_GET['id_ajouter']);
         $user_current=$user->get_user($_SESSION['idUser']);
         $user->add_notification($_GET['id_ajouter'],$user_current['name'].'envoyer un invitation');
    }
    
    if(isset($_GET['id_confirmer'])){
        $user->accepter_ami($_GET['id_confirmer'],$_SESSION['idUser']);
        $user->add_notification($_GET['id_confirmer'],$_SESSION['nameUser'].'a accepté votre invitation');
    }

    include "get_all_user.phtml";

?>