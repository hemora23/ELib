<?php 
$txtID 		 = $_POST['txtID'];
$txtCategory = $_POST['txtCategory'];

if(isset($_POST['btnDocument'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Document&id=".$txtID."&ca=".$txtCategory."'>";
}


?>
 
