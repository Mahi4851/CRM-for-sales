<?php 

include_once("config.php");
header("content-Type: application/vnd.ms-excel");

header("content-Disposition: attachment; Filename=taskdata.xls");

require 'taskreport.php';

?>	