<?php
$document_root = $_SERVER['DOCUMENT_ROOT'];
include_once $document_root.'/controladores/formularios.controlador.php';
include_once $document_root.'/modelos/formularios.modelo.php';
include_once $document_root.'/codigo_qr/phpqrcode/qrlib.php';
require_once($document_root.'/fpdf/fpdf.php');

if(isset($_REQUEST['idh'])){
  $idHotel=base64_decode($_REQUEST['idh']);
}

if(isset($_REQUEST['hab'])){
  $hab=base64_decode($_REQUEST['hab']);
}

if(isset($_REQUEST['qrHab'])){
  $qr=base64_decode($_REQUEST['qrHab']);
}
//function ctrPdf($idHotel, $hab, $qr)
  //$nomDir,$dirQR, $numHabita

    $document_root = $_SERVER['DOCUMENT_ROOT']."/vistas/img/qr";
    //$_SERVER["SERVER_NAME"]
    if (isset($hab) && isset($qr)){
      $pos=stripos($qr,'/',1);
      $pos2=stripos($qr,'.',1);
      $dirpdf=$document_root.substr($qr, 0,$pos).'/pdf';
      $dirpdf2=$_SERVER["DOCUMENT_ROOT"].'/vistas/img/qr'.substr($qr, 0,$pos).'/pdf';
      $Abrirpdf='/vistas/img/qr'.substr($qr, 0,$pos).'/pdf';
      
      $dir=$document_root.$qr;
      $arcpdf=substr($qr, $pos+1,$pos2-$pos).'pdf';
      $qr2=substr($qr, 0,$pos).'/pdf'.'/'.$arcpdf;
      $idh=$idHotel;//intval(substr($qr, 1,$pos-1));
      $dirpdf2=$dirpdf2.'/'.$arcpdf;
      $Abrirpdf=$Abrirpdf.'/'.$arcpdf;
      /*
      echo '
      <script type="text/javascript">
        console.log("'.$dirpdf2.'");
      </script>
      ';
      */
      
      if (!file_exists($dirpdf)){
        mkdir($dirpdf);
      }

      //ModeloFormularios::mdlPdf($idh, $arcpdf, $dirpdf,$dir, $hab);
    }

    $document_root = $_SERVER['DOCUMENT_ROOT'];
    $logoHotel = ModeloFormularios::mdlSeleccionarRegistros('hotel', 'idHotel', $idHotel);
    $dirQR=$dir;
    $dirLg=$document_root.'/vistas/img/usuarios/'.$logoHotel["logoHotel"];
    $dirVx=$document_root.'/img/logo.jpg';
    $dirMrg=$document_root.'/img/margen.png';
    $tipoLogo=strtoupper((substr($logoHotel["logoHotel"],strpos($logoHotel["logoHotel"],'.')+1,3)));
    $pdf = new FPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('P','Letter');
    $pdf->SetLineWidth(1.25);
    $pdf->SetDrawColor(10,77,158);
    if($logoHotel["logoHotel"]!=''){
    $pdf->Image($dirLg,20,5,0,15,$tipoLogo);}
    $pdf->Image($dirMrg,0,0,0,280,'PNG');
    $pdf->Image($dirMrg,197,0,0,280,'PNG');
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(180,5,utf8_decode('ROOM: '.$hab),0,1,'R');
    $pdf->Ln(18);
    $pdf->SetFont('Arial','B',38);
        $pdf->Cell(0,10,utf8_decode('SERVICE TO GUEST:'),0,1,'C');
    $pdf->Image($dirQR,30,45,0,150,'PNG');
    $pdf->Ln(150);
    $pdf->Image($dirVx,140,185,0,5,'JPG');
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',30);
    $pdf->Cell(0,10,utf8_decode('FASTER THAN ONE'),0,1,'C');
    $pdf->Cell(0,10,utf8_decode('PHONE CALL!'),0,1,'C');
    $pdf->AddPage('P','Letter');
    $pdf->Image($dirMrg,0,0,0,280,'PNG');
    $pdf->Image($dirMrg,197,0,0,280,'PNG');
    $pdf->SetFont('Arial','B',40);
    $pdf->Ln(10);
    $pdf->Cell(90,15,utf8_decode('1. Scan'),0,0,'R');

    $pdf->SetFont('Arial','',40);
    $pdf->Cell(110,15,utf8_decode('the QR code'),0,1,'L');

    $pdf->Ln(15);
    $pdf->SetFont('Arial','B',40);
    $pdf->Cell(125,15,utf8_decode('2. Select'),0,0,'R');
    $pdf->SetFont('Arial','',40);
    $pdf->Cell(80,15,utf8_decode('what'),0,1,'L');
    $pdf->SetFont('Arial','',36);
    $pdf->Cell(0,15,utf8_decode('need (if not listed'),0,1,'C');
    $pdf->Cell(0,15,utf8_decode('you can write it).'),0,1,'C');
    $pdf->Ln(25);
    $pdf->SetFont('Arial','B',36);
    $pdf->Cell(0,15,utf8_decode('DONE!'),0,1,'C');

    $pdf->Cell(0,15,utf8_decode('IT`S A PLEASURE TO SERVE YOU'),0,1,'C');
    $pdf->Ln(25);
    $pdf->SetFont('Arial','',36);
    $pdf->Cell(138,15,utf8_decode('Online Tracking,'),0,0,'R');
    $pdf->SetFont('Arial','B',36);
    $pdf->Cell(62,15,utf8_decode('meets'),0,1,'L');

    $pdf->Cell(0,15,utf8_decode('who will support you and the time'),0,1,'C');

    $pdf->Cell(85,15,utf8_decode('attention.'),0,0,'R');

    $pdf->SetFont('Arial','',36);
    $pdf->Cell(115,15,utf8_decode('Rate the service'),0,1,'L');

    $pdf->Cell(0,15,utf8_decode('and help us make your stay'),0,1,'C');

    $pdf->Cell(0,15,utf8_decode('be the best experience.'),0,1,'C');

    $pdf->Close();
    $user_agent = $_SERVER["HTTP_USER_AGENT"];
    if(preg_match("/(android|webos|avantgo|iphone|ipod|ipad|bolt|boost|cricket|docomo|fone|hiptop|opera mini|mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",$user_agent ))
    {
        //echo "mobile device detected";
        //if (!file_exists($dirpdf2)){
            $pdf->Output('F', $dirpdf2,true);
       // }
        
        echo '
        <script type="text/javascript">
           window.location.replace("'.$Abrirpdf.'");
        </script>
        ';
        exit();
        //$pdf->Output('D', $arcpdf,true);
        //$pdf->Output('I', $arcpdf,true);
    }
    else{
        //echo "mobile device not detected";
        $pdf->Output();
    }
    //
    
    
    //$pdf->Output();
    //return "ok";
    //return $pdf->Output();
    
  