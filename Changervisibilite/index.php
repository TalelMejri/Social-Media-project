<?php

    include "../classes/classes.php";
    
  
    if(isset($_POST['submit'])){
       // echo "test";
        extract($_POST);
        $user=new user_manager();
        $user->changer_visib($id);
    }
    header("location:../ProfilUser");
?>
