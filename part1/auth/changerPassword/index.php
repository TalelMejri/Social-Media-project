<?php
  include "../../classes/classes.php";
  $user=new user_manager();
  $step=1;
  $error=[];
  if(isset($_POST['Suivant'])){
    $step=0;
    extract($_POST);
    if(empty($email)){
        header("location:index.php?msg=email required");
        exit;
    }
     if(empty($code)){
        header("location:index.php?msg=code required");
        exit;
    }
    if(strlen($code)!=4){
        header("location:index.php?msg=should be 4 number");
        exit;
    }
    $check_code=$user->checkToken($email,$code);
    $id=$check_code['iduser'];
    if(!$check_code){
        $step=1;
        header("location:index.php?msg=Please check the code or the email");
        exit;
    }else{
        //header("location:index.php?id=".$id);
        $step=0;
    }
  }

  if(isset($_POST['submit'])){
    $step=0;
    extract($_POST);
    $step=0;
    if(empty($password)){
        $step=0;
        $error[0]="password required ";
        goto show;
    }
    else if(empty($confirm)){
        $step=0;
        $error[0]="confirm required ";
        goto show;
    }
    else if($confirm!=$password){
        $step=0;
        $error[0]="confirm should be like password ";
        goto show;
    }else{
        $step=0;
        $user->changerPassword($password,$id);
        header("location:../login?msg=password has been changed&type=success");
        exit;
    }
  }
  
  show:
  $template="changerPassword";
  $page_titel="Changer Password";
  include "../../auth_layout.phtml";

?>