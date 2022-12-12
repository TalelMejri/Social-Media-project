<?php 
     include "../../classes/classes.php";
     include "../../send.php";
     use PHPMailer\PHPMailer\PHPMailer;
     $user=new user_manager();
     if(isset($_POST['submit'])){
          extract($_POST);
          $user_choice=$user->checkEmail($email);
          if(!$user_choice){
               header("location:index.php?msg=user dosen't exit");
               exit;
          }
          $token=md5($user_choice['last_name']).rand(50,9999);
          $user->addToken($user_choice['iduser'],$token);
          $link="<a href='".$_SERVER['HTTP_HOST']."/".explode("/",$_SERVER['PHP_SELF'])[1]."/auth/Verifer_account/index.php?token=".$token."&email=".$email."'> Click and Verify Email </a>";
          sendmail("BIZO OFFICIEL",$email,"Lien de Renvoyer token ","Cliquez sur ce lien pour vérifier l'e-mail ' .$link. '");
          header("location:../login?mesage_renvoyer=Email de verification renvoyer&mesage_renvoyer1=Veuillez vérifier votre e-mail pour le confirmer&typ=success");
          exit;
     }
     $template="renvoyerToken";
     $page_titel="Renvoyer Token";
     include "../../auth_layout.phtml";
?>