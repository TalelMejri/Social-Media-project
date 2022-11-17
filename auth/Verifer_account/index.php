<?php
   
    require_once "../../classes/classes.php";
    $token=$_GET['token'];
    $email=$_GET['email'];
    $name=$_GET['name'];

    $erros=[];
    $user=new user_manager();
    if(!$email || !$token){
        $erros[0]="Email Or token missing";
    }else{
        $result=$user->validateUser_email($email,$token);
        if($result==1){
            $errors[0]="Your account is already verified";
            goto show;
        }else if($result == 2){
            $errors[0]="Token doesn't match email adress";
            goto show;
        }else if ($result == 3){
            header("location:../congrats?name=".$name);
            exit;
        }else if ($result == 0){
            $errors[0]="User doesn't exist";
            goto show;
        }else if ($result == 4){
            $errors[0]="Something went wrong";
            goto show;
            
        }
    }
    show :
    $template="verifer_account";
    $page_titel="Verification Email";
    include "../../auth_layout.phtml";
?>