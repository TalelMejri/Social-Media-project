<?php 
    session_start();
    include "../classes/classes.php";
    $user=new user_manager();
    $pub=new pub_manage();
    $mode_visibiltes=$user->getModeAffichage($_SESSION['idUser']);
 
    if(isset($_GET['search'])){
       extract($_GET);
       $all_user=$user->get_friend($_SESSION['idUser'],$search);
    }else{
        $all_user=$user->get_all_friend($_SESSION['idUser']);
    }

    if(isset($_GET['choice_user'])){
        $user_choice=$user->get_user($_GET['choice_user']);
    }

    if(isset($_POST['send_message'])){
        extract($_POST);
        if(strlen($message)>35){
            goto show;
        }
        $user->send_message($_SESSION['idUser'],$iduser_recu,$message);
    }

    show :
    $show=null;
    $template="chat";
    $page_titel="certificat";
    include "../layout.phtml";
?>