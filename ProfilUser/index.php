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

    if(isset($_POST['add'])){
        extract($_POST);
        $file=new File('./pub_photo/',$_FILES['avatar']);
        $avatarupload=0;
        if(strlen($_FILES['avatar']['name'])){
        if(!$file->uploadImage()){
            echo "<script>alert('File not upload');</script>";
        }
        else if(!$file->size()){
            echo "<script>alert('size File ');</script>";
        }
        $avatar='./pub_photo/'.$file->getfilename();
        $avatarupload=1;
        }
        $date=date('y/m/d');
        if($avatarupload==0){
            if(empty($color_pub)){
                $user->addPub($date,$description,'',$_SESSION['idUser']);
            }else{
                $user->addPub($date,$description,'',$_SESSION['idUser'],$color_pub);
            }
        }else{
            if(empty($color_pub)){
                $user->addPub($date,$description,$avatar,$_SESSION['idUser']);
            }else{
                $user->addPub($date,$description,$avatar,$_SESSION['idUser'],$color_pub);
            }
        }
    }

    $all_user=$user->get_all_story();
    $all_pub=$user->get_all_pub();

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