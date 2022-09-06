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
	$this->Image('images/logo.png',10,10, 40);
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
    $this->Cell(100,5,'Milik / Property of Sekolah Tinggi Intelijen Negara',0,0,'L');
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

$id	= isset($_GET['id']) ?  preg_replace("/[^a-zA-Z0-9]/", "", $_GET['id']) : ''; 
switch ($id) {
    case "1":
        $title='Report of Top 10 Visitor';
        $columntitle='Visitor';
        $mySql 	= "select user_fullname as title, total from view_log_user_top10 order by total desc limit 10";
        break;
    case "2":
        $title="Report of Top 10 Documents";
        $columntitle='Document';
        $mySql 	= "select document_title_id as title, total from view_log_document_top10 order by total desc limit 10";
        break;
    case "3":
        $title="Report of Top 10 Reader";
        $columntitle='Reader';
        $mySql 	= "select user_fullname as title, total from view_log_document_user_top10 order by total desc limit 10";
        break;
    case "4":
        $title="Report of Total Visitors (Monthly)";
        $columntitle='Month';
        $mySql 	= "select bulan as title, sum(web) as web, sum(mobile) as mobile, tahun from view_log_user_monthly_apps group by bulan order by tahun desc, bulanid limit 10";
        break;
    case "5":
        $title="Report of Total Documents Read (Monthly)";
        $columntitle='Month';
        $mySql 	= "select bulan as title, sum(total) as total, tahun from view_log_document_monthly group by bulan order by tahun desc, bulanid limit 10";
        break;
    case "6":
        $title="Report of Total Visitors (Daily)";
        $columntitle='Date';
        $mySql	= "select daily as title, sum(total) as total from view_log_user_daily where  (daily > DATE_SUB(now(), INTERVAL 30 DAY)) group by daily order by daily limit 10";
        break;
    default:
        $title='Report of Top 10 Visitor';
        $columntitle='Visitor';
        $mySql 	= "select user_fullname as title, total from view_log_user_top10 order by total desc limit 10";
}

//baris ke-1
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,8,$title,'',0,'C',0); 
$pdf->Ln();
$pdf->Ln();

//chart
$x = $pdf->GetX();
$y = $pdf->GetY();
$path = "uploads/files/";
$file = $path."chart".$id.".png";
$pdf->Image($file,$x,$y,190);
$path = "./uploads/qrcode/sales/";
$pdf->Ln();

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x, $y+100);

// tabel
$pdf->SetFont('Arial', 'B',8);
$pdf->Cell(10,8,'No','1',0,'C',0);
$pdf->Cell(100,8,$columntitle,'1',0,'C',0); 
if ($id == '4' ) {
    $pdf->Cell(40,8,'Total Visitor (web)','1',0,'C',0);
    $pdf->Cell(40,8,'Total Visitor (mobile)','1',0,'C',0);
} else {
    $pdf->Cell(80,8,'Total ','1',0,'C',0);
}
$pdf->Ln();
//Tabel 


$pdf->SetFont('Arial', '', 8);


									
$myQry		= mysqli_query($koneksidb,$mySql)  or die ("RENTAS KMS ERROR : ".mysqli_error($koneksidb));
$nomor		= 0;
$title_before='';
while ($myData = mysqli_fetch_array($myQry)) {
    
    $rowLabels[] = $myData['title'];
    $nomor++;
    $pdf->Cell(10,4,$nomor,'1',0,'C',0);
    $pdf->Cell(100,4,$myData['title'],'1',0,'L',0); 
    if ($id == '4' ) {
        $pdf->Cell(40,4,$myData['web'],'1',0,'C',0);
        $pdf->Cell(40,4,$myData['mobile'],'1',0,'C',0);
    } else {
        $pdf->Cell(80,4,$myData['total'],'1',0,'C',0);
    }
    $pdf->Ln();
	
}
$pdf->Ln();



$pdf->Output();
ob_end_flush(); 

//include "footer.php";
