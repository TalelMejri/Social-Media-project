<?php 

use PHPMailer\PHPMailer\PHPMailer;

include "./send.php";
if(isset($_POST['submit'])){
    extract($_POST);
    sendmail("Bizo Officiel",$email,"We've recieved your message", "Thank you for sending us a message one of our agents will get back to you soon ");
    sendmail("Bizo Officiel","bizomejri@gmail.com", "New message from ".$name, $messages);
}

include "./index.php";

?>