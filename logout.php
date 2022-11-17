<?php 
 session_start();
 if(!isset($_SESSION['id']) || !isset($_SESSION['idUser'])){
    header("location:./auth/login");
    exit;
 }

 session_destroy();
 unset($_SESSION['id']);
 unset($_SESSION['idUser']);
 header("location:./auth/login");
?>