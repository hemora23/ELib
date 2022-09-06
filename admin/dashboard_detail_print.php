<?php
ob_start();
require('fpdf.php');
require("library/inc.connection.php");
include_once "library/inc.seslogin.php";


$tgl1	= isset($_GET['fr']) ?  $_GET['fr'] : date('Y-m-d'); 
$tgl2	= isset($_GET['to']) ?  $_GET['to'] : date('Y-m-d'); 
$web	= isset($_GET['w']) ?  $_GET['w'] : 'Y'; 
$mobile	= isset($_GET['m']) ?  $_GET['m'] : 'Y'; 
$title	= isset($_GET['t']) ?  $_GET['t'] : 'Report of visitors by date'; 


class PDF extends FPDF
{

// Page header
function Header()
{	

	

  $x = $this->GetX();
	$y = $this->GetY();
	$this->SetXY($x+0, $y+0);
	$this->Image('images/logo_pdf.png',10,10, 40);
	$this->SetXY($x+0, $y+10);
	$this->Ln();
	
}

// Page footer
function Footer()
{
	$this->AliasNbPages('{totalPages}');
    $this->SetY(-15);
	$y = $this->GetY();
    $this->SetFont('Arial','I',8);
    $this->Cell(100,5,'Milik / Property of PT Bank KEB Hana Indonesia',0,0,'L');
	$this->Cell(100,5,$this->PageNo().' of {totalPages}',0,0,'R');
    
}
var $widths;
var $aligns;

function SetWidths($w)
{
    $this->widths=$w;
}

function SetAligns($a)
{
    $this->aligns=$a;
}
function Row($data)
{
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
    $h=4*$nb;
    $this->CheckPageBreak($h);
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        $x=$this->GetX();
        $y=$this->GetY();
        $this->Rect($x, $y, $w, $h);
        $this->MultiCell($w, 4, $data[$i], 0, $a);
        $this->SetXY($x+$w, $y);
    }
    $this->Ln($h);
}
function CheckPageBreak($h)
{
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w, $txt)
{
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r", '', $txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}
}



//PDF format
$pdf = new PDF('P','mm','A4');
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);
$pdf->AddPage();

$id	    = isset($_GET['id']) ?  $_GET['id'] : ''; 
$id2	= isset($_GET['id2']) ?  urldecode($_GET['id2']) : ''; 
$id3	= isset($_GET['id3']) ?  urldecode($_GET['id3']) : ''; 
$id4	= isset($_GET['id4']) ?  urldecode($_GET['id4']) : ''; 

switch ($id) {
    case "1":
        $title='Detail Report of Top 10 Visitor';
        $columntitle='Visitor';
        $columntitle2='Login Date';
        $columntitle3='Media';
        $columntitle4='Visitor : '.$id2;
        $mySql 	= "select user_fullname as title, log_date as title2, log_apps as title3 from view_log_user where user_fullname='".$id2."' order by log_date desc ";
        break;
    case "2":
        $title="Detail Report of Top 10 Documents";
        $columntitle='Document';
        $columntitle2='Reader';
        $columntitle3='Reading Date';
        $columntitle4='Document : '.$id2;
        $mySql 	= "select document_title_id as title, user_fullname as title2, log_date as title3 from view_log_document where document_title_id='".$id2."' order by log_date desc";
        break;
    case "3":
        $title="Detail Report of Top 10 Reader";
        $columntitle='Reader';
        $columntitle2='Document';
        $columntitle3='Reading Date';
        $columntitle4='Reader : '.$id2;
        $mySql 	= "select user_fullname as title, document_title_id as title2, log_date as title3 from view_log_document where user_fullname='".$id2."' order by log_date desc";
        break;
    case "4":
        $title="Detail Report of Total Visitors (Monthly)";
        $columntitle='Visitor';
        $columntitle2='Login Date';
        $columntitle3='Media';
        $columntitle4='Month : '.$id2.' '.$id4;
        $mySql 	= "select user_fullname as title, log_date as title2, log_apps as title3 from view_log_user where MONTHNAME(log_date) ='".$id2."' and YEAR(log_date)='".$id4."' and log_apps='".$id3."'  order by log_date desc";
        break;
    case "5":
        $title="Detail Report of Total Documents Read (Monthly)";
        $columntitle='Document';
        $columntitle2='Reader';
        $columntitle3='Reading Date';
        $columntitle4='Month : '.$id2.' '.$id3;
        $mySql 	= "select document_title_id as title, user_fullname as title2, log_date as title3 from view_log_document where MONTHNAME(log_date) ='".$id2."' and YEAR(log_date)='".$id3."' order by log_date desc";
        break;
    case "6":
        $title="Detail Report of Total Visitors (Daily)";
        $columntitle='Visitor';
        $columntitle2='Login Date';
        $columntitle3='Media';
        $columntitle4='Date : '.$id2;
        $mySql	= "select user_fullname as title, log_date as title2, log_apps as title3 from view_log_user where  date(log_date)='".$id2."' order by log_date desc ";
        break;
    case "7":
        $title='Detail Report of All Visitor';
        $columntitle='Visitor';
        $columntitle2='Login Date';
        $columntitle3='Media';
        $columntitle4='Visitor : '.$id2;
        $mySql 	= "select user_fullname as title, log_date as title2, log_apps as title3 from view_log_user where user_fullname='".$id2."' order by log_date desc ";
        break;
    default:
        $title='Detail Report of Top 10 Visitor';
        $columntitle='Visitor';
        $columntitle2='Login Date';
        $columntitle3='Media';
        $mySql 	= "select user_fullname as title, log_date as title2, log_apps as title3 from view_log_user where user_fullname='".$id2."' order by log_date desc ";
}

//baris ke-1
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,8,$title,'',0,'C',0); 
$pdf->Ln();
$pdf->SetFont('Arial','B',8);
$pdf->Cell(190,4,$columntitle4,'',0,'C',0); 
$pdf->Ln();
$pdf->Ln();



// tabel
$pdf->SetFont('Arial', 'B',8);
$pdf->Cell(10,8,'No','1',0,'C',0);
$pdf->Cell(70,8,$columntitle,'1',0,'C',0); 
$pdf->Cell(70,8,$columntitle2,'1',0,'C',0); 
$pdf->Cell(40,8,$columntitle3,'1',0,'C',0); 

$pdf->Ln();
//Tabel 


$pdf->SetFont('Arial', '', 8);


									
$myQry		= mysqli_query($koneksidb,$mySql)  or die ("RENTAS KMS ERROR : ".mysqli_error($koneksidb));
$nomor		= 0;
$title_before='';
while ($myData = mysqli_fetch_array($myQry)) {
    
    $nomor++;
    $pdf->Cell(10,4,$nomor,'1',0,'C',0);
    $pdf->Cell(70,4,$myData['title'],'1',0,'L',0); 
    $pdf->Cell(70,4,$myData['title2'],'1',0,'L',0); 
    $pdf->Cell(40,4,$myData['title3'],'1',0,'L',0); 
    $pdf->Ln();
	
}
$pdf->Ln();



$pdf->Output();
ob_end_flush(); 

//include "footer.php";
?>


