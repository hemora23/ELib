<?php
$myHost	= "202.154.3.188";
$myUser	= "root";
$myPass	= "Jakarta2015";
$myDbs	= "rentas_commerce_db"; 
$koneksidb	= mysqli_connect($myHost, $myUser, $myPass);
if (! $koneksidb) {  echo "Failed Connection !";}
mysqli_select_db($koneksidb, "rentas_commerce_db") or die ("Database not Found !");
?>