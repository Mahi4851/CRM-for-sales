<?php

include_once('config.php');
require_once('dompdf/autoload.inc.php');






use Dompdf\Dompdf;

$dompdf = new Dompdf();

ob_start();
require('report.php');

$html=ob_get_contents();
ob_clean();


$dompdf->loadHtml($html);

 


$dompdf->setPaper('A4', 'landscape');


$dompdf->render();



$dompdf->stream( 'Data.pdf', ['Attachment' => true]);

?>