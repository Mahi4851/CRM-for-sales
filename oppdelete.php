<?php 
include_once("config.php");


	$id=$_GET['id'];
	

	$result=mysqli_query($conn,"delete from crm_contact where id=$id");
	
header("Location: viewopp.php");

?>