<?php
# Fungsi untuk membuat kode automatis
function buatNomor($tabel,$code,$tgl){
	global $koneksidb;
	
	$mySql	= "SELECT code_name, code_lenght FROM master_code where code_table='$tabel' ";
	$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query salah : ".mysqli_error());
	$myData = mysqli_fetch_array($myQry);
	$dataCode	= $myData['code_name'];
	$dataLenght	= $myData['code_lenght'];
	
	$dataRomawi = array('','I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII');
	$month = date("m",strtotime($tgl));
	$romawi = $dataRomawi[date("n",strtotime($tgl))];
	$year = date("y",strtotime($tgl));
	$format = $dataCode;
	$format = str_replace("{code}",$code,$format);
	$format = str_replace("{romawi}",$romawi,$format);
	$format = str_replace("{year}",$year,$format);
	$format = str_replace("{month}",$month,$format);
		
	$mySql	= "SELECT * FROM $tabel";
	$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query salah : ".mysqli_error());
	$finfo	= mysqli_fetch_field_direct($myQry, 0);
	$field = $finfo->name;
	
	$mySql	= "SELECT ifnull(max(left($field,$dataLenght)),0)+1 as counter from $tabel where right($field,2)=$year  order by $field desc limit 1";
	$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query salah : ".mysqli_error());
	$myData = mysqli_fetch_array($myQry);
	
	$number	= sprintf("%0".$dataLenght."s",$myData['counter']);
	$format = str_replace("{number}",$number,$format);
	
	return $format;
}
function buatNomorUrut($tabel){
	global $koneksidb;
	
	$mySql	= "SELECT code_name, code_lenght FROM master_code where code_table='$tabel' ";
	$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query salah : ".mysqli_error());
	$myData = mysqli_fetch_array($myQry);
	$dataCode	= $myData['code_name'];
	$dataLenght	= $myData['code_lenght'];
	$format = $dataCode;
		
	$mySql	= "SELECT * FROM $tabel";
	$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query salah : ".mysqli_error());
	$finfo	= mysqli_fetch_field_direct($myQry, 0);
	$field = $finfo->name;
	
	$mySql	= "SELECT ifnull(max(left($field,$dataLenght)),0)+1 as counter from $tabel  order by $field desc limit 1";
	$myQry	= mysqli_query($koneksidb,$mySql)  or die ("Query salah : ".mysqli_error());
	$myData = mysqli_fetch_array($myQry);
	
	$number	= sprintf("%0".$dataLenght."s",$myData['counter']);
	$format = str_replace("{number}",$number,$format);
	
	return $format;
}


function buatCode($tabel, $inisial){
	
	global $koneksidb;
	 $mySql= "SELECT * FROM $tabel";
	$struktur	= mysqli_query($koneksidb,$mySql);
	
	$finfo	= mysqli_fetch_field_direct($struktur, 0);
	$field = $finfo->name;
	$panjang = 10;//$finfo->max_length;
	
 	$qry	= mysqli_query($koneksidb,"SELECT MAX(".$field.") FROM ".$tabel);
 	$row	= mysqli_fetch_array($qry); 
 	if ($row[0]=="") {
 		$angka=0;
	}
 	else {
 		$angka		= substr($row[0], strlen($inisial));
 	}
	
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}



foreach($_POST as $key=>$value) 
        {                  
	if (get_magic_quotes_gpc())     
            {         
            $_POST[$key]=stripslashes($value); 
            }         
 	$_POST[$key] =mysqli_real_escape_string($koneksidb,$_POST[$key]);
        } 

foreach($_GET as $key=>$value) 
        {                  
	if (get_magic_quotes_gpc())     
            {         
            $_GET[$key]=stripslashes($value); 
            }         
 	$_GET[$key] =mysqli_real_escape_string($koneksidb,$_GET[$key]);
        } 

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function getDatetimeNow() {
    $tz_object = new DateTimeZone('Asia/Jakarta');
    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    return $datetime->format('ymdhis');
}



?>