
<?php 

session_start();

$eml=$_SESSION['email'];

?>
<?php
include_once("config.php");


$id = $_GET['id'];

$limit = 10;
$page = $_GET['page'] ?? 1;
$offset = ($page - 1) * $limit;

$totalRecords = mysqli_query($conn, "SELECT COUNT(*) as total FROM crm_tasks INNER JOIN crm_contact ON crm_tasks.contact = crm_contact.id WHERE crm_contact.id = '$id'");
$totalRows = mysqli_fetch_assoc($totalRecords)['total'];
$totalPages = ceil($totalRows / $limit);
$sql = "SELECT * FROM crm_tasks
        INNER JOIN crm_contact ON crm_tasks.contact = crm_contact.id
        WHERE crm_contact.id = '$id'
        LIMIT $limit OFFSET $offset";
        $result = mysqli_query($conn, $sql);

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

	.button th{padding: 10px;}



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

	$j=1;
	    $i = ($page - 1) * $limit + 1;

		while ($row = mysqli_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>".$j."</td>";
			echo "<td>".$row['task_type']."</td>";
			echo "<td>".$row['task_description']."</td>";
			echo "<td>".$row['task_due_date']."</td>";
			echo "<td>".$row['company']."</td>";
			//echo "<td>".$row['sales_rep']."</td>";
			echo "<td>".$row['task_status']."</td>";
			echo "<td>".$row['task_update']."</td>";
			echo "</tr>";
		$j++;
			
		}

		?>
	</table>
</center>

<?php 
$start=$offset+1;
//$to=$start+$i;
$to=$offset+$limit;
$end;
if($to>=$totalRows)
{
 $end=$totalRows; 
}else
{
    $end=$to;
}
?>
<p >Showing  <?php echo $start; ?>  to  <?php echo $end; ?>  of <?php echo $totalRows; ?></p>
<table class="button" border="1" align="right">
<div class='pagination'>

<?php
// Pagination links
echo "<tr>";

// Display the previous page link
if ($page > 1) {
  echo "<th><a href='?page=".($page-1)."'>Previous</a></th>";
}

// Display the page numbers
for ($i = 1; $i <= $totalPages; $i++) {
  echo "<th><a href='.php?page=$i'>$i</a></th>";
}

// Display the next page link
if ($page < $totalPages) {
  echo "<th><a href='.php?page=" .($page+1). "'>Next</a></th>";
}

echo "</tr>";
?>

</div>
</table>
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