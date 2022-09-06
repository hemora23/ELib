<?php

 
// Include Composer autoloader if not already done.
include '../vendors/autoload.php';
 
// Parse pdf file and build necessary objects.
$parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile('../document_index/Enterprise Architecture IT BJS 2014.pdf');
 
// Retrieve all pages from the pdf file.
$pages  = $pdf->getPages();

// Loop over each page to extract text.

foreach ($pages as $page) {
    $text= $page->getText();
	$text = str_replace(array('&', '%', '$','\"','\'',' '), '', $text);
	echo $text.'<br>';
}
 
?>
