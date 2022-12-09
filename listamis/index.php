<?php

session_start();
include "../classes/classes.php";

$user=new user_manager();
$count=ceil($user->countFriend($_SESSION['idUser']));

$error=[];

$limit=isset($_GET['record']) &&  is_numeric($_GET['record']) ? $_GET['record'] : 5 ;
$pages=ceil($count/$limit);
$page=isset($_GET['page']) &&  is_numeric($_GET['page']) ?  $_GET['page'] : 1 ; 
$next=$page < ($count / $limit) ? $page+1 :1;
$previous=$page>1 ? $page-1 :1;
$start=($page-1)*$limit;

if(isset($_GET['btn_search'])){
   extract($_GET);
   if(empty($search)){
      $error['search']="filed empty";
   }else{
     $all_friends=$user->search_friend_by_name($search,$_SESSION['idUser'],$limit,$start);
     if(!$all_friends){
        $all_friends='vide';
     }
     $pages=ceil($user->count_search_friend($search,$_SESSION['idUser'])/$limit);
     $next=$page<($user->count_search_friend($search,$_SESSION['idUser'])/$limit) ? $page+1 :1;
   }
}else{
    $all_friends=$user->get_all_friend($_SESSION['idUser'],$limit,$start);
}


/*$all_user_filter=[];

foreach($all_friends as $item){
    if($user->get_user_filter_friend($item['iduser'],$_SESSION['idUser'])){
        array_push($all_user_filter,$item);
    }
}*/

if(isset($_GET['id_user_retirer'])){
    $id=$_GET['id_user_retirer'];
    $user->delete_ami($id,$_SESSION['idUser']);
}


$mode_visibiltes=$user->getModeAffichage($_SESSION['idUser']);
$show=false;
$template="listamis";
$page_titel="Amis";
include "../layout.phtml";
?>