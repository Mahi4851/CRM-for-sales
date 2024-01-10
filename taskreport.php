

<?php 

session_start();

$eml=$_SESSION['email'];

?>


<?php 

include_once("config.php");


$result=mysqli_query($conn,"select crm_tasks.*, crm_contact.company
        FROM crm_tasks
        INNER JOIN crm_contact ON crm_tasks.contact = crm_contact.id
         WHERE crm_tasks.sales_rep = '$eml'");

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



			<h3 align="center">Task Report</h3>
	
	<center><table  border="1" > 
		<tr>
			<th>ID</th>
			<th>Task Type</th>
			<th>Task Description</th>		
			<th>Task Assigned</th>			
			<th>Company</th>			
			<th>Due Date</th>			
			<th>Remark</th>
			<th>Status</th>


		</tr>
		<?php


		 $i=1;
		while($res=mysqli_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td>".$res['task_type']."</td>";
			echo "<td>".$res['task_description']."</td>";
			echo "<td>".$res['sales_rep']."</td>";
			echo "<td>".$res['company']."</td>";
			echo "<td>".$res['task_due_date']."</td>";
			echo "<td>".$res['task_update']."</td>";			
			echo "<td>".$res['task_status']."</td>";
			
			
			
			$i++;
			

			
		}

		?>
	</table>
</center>

</body>
</html>