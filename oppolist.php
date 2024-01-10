


  
<?php 

session_start();

$eml=$_SESSION['email'];

?>


<?php 

include_once("config.php");


$result=mysqli_query($conn,"select * from crm_contact where Emp_Email='$eml' ");

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


	


	</style>
</head>
<body>

	
  <!--span>
	<1?php include("include/menu.php");?>
   
    <div id="right-panel" class="right-panel">
	<1?php include("include/fixt.php");?>
    
        <div class="content">
            <div class="animated fadeIn">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Lead View </strong>
                            </div>
                            <div class="card-body card-block">

 
</span-->

		<center><table  border="1" class="rpt" > 
		<tr>
			<th>ID</th>
			<th>firstname</th>
			<th>last name</th>
			<th>company</th>
			<th>industry</th>
			<th>budget</th>
			<th>email</th>
			<th>mobile</th>
			<th>website</th>
			<th>status</th>
			
		</tr>
		
<?php

			$i=1;
		while($res=mysqli_fetch_array($result))
		{
			echo "<tr>";			
			echo "<td>".$i."</td>";
			echo "<td>".$res['contact_first']."</td>";			
			echo "<td>".$res['contact_last']."</td>";
			echo "<td>".$res['company']."</td>";
			echo "<td>".$res['industry']."</td>";
			echo "<td>".$res['budget']."</td>";			
			echo "<td>".$res['email']."</td>";
			echo "<td>".$res['mobile']."</td>";
			echo "<td>".$res['website']."</td>";
			echo "<td>".$res['status']."</td>";
			//echo "<td>".$res['address']."</td>";
			//echo "<td><a href=\"emptask.php?id=$res[id]\">View</a> |<a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\" return confirm('Are you sure ,you want to delete?')\">Delete</a></td>";
			$i++;
			//echo "<td><a href=\"#.php?Emp_Email=$res['Emp_email']\">Edit</a></td>";*/
		

		
			
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



</body>
</html>