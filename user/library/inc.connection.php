<?php
$myHost	= "localhost";
$myUser	= "root";
$myPass	= "Rentas123!@#";
$myDbs	= "rentas_elib_db"; 
$koneksidb	= mysqli_connect($myHost, $myUser, $myPass);
if (! $koneksidb) {
  echo "Failed Connection !";
}
mysqli_select_db($koneksidb, "rentas_elib_db") or die ("Database not Found !");
