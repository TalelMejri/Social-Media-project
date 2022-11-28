<?php

use PHPMailer\PHPMailer\PHPMailer;
function sendmail($name,$email,$subject,$message,$file_name=null){
/*Envoi de mail*/
    /*verification que champs nom et email sont non null */
    /* remplissage des variables avec les champs des form */
    /* integration des fichiers phpmailer */
    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail=new PHPMailer();
    /* parametres SMTP */
    $mail->isSMTP();                            //envoyer utilisant SMTP
    $mail->Host="smtp.gmail.com";                //initialization de serveur SMTP
    $mail->SMTPAuth=true;                       //activation SMTP authentification
    $mail->Username="bizomejri@gmail.com";  //ADRESSE SMTP
    $mail->Password="cxjzwcrqdlszqyax";           //Mot de passe SMTP
    $mail->Port=465;                            //Port TCP
    $mail->SMTPSecure="ssl";
    /* Contenu De mail de ADMIN*/
    $mail->isHTML(true);                                        //Format de mail html
    $mail->setFrom("bizomejri@gmail.com",$name);
    $mail->addAddress("$email");               //Adresse reception
    $mail->Subject=("$subject");                       //Le sujet de l'email
    $mail->Body=$message;     
   if($file_name!=null){      
       //Le contenu de mail       
      $mail->addAttachment('../../certificat/Copie_Certificat/'.$file_name);
      /** test existance de la fichier  */
     /* if (file_exists('../../certificat/Copie_Certificat/'.$file_name)){
        echo "exist fileeee";
      }*/
   }
    /* Commande pour envoyer le mail */
    if ($mail->send())
        return 1;
    else   
        return $mail->ErrorInfo;
    }
?>
