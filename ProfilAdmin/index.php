<?php

    session_start();
    if(!$_SESSION['id']){
        header("location:../../auth/login");
        exit;
    }
    $show=false;
    $template="ProfilUser";
    $page_titel="Bizo";
    include "../layout.phtml";

?>