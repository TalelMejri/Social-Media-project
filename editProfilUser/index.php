<?php 
    session_start();
    include "../classes/classes.php";
    $user=new user_manager();
    $errors=[]; 
  

     if(isset($_POST['edit'])){
        extract($_POST);
/* $avataruplaod=0;
        if(strlen($_FILES['avatar']['name'])){
            $file=new file('../storage/',$_FILES['avatar']);
            $avatar="/storage/".$file->getfilename();
            if($file->uploadImage())
            {
                $errors[0]="upload failed";
                goto show;
            }
            $avataruplaod=1;
        }
*/
$avatarupload=0;
$avatar="";
if(strlen($_FILES['avatar']['name'])){
$array=['jpg','png','jpeg'];
$type=pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION);
$name_file=md5(mt_rand()).'.'.$type;
if($_FILES['avatar']['size']>99999999){
    $errors[0]="upload failed";
                goto show;
}else if(!in_array($type,$array)){
    $errors[0]="upload failed";
    goto show;
}else if(!move_uploaded_file($_FILES['avatar']['tmp_name'],'../storage/'.$name_file)){
    $errors[0]="upload failed";
    goto show;
}
$avatar="/storage/".$name_file;
$avatarupload=true;
}
            $user->edituser($name,$last,$date,$avatar,$avatarupload,$_SESSION['idUser']);
            header("location:../profiluser");
    
     }

    show: 
    $mode_visibiltes=$user->getModeAffichage($_SESSION['idUser']);
    $show=null;
    $template="editUser";
    $page_titel="Edit";
    include "../layout.phtml";

?>

