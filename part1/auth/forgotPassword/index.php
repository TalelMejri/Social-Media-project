<?php
    include "../../classes/classes.php";
    include "../../send.php";
    use PHPMailer\PHPMailer\PHPMailer;
    $user=new user_manager();
    if(isset($_POST['suivant'])){
        extract($_POST);
         if(empty($email)){
            header("location:index.php?msg=email required");
         }
        $checkemail=$user->checkEmail($email);
        if($checkemail){
             if($checkemail['verified']==0){
                header("location:index.php?msg=account shoul be verified");
             }else{
                $token=rand(10,9999);
                $user->addtoken_password($token,$checkemail['iduser']);
                sendmail("Bizo Officel",$email,"Reset Password","Votre code :".$token);
                header("location:../changerPassword");
             }
        }else{
            header("location:index.php?msg=user doesn't exist");
        }
    }
   $template="forgotPassword";
   $page_titel="Forgot Password";
   include "../../auth_layout.phtml";
?>