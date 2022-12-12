
<?php 
     session_start();
     if(!isset($_SESSION['name'])){
          header("location:../auth/login");
          exit;
      }
      if(!array_key_exists('id',$_GET)){
          header("location:../auth/login");
          exit;
         }
     require_once("./classes/classes.php");
     $user=new user_manager();
     $user->unblock_user($_GET['id']);
     header("location:./consulte_user?msg=user blocked&type=success");
     exit;
?>