<?php
ob_start();
require('fpdf.php');
require("library/inc.connection.php");
include_once "library/inc.seslogin.php";


$tgl1    = isset($_GET['fr']) ?  $_GET['fr'] : date('Y-m-d');
$tgl2    = isset($_GET['to']) ?  $_GET['to'] : date('Y-m-d');
$user        = isset($_GET['user']) ?  $_GET['user'] : '%';
$div        = isset($_GET['div']) ?  $_GET['div'] : '%';
$dept        = isset($_GET['dept']) ?  $_GET['dept'] : '%';
$doc        = isset($_GET['doc']) ?  $_GET['doc'] : '%';
$docid    = isset($_GET['di']) ?  $_GET['di'] : 'Y';
$docver    = isset($_GET['dv']) ?  $_GET['dv'] : 'Y';
$doctitle    = isset($_GET['dt']) ?  $_GET['dt'] : 'Y';
$div2    = isset($_GET['div2']) ?  $_GET['div2'] : 'Y';
$dept2    = isset($_GET['dept2']) ?  $_GET['dept2'] : 'Y';
$unit    = isset($_GET['unit']) ?  $_GET['unit'] : 'Y';
$pos    = isset($_GET['pos']) ?  $_GET['pos'] : '%';
$pos2    = isset($_GET['pos2']) ?  $_GET['pos2'] : 'Y';
$title    = isset($_GET['t']) ?  $_GET['t'] : 'Report of document';

class PDF extends FPDF
{

    // Page header
    function Header()
    {



        $x = $this->GetX();
        $y = $this->GetY();
        $this->SetXY($x + 0, $y + 0);
        $this->Image('images/logo.png', 10, 8, 15);
        // $this->Image('images/logo.png', 10, 10, 20);
        $this->SetXY($x + 0, $y + 10);
        $this->Ln();
    }

    // Page footer
    function Footer()
    {
        $date = date('j F Y');
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
$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);
$pdf->AddPage();

$id            = isset($_GET['id']) ?  $_GET['id'] : '';
$mySql        = "SELECT document_title_id FROM document WHERE document_id='$id'";
$myQry        = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
$myData     = mysqli_fetch_array($myQry);
$doctitleid    = $myData['document_title_id'];

//baris ke-1
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(275, 8, $title, '', 0, 'C', 0);
$pdf->Ln();
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(275, 4, 'Date :  ' . date_format(new DateTime($tgl1), "d F Y") . ' - ' . date_format(new DateTime($tgl2), "d F Y"), '', 0, 'C', 0);
$pdf->Ln();

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 8, 'No', '1', 0, 'C', 0);
$pdf->Cell(20, 8, 'Date', '1', 0, 'C', 0);
if ($docid == 'N' && $docver == 'N' && $doctitle == 'N') {

    $pdf->Cell(110, 8, 'File', '1', 0, 'C', 0);
} else {
    $pdf->Cell(60, 8, 'Document', '1', 0, 'C', 0);
    $pdf->Cell(50, 8, 'File', '1', 0, 'C', 0);
}
if ($docid == 'N' && $docver == 'N' && $doctitle == 'N' && $div2 == 'N' && $dept2 == 'N' && $unit == 'N' && $pos2 == 'N') {

    $pdf->Cell(135, 8, 'User', '1', 0, 'C', 0);
} else {
    $pdf->Cell(50, 8, 'User', '1', 0, 'C', 0);
}

$org = '';
if ($div2 == 'Y') {
    $org = "Bagian  -  ";
}
if ($dept2 == 'Y') {
    $org = $org . "Unit  -  ";
}
if ($unit == 'Y') {
    $org = $org . "Prodi  -  ";
}
if ($pos2 == 'Y') {
    $org = $org . "Position";
}
if ($div2 == 'N' && $dept2 == 'N' && $unit == 'N' && $pos2 == 'N') {
} else {
    $pdf->Cell(85, 8, $org, '1', 0, 'C', 0);
}


$pdf->Ln();
//Tabel 


