<?php

// Include the main TCPDF library
require_once('library/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Brayan Rodriguez');
$pdf->SetTitle('Resumen de compra: ');


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . '', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// Set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
$pdf->AddPage();

// Set some content to print
$html = <<<EOD
<h1 style="text-align: center; margin-top: 50px;">Gracias por comprar en <a href=""
style="text-decoration:none;background-color:#BDE0DC;color:white;">&nbsp;
<span style="color:black;">Kiddo</span><span style="color:white;">Sound</span>&nbsp;</a>!</h1>
<i style="text-align: center; display: block; margin-bottom: 20px;">Resumen de su compra.</i>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Add image and text in the header

$pdf->SetXY(25, 10);
$pdf->Write(0, 'kiddoSound', '', 0, 'C', true, 0, false, false, 0);

// Close and output PDF document
$pdf->Output('example_001.pdf', 'I');

?>