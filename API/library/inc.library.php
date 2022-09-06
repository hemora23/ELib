<?php

function buatKode($tabel, $inisial){
	
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



?>