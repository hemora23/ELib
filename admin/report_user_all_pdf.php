<?php
ob_start();
require('fpdf.php');
require("library/inc.connection.php");
include_once "library/inc.seslogin.php";


$title    = isset($_GET['t']) ?  $_GET['t'] : 'Report of all visitors';


class PDF extends FPDF
{

    // Page header
    function Header()
    {



        $x = $this->GetX();
        $y = $this->GetY();
        $this->SetXY($x + 0, $y + 0);
        $this->Image('images/logo.png', 10, 10, 20);
        $this->SetXY($x + 0, $y + 10);
        $this->Ln();
    }

    // Page footer
    function Footer()
    {
        $this->AliasNbPages('{totalPages}');
        $this->SetY(-15);
        $y = $this->GetY();
        $this->SetFont('Arial', 'I', 8);
        $date = date('j F Y');
        $this->Cell(100, 5, 'Print Date :' . $date, 0, 0, 'L');
        $this->Ln();
        $this->Cell(100, 5, 'E-Library Sekolah Tinggi Intelejen Negara', 0, 0, 'L');
        $this->Cell(100, 5, $this->PageNo() . ' of {totalPages}', 0, 0, 'R');
    }
    var $widths;
    var $aligns;

    function SetWidths($w)
    {
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        $this->aligns = $a;
    }
    function Row($data)
    {
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 4 * $nb;
        $this->CheckPageBreak($h);
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            $x = $this->GetX();
            $y = $this->GetY();
            $this->Rect($x, $y, $w, $h);
            $this->MultiCell($w, 4, $data[$i], 0, $a);
            $this->SetXY($x + $w, $y);
        }
        $this->Ln($h);
    }
    function CheckPageBreak($h)
    {
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}



//PDF format
$pdf = new PDF('P', 'mm', 'A4');
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);
$pdf->AddPage();


$title    = isset($_GET['t']) ?  $_GET['t'] : 'Report of All Visitors';

$mySql     = "SELECT u.user_id, u.user_fullname, u.division, u.department, u.unit, (select max(log_date) from view_log_user where user_id=u.user_id) as last_login, count(*) as total 
from view_log_user u group by u.user_id, u.user_fullname, u.division, u.department, u.unit order by u.user_fullname ";


//baris ke-1
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 8, $title, '', 0, 'C', 0);
$pdf->Ln();
$pdf->Ln();


// tabel
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 8, 'No', '1', 0, 'C', 0);
$pdf->Cell(60, 8, 'Visitor', '1', 0, 'C', 0);
$pdf->Cell(75, 8, 'Bagian - Unit', '1', 0, 'C', 0);
$pdf->Cell(30, 8, 'Last Login', '1', 0, 'C', 0);
$pdf->Cell(15, 8, 'Total ', '1', 0, 'C', 0);

$pdf->Ln();
//Tabel 


$pdf->SetFont('Arial', '', 8);
$pdf->SetWidths(array(10, 60, 75, 30, 15));
$pdf->SetAligns(array('C', 'L', 'L', 'C', 'C'));


$myQry        = mysqli_query($koneksidb, $mySql)  or die("RENTAS KMS ERROR : " . mysqli_error($koneksidb));
$nomor        = 0;

while ($myData = mysqli_fetch_array($myQry)) {
    $nomor++;
    $pdf->Row(array($nomor, strtoupper($myData['user_fullname']), $myData['division'] . ' - ' . $myData['department'], $myData['last_login'], $myData['total']));
}
$pdf->Ln();



$pdf->Output();
ob_end_flush(); 

//include "footer.php";
