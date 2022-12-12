<?php 

    session_start();
    if(!isset($_SESSION['lang'])){
        $_SESSION['lang']='en';
    }else if(isset($_GET['lang']) && $_GET['lang']!=$_SESSION['lang'] && !empty($_GET['lang'])){
        if($_GET['lang']=='en'){
            $_SESSION['lang']='en';
        }elseif(  $_GET['lang']=='fr'){
            $_SESSION['lang']='fr';
        }elseif( $_GET['lang']=='ar'){
            $_SESSION['lang']='ar';
        }
    }
    
    require_once "./languages/".$_SESSION['lang'].".php";
    $page_titel="Bizo Mejri";
    $show=null;
    include "./layout.phtml";
?>