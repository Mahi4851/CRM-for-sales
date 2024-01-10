

<?php 

session_start();

$eml=$_SESSION['email'];

?>


<?php 

include_once("config.php");


$result=mysqli_query($conn,"select * from crm_contact where Emp_Email='$eml' and status='Opportunity'");

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		



	


	</style>
</head>
<body>
	<?php
?>

<center><h1>Opportunity Report</h1></center>
	
	<center><table  border="1" > 
		<tr>
			<th>ID</th>		
			<th>Name</th>			
					
			<th>Company Name</th>
			<th>Industry</th>
			<th>Budget</th>
			<th>Website</th>
			<th>Mobile</th>
			<th>Landline</th>
			<th>Email</th>						
			<th>City</th>
			
		</tr>
		<?php

			$i=1;
		while($res=mysqli_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td>".$res['contact_first']." ".$res['contact_last']."</td>";
			//echo "<td>".$res['contact_last']."</td>";
			echo "<td>".$res['company']."</td>";
			echo "<td>".$res['industry']."</td>";
			echo "<td>".$res['budget']."</td>";
			echo "<td>".$res['website']."</td>";
			echo "<td>".$res['mobile']."</td>";
			echo "<td>".$res['LandLine']."</td>";
			echo "<td>".$res['email']."</td>";
			echo "<td>".$res['city']."</td>";	
			
			

			$i++;
		}

		?>
	</table>
</center>

</body>
</html>