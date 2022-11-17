<?php 
    session_start();
    include "../../classes/classes.php";
    if(isset($_POST['submit'])){
        extract($_POST);
        if(empty($email)){
            header("location:index.php?msg=email required&type=danger");
            exit;
        }else if(empty($password)){
            header("location:index.php?msg=password required&type=danger");
            exit;
        }else{
            $user=new user_manager();
            $verifer_user=$user->loginUser($email,$password);
            $verifer_admin=$user->loginadmin($email,$password);
            if(!$verifer_admin && !$verifer_user){
                header("location:index.php?msg=password or email is incorrect&type=danger");
                exit;
            }else if($verifer_user==2){
                $link="<a href='../renvoyerToken'> Cliquer and renvoyer token </a>" ;
                header("location:index.php?msg=account is not verified".$link."&type=danger");
            }else if($verifer_admin==1){
                header("location:../../ProfilAdmin");
                exit;
            }else if($verifer_user==1){
                header("location:../../ProfilUser");
                exit;
            }
        }
    }
    $show=true;
    $page_titel="login";
    $template="login";
    require "../../layout.phtml"; 
?>