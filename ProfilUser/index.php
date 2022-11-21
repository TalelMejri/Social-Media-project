<?php
    session_start();
    include "../classes/classes.php";
    if(!isset($_SESSION['nameUser'])){
        header("location:../auth/login");
        exit;
    }
    $user=new user_manager();
    if(isset($_POST['save'])){

        extract($_POST);
        $file=new File('./storage_story/',$_FILES['avatar']);
        if(empty($_FILES['avatar']['name'])){
            echo "<script>alert('File required');</script>";
        }
        else if(!$file->uploadImage()){
            echo "<script>alert('File not upload');</script>";
        }
        else if(!$file->size()){
            echo "<script>alert('size File ');</script>";
        }
        else{
            $date= date('y/m/d');
            $avatar='./storage_story/'.$file->getfilename();
            $user->Add_Story($avatar,$_SESSION['idUser'],$date);
        }

    }
    $all_user=$user->get_all_story();

    function userFromId($id){
        $user=new user_manager();
        return $user->get_user($id);
    }

    $mode_visibiltes=$user->getModeAffichage($_SESSION['idUser']);
    $show=false;
    $template="ProfilUser";
    $page_titel=$_SESSION['nameUser'];
    include "../layout.phtml";
?>