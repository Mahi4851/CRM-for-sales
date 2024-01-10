<?php
include_once("config.php");
$id = $_GET['id'];
// Retrieve the data from the database
$sql = "SELECT * FROM crm_tasks WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);

     $task_type = $row['task_type'];
    $task_description=$row['task_description'];
$task_due_date = $row['task_due_date'];
    $contact=$row['contact'];
    $sales_rep=$row['sales_rep'];
    $task_status=$row['task_status'];
 $task_update=$row['task_update'];    

}

?>
<?php
$varcharValue = $contact; // Example varchar value

// Using intval() function
$intValue = intval($varcharValue); // Converts '42' into 42

// Using casting
$intValue = (int)$varcharValue; // Converts '42' into 42

 $intValue; // Output: 42



$sql = "SELECT company FROM crm_contact WHERE id = '$intValue'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through each row of the result
    while ($row = $result->fetch_assoc()) {
        $companyName = $row["company"];
    }
}
?>
<?php 
// Update record
if(isset($_POST['update']))
 {
$id = $_POST['id'];
$task_type=$_POST['task_type'];
$description = $_POST['description']; 
    $date=$_POST['date'];
    $contact=$_POST['contact'];

$sales_rep=$_POST['sales'];
  $status=$_POST['status'];
 $task_update=$_POST['task_update'];

// Perform update query
$result =mysqli_query($conn,"UPDATE crm_tasks SET task_type='$task_type', task_description='$description',contact='$contact',task_status='$status',task_update='$task_update',sales_rep='$sales_rep' WHERE id=$id");


echo '<script>alert("Your Information Successfully Updated")</script>';
        echo "<script>window.location.href='viewtask.php';</script>";
        return false;


}

?>

<!DOCTYPE html>
<html>
<head>
		<?php include("include/head.php");?>

<title>Update Form</title>
</head>
<body>


 <script type="text/javascript">
    function number1(input){
        var num1=/[^0-9]/gi;
        input.value=input.value.replace(num1,"");
        }
    </script>

<script type="text/javascript">
    
var testresults


function checkemail() {
  var str = document.frm.email.value
  var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
  if (filter.test(str))
    testresults = true
  else {
    alert("Please input a valid email address!")
    testresults = false
  }
  return (testresults)
}

function checkbae() {
  if (document.layers || document.getElementById || document.all)
    return checkemail()
  else
    return true
}
</script>


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
                                <strong>Task Update </strong>
                            </div>
                            <div class="card-body card-block">


 <?php
require('config.php');
$qry2=mysqli_query($conn,"SELECT DISTINCT Emp_Email  FROM  crm_contact");
$qry6=mysqli_query($conn,"SELECT DISTINCT tasktype from crm_tasktype WHERE tasktype <> '$task_type'");

    ?>
<form action="taskedit.php" method="post"  name="frm" id="frm" enctype="multipart/form-data" class="form-horizontal">


<input type="hidden" name="id" value="<?php echo $id; ?>">

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Task Type:</label></div>
                                        <div class="col-12 col-md-9"><select name="task_type" placeholder="Enter Task Type"  id="tasktype" required autofocus  class="form-control">
                                            <option><?php echo $task_type ?></option>
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
                                        <div class="col-12 col-md-9"><input  type="text" name="description" placeholder="Enter Description" value="<?php echo $task_description; ?>" id="t2" required autofocus  class="form-control"></div>
                                    </div>

                                     <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Due Date:</label></div>
                                        <div class="col-12 col-md-9"><input  type="text" name="date"  readonly value="<?php echo $task_due_date; ?>"  class="form-control"></div>
                                    </div>

                                     <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label"> Company:</label></div>
                                        <div class="col-12 col-md-9"><select  id="contact_first" id="selectBox" onchange="updateInputBox(this)" required autofocus placeholder="Enter Name"    class="form-control">
                                           
                                              <?php
            $sql1 = "SELECT id, company FROM crm_contact";
            $result1 = $conn->query($sql1);
            while ($row = $result1->fetch_assoc()) {
                $selected = ($row['company'] == $companyName) ? 'selected' : '';
                echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['company'] . '</option>';
            }
            ?>
                                        </select> </div>
                                    </div>

<input type="hidden" id="selectedIdInputBox" name="contact" value="<?php echo $contact ?>">


 <?php $qry11 = mysqli_query($conn, "SELECT  name FROM crm_users WHERE email='$sales_rep'"); 
  while ($row11 = mysqli_fetch_array($qry11)) {
                   $nm = $row11['name'] ;
                }?>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">Sales Rep:</label></div>
                                        <div class="col-12 col-md-9"><select id="Emp_Email" name="sales" required   autofocus class="form-control">
                                          
                                             <?php
            $qry2 = mysqli_query($conn, "SELECT email, name FROM crm_users");
            while ($row2 = mysqli_fetch_array($qry2)) {
                $selected = ($row2['email'] == $sales_rep) ? 'selected' : '';
                echo "<option value='" . $row2['email'] . "' " . $selected . ">" . $row2['name'] . "</option>";
            }
            ?>
                                        </select> </div>
                                    </div>


                                        <div class="row form-group">
                                        <div class="col col-md-3"><label for="selectSm" class=" form-control-label">Status:</label></div>
                                        <div class="col-12 col-md-9">
                                            <select Name="status" autofocus required  id="selectSm" class="form-control-sm form-control">
                                            <option class="form-control"><?php echo $task_status; ?></option>
                                                <option>Pending</option>  
                                                <option>Completed</option> 

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Remark:</label></div>
                                        <div class="col-12 col-md-9"><input  type="text" name="task_update" placeholder="Enter Task-Update" value="<?php echo $task_update; ?>" id="t2" required autofocus  class="form-control"></div>
                                    </div>

<input type="submit" name="update" value="Update">
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
  $(document).ready(function (e){
    $('#company').change(function(){
      $.post("f1.php",{
        parent_id5: $('#company').val(),
      }, function(response){
        $('#company').val(response);
      
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


