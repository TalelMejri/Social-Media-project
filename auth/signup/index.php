<?php

 require_once "../../classes/classes.php";
 
 include "../../send.php";
 use PHPMailer\PHPMailer\PHPMailer;

 $error=[];
 if(isset($_POST['signup'])){
    extract($_POST);
    $file=new File("../../storage/",$_FILES['avatar']);
    if($name==""){
        $error['name']="name required ";
        goto showhere;
    }
    else if(strlen($name)<4){
        $error['name']="name long than 4";
        goto showhere;
    }
    else if($prenom==""){
        $error['prenom']="prenom required ";
        goto showhere;
    }
    else if(strlen($prenom)<4){
        $error['prenom']="prenom long than 4";
        goto showhere;
    }
    else if($email==""){
        $error['email']="email required ";
        goto showhere;
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $error['email']="email invalid";
        goto showhere;
    }
    else if($password==""){
        $error['password']="password required ";
        goto showhere;
    }
    else if(strlen($password)<6){
        $error['password']="password at least 6 caractere";
        goto showhere;
    }else if(empty($_FILES['avatar']['name'])){
        $error['file']="file required";
        goto showhere;
    }else if(!$file->uploadImage()){
        $error['file']="failed upload";
        goto showhere;
    }
    else if(!$file->size()){
        $error['file']="failed size";
        goto showhere;
    }
    else if(empty($agree)){
        $error['agree']="failed agree";
        goto showhere;
    }
    else{
         $user=new user_manager();
         $verifer_exite_email=$user->checkEmail($email);
         if($verifer_exite_email){
            $error['email']="Email Existe";
            goto showhere;
         }else{
            $avatar="/storage/".$file->getfilename();
            $token=md5($email).rand(10,9999);
            $date= date("Y/m/d");
            $indice=$user->signup($name,$prenom,$email,$password,$avatar,$token,$date);
            $link="<a href='".$_SERVER['HTTP_HOST']."/".explode("/",$_SERVER['PHP_SELF'])[1]."/auth/Verifer_account/index.php?token=".$token."&email=".$email."&name=".$name."'> Click and Verify Email </a>";
            sendmail("BIZO OFFICIEL",$email,"LIEN DE VERIFIACATION","Cliquez sur ce lien pour vérifier l'e-mail ' .$link. '");
            if(is_int($indice)){
                header("location:../../confirmation_signup.phtml");
                exit;
            }
         }
      
    }
   
    
 }
 
    showhere:
    $show=true;
    $page_titel="Sign Up";
    $template="signup";
    require "../../layout.phtml"; 

?>