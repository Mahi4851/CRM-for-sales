 
<?php 

session_start();

$eml=$_SESSION['email'];

?>

<?php

include_once("config.php"); 
$sql = "SELECT id, company FROM crm_contact";
$result = $conn->query($sql);
?>

<!doctype html>
<html class="no-js" lang=""> 
<head>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    
		<?php include("include/head.php");?>  
</head>
<body>
          <?php
require('config.php');
$qry5=mysqli_query($conn,"SELECT  company, id FROM  crm_contact");
$qry7=mysqli_query($conn,"SELECT  id  FROM  crm_contact");
$qry2=mysqli_query($conn,"SELECT DISTINCT Emp_Email  FROM  crm_contact");

$qry6=mysqli_query($conn,"SELECT DISTINCT tasktype from crm_tasktype");

    ?>

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
                                <strong>Task Entry Form</strong>
                            </div>
                            <div class="card-body card-block">

                                <form action="newtask.php" method="post"  name="frm" id="frm" onSubmit="return checkemail()" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                        <!--div class="col col-md-3"><label class=" form-control-label">  </label></div-->
                                        <div class="col-12 col-md-9">
                                            <input type="hidden" name="user" id="user"readonly  value="<?php echo $eml ?>" class="form-control-static">
                                        </div>
                                    </div>


                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Task Type:</label></div>
                                        <div class="col-12 col-md-9"><select name="task_type" placeholder="Enter Task Type"  id="tasktype" required autofocus  class="form-control">
                                             <?php
                                                     while($row2=mysqli_fetch_array($qry6))
                                                {
                                                         echo"<option>".$row2[0]."</option>";
                                                 }
                                                    ?>
                                                </select>
                                                </div>
                                    </div>



                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Description:</label></div>
                                        <div class="col-12 col-md-9"><input  type="text" name="description" placeholder="Enter Description"  id="t2" required autofocus  class="form-control"></div>
                                    </div>

                                     <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Due Date:</label></div>
                                        <div class="col-12 col-md-9"><input  type="date" name="date"    required autofocus class="form-control"></div>
                                    </div>


 <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label"> Company:</label></div>
                                        <div class="col-12 col-md-9"><select name="company" id="selectBox" onchange="updateInputBox(this)"  required autofocus placeholder="Enter Name"    class="form-control">
                                            

                                            <?php

    echo '<option value="">Select an option</option>';
while ($row = $result->fetch_assoc()) {
    echo '<option value="' . $row['id'] . '">' . $row['company'] . '</option>';
}
                                            ?>


                                        </select> 


                                    </div>
                                    </div>



<input type="hidden" id="selectedIdInputBox" name="company_id">

                                  <div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label"> Sales Rep:</label>
    </div>
    <div class="col-12 col-md-9">
        <select name="sales" required autofocus class="form-control">
            <?php
                $qry2 = mysqli_query($conn, "SELECT email, name FROM crm_users");
                while ($row2 = mysqli_fetch_array($qry2)) {
                    echo "<option value='" . $row2['email'] . "'>" . $row2['name'] . "</option>";
                }
            ?>
        </select>
    </div>
</div>

                                        <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Status:</label></div>
                                        <div class="col-12 col-md-9">
                                            <select Name="status" autofocus required class="form-control-sm form-control">
                                            
                                                <option>Pending</option>  
                                                <option>Completed</option> 

                                            </select>
                                        </div>
                                    </div>


                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Remark:</label></div>
                                        <div class="col-12 col-md-9"><input  type="text" name="task_update" placeholder="Enter Task-Update"  id="t2" required autofocus  class="form-control"><span id="nm1"></span></div>
                                    </div>


<table >
                               <tr>     <th></th>   
<th><input type="reset" name="cancel" value="Reset" style="margin-left:300px ;"></th>

<th><input type="submit" autofocus name="submit" value="Submit" style="margin-left:70px ;"></th>
<th></th></tr>
</table>
                                </form>
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





<script type="text/javascript">
    function number1(input){
        var num1=/[^0-9]/gi;
        input.value=input.value.replace(num1,"");
        }
    </script>




<script type="text/javascript">
  $(document).ready(function (e){
    $('#company').change(function(){
      $.post("f1.php",{
        parent_id5: $('#company').val(),
      }, function(response){
        $('#Id').val(response);
      
      });
      return false;
    });
</script>


<script type="text/javascript">
  $(document).ready(function (e){
    $('#Emp_Email').change(function(){
      $.post("f1.php",{
        parent_id3: $('#Emp_Email').val(),
      }, function(response){
        $('#Emp_Email').val(response);
      
      });
      return false;
    });


</script>
<script type="text/javascript">
  $(document).ready(function (e){
    $('#tasktype').change(function(){
      $.post("f1.php",{
        parent_id6: $('#tasktype').val(),
      }, function(response){
        $('#tasktype').val(response);
      
      });
      return false;
    });


</script>
<!--p></p-->
<script type="text/javascript">
  $(document).ready(function (e){
    $('#user').change(function(){
      $.post("f1.php",{
        parent_id3: $('#user').val(),
      }, function(response){
        $('#user').val(response);
      
      });
      return false;
    });


</script>

<script>
// Function to update the input box with the selected value's id
function updateInputBox(selectElement) {
    var selectedValue = selectElement.options[selectElement.selectedIndex].value;
    document.getElementById('selectedIdInputBox').value = selectedValue;
}
</script>
<!--p></p-->
</body>
</html>


<?php

include_once("config.php");

if (isset($_POST['submit']))
{
  
    $task_type=$_POST['task_type'];   
    $description=$_POST['description'];  
    $date=$_POST['date'];
    $contact=$_POST['company_id'];
    $sales=$_POST['sales'];
    $status=$_POST['status'];
    $task_update=$_POST['task_update'];
  

   
    



        $result=mysqli_query($conn,"insert into crm_tasks (task_type,task_description,task_due_date,task_status,task_update,contact,sales_rep) values('$task_type','$description','$date','$status','$task_update','$contact','$sales')");

        

        echo '<script>alert("Your Information Successfully Submited")</script>';
        echo "<script>window.location.href='newtask.php';</script>";
        return false;
    
    


        
}



?>


