 <?php
session_start();
$eml=$_SESSION['email'];
?>
<!doctype html>
<html class="no-js" lang=""> 
<head>

		<?php include("include/head.php");?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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


function validateMobileNumber(mobile) {
  // Remove any non-digit characters from the number
  const cleanedNumber = mobile.replace(/\D/g, '');

  // Check if the number is 10 digits long
  if (cleanedNumber.length !== 10) {
    alert("Enter only numbers");
    return false;
  }

  // Check if the number starts with a valid prefix (e.g. 7, 8, or 9)
  const validPrefixes = ['6','7', '8', '9'];
  if (!validPrefixes.includes(cleanedNumber.charAt(0))) {
        alert("Enter valid numbers");
    return false;
  }

  return true;
}


</script>

</head>
<body>
          <?php
require('config.php');
$qry=mysqli_query($conn,"SELECT DISTINCT Country  FROM  cities");
$qry3=mysqli_query($conn,"SELECT DISTINCT district  FROM  cities order by district");
$qry1=mysqli_query($conn,"SELECT DISTINCT State  FROM  cities");
$qry2=mysqli_query($conn,"SELECT City  FROM  cities order by city");
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
                                <strong>Lead Entry Form</strong>
                            </div>
                            <div class="card-body card-block">


                                <form action="Addlead.php" method="post"  name="frm" id="frm" onSubmit="return checkemail()" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                      
                                        <div class="col-12 col-md-9">
                                            <input type="hidden" name="user" id="user"readonly  value="<?php echo $eml ?>" class="form-control-static">
                                        </div>
                                    </div>

                                         <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label"> First Name:</label></div>
                                        <div class="col-12 col-md-9"><input type="text" name="contact_first" autofocus placeholder="Enter First Name"  required autofocus class="form-control"></div>
                                    </div>

                                      <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label"> Last Name:</label></div>
                                        <div class="col-12 col-md-9"><input type="text" name="contact_last" autofocus placeholder="Enter Last Name"  required autofocus class="form-control"></div>
                                    </div>

                                     <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Company Name:</label></div>
                                        <div class="col-12 col-md-9"><input  type="text" name="company"  placeholder="Enter Company Name"   required autofocus class="form-control"></div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email ID:</label></div>
                                        <div class="col-12 col-md-9"><input type="email" id="eml" name="email" required  placeholder="Enter Company Email" onfocusout="return checkbae()" autofocus class="form-control"></div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Mobile No:</label></div>
                                        <div class="col-12 col-md-9"><input  type="tel" name="mobile" id="mobile"  required autofocus placeholder="Enter Mobile No."  maxlength="10" pattern="^[6789]\d{9}$" title="Please enter a valid mobile number " onkeyup="number1(this)" onfocusout="return validateMobileNumber()" class="form-control"></div>
                                    </div>

                                     <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Company Landline:</label></div>
                                        <div class="col-12 col-md-9"><input type="tel" name="landline" required placeholder="Enter Company Landline No." onkeyup="number1(this)" autofocus maxlength="15"  title="Please enter a valid Landline number "  class="form-control"></div>
                                    </div>



                                    
                                     <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">District:</label></div>
                                        <div class="col-12 col-md-9"><select name="dist" id="dist" required autofocus class="form-control">

                                                
                                                <?php
                                            while($row2=mysqli_fetch_array($qry3))
                                                 {
                                                   echo"<option>".$row2[0]."</option>";
                                                 }
                                                ?>
                                                 
                                                
                                            </select>
                                        </div>
                                    </div>



                                     <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">City:</label></div>
                                        <div class="col-12 col-md-9"><select  name="city" id="City"  autofocus  class="form-control">
                                            
                                            <option>Select City</option>
                                            <?php
                                                while($row3=mysqli_fetch_array($qry2))
                                            {
                                                    echo"<option value='$row3[0]'>".$row3[0]."</option>";
                                            }
                                                ?>            <option value="other">Other</option>

                                        </select> </div>
                                    </div>
                                    <div id="otherInput" style="display: none;"> <div class="row form-group">
             <div class="col-12 col-md-9"> 

            <input type="text" name="city1" placeholder="Enter your City" class="form-control" style="margin-left:250px;">
        </div>
    </div>
</div>


                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Address:</label></div>
                                        <div class="col-12 col-md-9"><textarea name="address" rows="5" cols="30"required autofocus placeholder="Enter Company Address" class="form-control"></textarea></div>
                                    </div>

<table >
                               <tr>     <th></th>   
<th><input type="reset" name="cancel" value="Reset" style="margin-left:300px ;"></th>




<th><input type="submit" autofocus name="submit" value="Submit" onclick="chackbae()" style="margin-left:70px ;"></th>
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
    $('#City').change(function(){
      $.post("f1.php",{
        parent_id2: $('#City').val(),
      }, function(response){
        $('#City').val(response);
      
      });
      return false;
    });
</script>
<script type="text/javascript">
  $(document).ready(function (e){
    $('#dist').change(function(){
      $.post("f1.php",{
        parent_id9: $('#dist').val(),
      }, function(response){
        $('#dist').val(response);
      
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
        $(document).ready(function() {
            $('#City').on('change', function() {
                if ($(this).val() === 'other') {
                    $('#otherInput').show();
                } else {
                    $('#otherInput').hide();
                }
            });
        });
    </script>
</body>
</html>

<?php

include_once("config.php");
if (isset($_POST['submit']))
{
    $user=$_POST['user'];
  
    $contact_first=$_POST['contact_first'];
   $contact_last=$_POST['contact_last'];
   
    $company=$_POST['company'];
  
    $address=$_POST['address'];
    //$country=$_POST['country'];
   $dist=$_POST['dist'];
    
    $mobile=$_POST['mobile'];
    $landline=$_POST['landline'];
    $email=$_POST['email'];
    //nfhgfh
$city = $_POST['city'];
   
    if ($city === 'other') {
        $city = $_POST['city1'];
        
    } 
  
   // $website=$_POST['website'];

    if(is_numeric($contact_first))
    {
        echo '<script>alert("Contact first is not a number")</script>';
        echo "<script>window.location.href='Addlead.php';</script>";
        return false;
    } 
    if(is_numeric($city))
    {
        echo '<script>alert("city name not a number")</script>';
        //echo "<script>window.location.href='Addlead.php';</script>";
        return false;
    }

    else
    {


        $result=mysqli_query($conn,"insert into crm_contact ( Emp_Email,contact_first,district,contact_last,initial_contact_date,company,address,city,state,country,mobile,LandLine,email,status) values('$user','$contact_first','$dist','$contact_last',now(),'$company','$address','$city','Maharashtra','India','$mobile','$landline','$email','Lead')");

        

        echo '<script>alert("Your Information Successfully Submited")</script>';
        echo "<script>window.location.href='Addlead.php';</script>";
        return false;
    }  
}

?>