$pdf->SetFont('Arial', '', 6);
if ($docid == 'N' && $docver == 'N' && $doctitle == 'N') {
    if ($div2 == 'N' && $dept2 == 'N' && $unit == 'N' && $pos2 == 'N') {
        $pdf->SetWidths(array(10, 20, 110, 135));
        $pdf->SetAligns(array('C', 'L', 'L', 'L'));
    } else {
        $pdf->SetWidths(array(10, 20, 110, 50, 85));
        $pdf->SetAligns(array('C', 'L', 'L', 'L', 'L'));
    }
} else {
    if ($div2 == 'N' && $dept2 == 'N' && $unit == 'N' && $pos2 == 'N') {
        $pdf->SetWidths(array(10, 20, 60, 50, 135));
        $pdf->SetAligns(array('C', 'L', 'L', 'L', 'L'));
    } else {
        $pdf->SetWidths(array(10, 20, 60, 50, 50, 85));
        $pdf->SetAligns(array('C', 'L', 'L', 'L', 'L', 'L'));
    }
}

$mySqlDtl    = "SELECT * FROM view_log_document WHERE log_date between '$tgl1' and '$tgl2' and user_id like '$user'
				and division like '$div' and department like '$dept' and document_id like '$doc' and position like '$pos' ORDER BY log_date ";

$myQryDtl        = mysqli_query($koneksidb, $mySqlDtl)  or die("RENTAS KMS ERROR : " . mysqli_error($koneksidb));
$nomor        = 0;
$orgdata = '';
$docdata = '';
while ($myDataDtl = mysqli_fetch_array($myQryDtl)) {

    $nomor++;

    if ($docid == 'Y') {
        $docdata = $myDataDtl['document_id'];
    }
    if ($docver == 'Y') {
        $docdata = $docdata . ' v' . $myDataDtl['document_version'];
    }
    if ($doctitle == 'Y') {
        $docdata = $docdata . ' ' . $myDataDtl['document_title_id'];
    }

    if ($div2 == 'Y') {
        $orgdata = $myDataDtl['division'] . '  -  ';
    }
    if ($dept2 == 'Y') {
        $orgdata = $orgdata . $myDataDtl['department'] . '  -  ';
    }
    if ($unit == 'Y') {
        $orgdata = $orgdata . $myDataDtl['unit'] . '  -  ';
    }
    if ($pos2 == 'Y') {
        $orgdata = $orgdata . $myDataDtl['position'];
    }

    if ($docid == 'N' && $docver == 'N' && $doctitle == 'N') {
        if ($div2 == 'N' && $dept2 == 'N' && $unit == 'N' && $pos2 == 'N') {
            $pdf->Row(array($nomor, date_format(new DateTime($myDataDtl['log_date']), "d M Y"), $myDataDtl['document_file_title'], $myDataDtl['user_id'] . ' ' . $myDataDtl['user_fullname']));
        } else {
            $pdf->Row(array($nomor, date_format(new DateTime($myDataDtl['log_date']), "d M Y"), $myDataDtl['document_file_title'], $myDataDtl['user_id'] . ' ' . $myDataDtl['user_fullname'], $orgdata));
        }
    } else {
        if ($div2 == 'N' && $dept2 == 'N' && $unit == 'N' && $pos2 == 'N') {
            $pdf->Row(array($nomor, date_format(new DateTime($myDataDtl['log_date']), "d M Y"), $docdata, $myDataDtl['document_file_title'], $myDataDtl['user_id'] . ' ' . $myDataDtl['user_fullname']));
        } else {
            $pdf->Row(array($nomor, date_format(new DateTime($myDataDtl['log_date']), "d M Y"), $docdata, $myDataDtl['document_file_title'], $myDataDtl['user_id'] . ' ' . $myDataDtl['user_fullname'], $orgdata));
        }
    }


    $orgdata = '';
    $docdata = '';
}
$pdf->Ln();


$pdf->Output();
ob_end_flush(); 

//include "footer.php";
