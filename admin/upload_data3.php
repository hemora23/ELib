<?php
$id	= isset($_GET['id']) ?  $_GET['id'] : ''; 
$upload_dir = "uploads/files/";
$img = $_POST['hidden_data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = $upload_dir  . "chart3.png";
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';

?>