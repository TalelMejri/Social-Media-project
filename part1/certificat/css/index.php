<?php 

    session_start();
    include "../../classes/classes.php";
    $user=new user_manager();
    include "../../send.php";
    use PHPMailer\PHPMailer\PHPMailer;
    ob_start();
    require "../../fpdf/fpdf.php";

    $pdf=new FPDF();
    $show_congrats=0;
    $show_next_time=0;
    if(isset($_POST['Envoyer'])){
      
        extract($_POST);
        $question1='A';
        $question2='B';
        $question3='B';
        $question4='A';

        $score=0;
        if($q1=='A'){
            $score+=20;
        }
        if($q2=='B'){
            $score+=20;
        }
        if($q3=='B'){
            $score+=20;
        }
        if($q4=='A'){
            $score+=20;
        }
           
        if($score>60){
               $user->addCertif($_SESSION['idUser'],'css');
                $show_congrats=1;
                $pdf->AddPage('L','A4');
            
                $pdf->Image('../Modele/Modele_css.PNG',0,0,300 ,210.8);
            /*
                $pdf->cell(59,140,$_SESSION['nameUser'],0,1);
                $pdf->cell(59,140,'HTML',0,1);
                $pdf->cell(60,130,'HTML',0,1);
            */
                $pdf->SetFont('Arial','',27);
                $pdf->cell(0,175,$_SESSION['nameUser'],0,0,'C');
                //$pdf->ln();
              /*  $pdf->SetFont('Arial','',17);
                $pdf->cell(40,100,"HTML",0,0);*/
              /*
                $pdf->cell(59,20,"HTML",0,1);
                $pdf->cell(0,5,"HTML:",0,1);
                */
                $file_name=$_SESSION['nameUser'].rand(10,9999)."CSS.pdf";
                $file=$pdf->Output("../Copie_Certificat/".$file_name,"F");
                sendmail("Bizo",$_SESSION['emailUser'],"Certificat","Your Certif CSS",$file_name);
                ob_end_flush(); 
                goto show;
        }else{
            $show_next_time=1;
            goto show;
        }
    }
    
    show:
    $template="css_test";
    $page_titel="CSS";
    include "../../auth_layout.phtml";

?>