<?php
    session_start();
    
    include "../classes/classes.php";
    if(!isset($_SESSION['nameUser'])){
        header("location:../auth/login");
        exit;
    }
    $user=new user_manager();
    $pub=new pub_manage();
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
            $pub->Add_Story($avatar,$_SESSION['idUser'],$date);
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
                $pub->addPub($date,$description,'',$_SESSION['idUser']);
            }else{
                $pub->addPub($date,$description,'',$_SESSION['idUser'],$color_pub);
            }
        }else{
            if(empty($color_pub)){
                $pub->addPub($date,$description,$avatar,$_SESSION['idUser']);
            }else{
                $pub->addPub($date,$description,$avatar,$_SESSION['idUser'],$color_pub);
            }
        }
    }

    

    function userFromId($id){
        $user=new user_manager();
        return $user->get_user($id);
    }

    if(isset($_POST['like'])){
        extract($_POST);
        $pub->AddlikePub($idpub,$_SESSION['idUser']);
        if($id_user!=$_SESSION['idUser']){
             $user->add_notification($id_user,$_SESSION['nameUser'].'like your pub');
        }
    }

    if(isset($_POST['save_pub'])){
        extract($_POST);
        $pub->save_pub($_SESSION['idUser'],$idpub);
    }


    if(isset($_POST['edit'])){
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

        if(!$avatarupload){
            $pub->edit_pub($_SESSION['idUser'],$idpub,'',$color_edit,$desc);
        }else{
            $pub->edit_pub($_SESSION['idUser'],$idpub,$avatar,$color_edit,$desc);
        }
      
    }

    if(isset($_GET['delete_pub'])){
        $pub->deletePub($_GET['delete_pub']);
    }

    if(isset($_POST['add_comment'])){
        extract($_POST);
        if($id_user!=$_SESSION['idUser']){
            $user->add_notification((int)$id_user,$_SESSION['nameUser'].'comment your pub');
         }
        $user->addComment($_SESSION['idUser'],$comment,(int)$pub);
    }

    if(isset($_GET['delete_comment'])){
        $user->delete_comment($_GET['delete_comment']);
    }


    if(isset($_POST['edit_comment'])){
        extract($_POST);
        $user->update_comment($id_comment,$desc);
    }
 
    $all_user=$pub->get_all_story();
    $all_pub=$pub->get_all_pub();
    $mode_visibiltes=$user->getModeAffichage($_SESSION['idUser']);
    $show=false;
    
    $template="ProfilUser";
    $page_titel=$_SESSION['nameUser'];
   
    include "../layout.phtml";
?>