<?php

    include "../classes/classes.php";
    
  
    if(isset($_POST['show_sombre']) || isset($_POST['show_clair'])){
            extract($_POST);
            $user=new user_manager();
            $user->changer_visib($id);
    }


    header("location:../ProfilUser");
?>
