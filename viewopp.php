<?php 
session_start();
$eml=$_SESSION['email'];
$searchValue = isset($_GET['search']) ? $_GET['search'] : '';
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10; 
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("include/head.php");?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		
	table{margin: 20px;}
th{text-align: center;}
	td{padding: 5px;}

	.button th{padding: 10px;}
.search-container {
            text-align: right;
            margin-bottom: 20px;
        }

        .search-container input[type=text] {
            padding: 5px;
            margin-top: 5px;
            margin-right: 10px;
        }

        .search-container button {
            padding: 5px;
            margin-top: 5px;
        }
         .records-select {
            margin-top: 5px;
        }
          .records-select {
            margin-top: 5px;
            float: left; /* Align select box to the left */
            margin-right: 10px; /* Provide some spacing */
        }
	</style>
</head>
<body>

	
  
	<?php include("include/menu.php");?>
   
    <div id="right-panel" class="right-panel">
	<?php include("include/fixt.php");?>
    
        <div class="content">
            <div class="animated fadeIn">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong> View Opportunity</strong>
                                 <div class="search-container">
                          <p style="float: left; margin-top: 7px;">Show Entries</p>
                          <select class="records-select" onchange="changeRecordsPerPage(this)">
            <option value="10" <?php if ($limit == 10) echo "selected"; ?>>10</option>
            <option value="25" <?php if ($limit == 25) echo "selected"; ?>>25</option>
            <option value="50" <?php if ($limit == 50) echo "selected"; ?>>50</option>
            <option value="100" <?php if ($limit == 100) echo "selected"; ?>>100</option> <option value="500" <?php if ($limit == 500) echo "selected"; ?>>500</option>
        </select>
        <form method="GET" action="" style="display: inline-block;">
            <input type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($searchValue); ?>">
            <button type="submit"><b>Search</b></button>
        </form>
          
    </div>
                            </div>
                            <div class="card-body card-block">

  <script type="text/javascript">
        // JavaScript function to change the number of records displayed per page
        function changeRecordsPerPage(selectElement) {
            const selectedValue = selectElement.value;
            window.location.href = `?page=1&search=<?php echo htmlspecialchars($searchValue); ?>&limit=${selectedValue}`;
        }
    </script>


		<center><table  border="1" class="rpt" > 
		<tr>
			<th>ID</th>
			<th>Name</th>
			
			<th>Company</th>
			<th>Industry</th>
			<th>Mobile</th>
			<th>Email</th>			
			<th>City</th>
			<th>Action</th>
			
		</tr>
		
<?php


include_once("config.php");

 include_once("config.php");
$whereClause = ($searchValue != '') ? "AND (
    contact_first LIKE '%$searchValue%' OR 
    contact_last LIKE '%$searchValue%' OR 
    company LIKE '%$searchValue%' OR 
    industry LIKE '%$searchValue%' OR 
    website LIKE '%$searchValue%' OR 
    mobile LIKE '%$searchValue%' OR 
    city LIKE '%$searchValue%' )" : "";

 $result=mysqli_query($conn,"select COUNT(*) as total from crm_contact where Emp_Email='$eml' AND status='Opportunity' $whereClause");
$total_rows = $result->fetch_assoc()['total'];


$totalRecords = $total_rows;
$totalPages = ceil($totalRecords / $limit);

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($page - 1) * $limit;


$query = "SELECT * FROM crm_contact  where Emp_Email='$eml' AND status='Opportunity' $whereClause LIMIT $offset, $limit ";
$result = mysqli_query($conn, $query);

			$i=1;
		while($res=mysqli_fetch_array($result))
		{
			echo "<tr>";			
			echo "<td>".$i."</td>";
			echo "<td>".$res['contact_first']." ".$res['contact_last']."</td>";			
			//echo "<td>".$res['contact_last']."</td>";
			echo "<td>".$res['company']."</td>";
			echo "<td>".$res['industry']."</td>";
			//echo "<td>".$res['budget']."</td>";
			echo "<td>".$res['mobile']."</td>";			
			echo "<td>".$res['email']."</td>";
			
			echo "<td>".$res['city']."</td>";
			//echo "<td>".$res['status']."</td>";
			//echo "<td>".$res['address']."</td>";
			echo "<td><a href=\"emptask.php?id=$res[id]\">Task View</a> |<a href=\"editopp.php?id=$res[id]\">Edit</a> | <a href=\"oppdelete.php?id=$res[id]\" onClick=\" return confirm('Are you sure ,you want to delete?')\">Delete</a></td>";


   echo "</tr>";
			$i++;
		}

		?>
	</table>
</center>

<?php 
$start = $offset + 1;
if ($start == 0) {
    $start = 0;
}

$to = $offset + $limit;
$end;

if ($to >= $totalRecords) {
    $end = $totalRecords; 
} else {
    $end = $to;
}

$showingText = ($totalRecords > 0) ? "Showing $start to $end of $totalRecords records" : "No records found";
?>
<p><?php echo $showingText; ?></p>


 <table class="button" border="1" align="right">
    	<div class='pagination'>
        <tr>
             <?php
        if ($page > 1) {
            echo "<th><a href='?page=1&search=$searchValue&limit=$limit'>First</a></th>";
            echo "<th><a href='?page=" . ($page - 1) . "&search=$searchValue&limit=$limit'>Previous</a></th>";
        }
        if ($page < $totalPages) {
            echo "<th><a href='?page=" . ($page + 1) . "&search=$searchValue&limit=$limit'>Next</a></th>";
            echo "<th><a href='?page=$totalPages&search=$searchValue&limit=$limit'>Last</a></th>";
        }
        ?>
        </tr>
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



</body>
</html>