<?php 

include_once("config.php");
header("content-Type: application/vnd.ms-excel");

header("content-Disposition: attachment; Filename=mydata.xls");

require 'report.php';

?>	