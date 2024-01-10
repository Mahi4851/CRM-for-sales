

<?php 

session_start();

$eml=$_SESSION['email'];

?>




<?php
include_once("config.php");


$id = $_GET['id'];

// Retrieve the data from the database
$sql = "SELECT company FROM crm_contact WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);

    $company=$row['company'];
   
    

}
//} 

?>



<?php 

//include_once("config.php");



$result=mysqli_query($conn,"select * from crm_tasks where contact='$company' AND sales_rep='$eml'");

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>


		<?php include("include/head.php");?>
	<style type="text/css">

	table{margin: 20px;}
th{text-align: center;}
	td{padding: 5px;}


	</style>
</head>
<body>
	<?php include("include/menu.php");?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
	<?php include("include/fixt.php");?>
    
 <div class="content">
            <div class="animated fadeIn">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Task List</strong>
                            </div>
                            <div class="card-body card-block">



			
	
	<center><table  border="1" > 
		<tr>
			<th>ID</th>
			<th>Task Type</th>
			<th>Task Description</th>			
			<th>Due Date</th>
			<th>Company</th>			
			
			<th>Status</th>
			<th>Remark</th>



		</tr>
		<?php


	$i=1;
		while($res=mysqli_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td>".$res['task_type']."</td>";
			echo "<td>".$res['task_description']."</td>";
			echo "<td>".$res['task_due_date']."</td>";
			echo "<td>".$res['contact']."</td>";
			//echo "<td>".$res['sales_rep']."</td>";
			echo "<td>".$res['task_status']."</td>";
			echo "<td>".$res['task_update']."</td>";
			
		$i++;
			
		}

		?>
	</table>
</center>
</div>

                        </div>
                        
                    </div>

                </div>
            </div>
        </div>



    <div class="clearfix"></div>
 	<?php include("include/footer.php");?>
	</div>
 	<?php include("include/allscr.php");?>

</form>
</body>
</html>