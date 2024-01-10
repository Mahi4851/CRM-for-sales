 <?php 

session_start();

$eml=$_SESSION['email'];

?>
<!doctype html>
<html class="no-js" lang=""> <!--<![endif]-->
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

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <?php
require('config.php');
$qry=mysqli_query($conn,"SELECT DISTINCT Country  FROM  cities");
$qry1=mysqli_query($conn,"SELECT DISTINCT State  FROM  cities");
$qry2=mysqli_query($conn,"SELECT City  FROM  cities order by city");
$qry8=mysqli_query($conn,"SELECT DISTINCT Ind_Type  FROM  crm_industry");

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
                                <strong>Opportunity Entry Form</strong>
                            </div>
                            <div class="card-body card-block">


                                <form action="Addopp.php" method="post"  name="frm" id="frm" onSubmit="return checkemail()" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                       
                                        <div class="col-12 col-md-9">
                                            <input type="hidden" name="user" id="user"readonly  value="<?php echo $eml ?>" class="form-control-static">
                                        </div>
                                    </div>


                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label"> First Name:</label></div>
                                        <div class="col-12 col-md-9"><input  type="text" name="first"   size="25" id="t2" placeholder="Enter First Name"  required autofocus maxlength="25" class="form-control" ></div>
                                    </div>


                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label"> Last Name:</label></div>
                                        <div class="col-12 col-md-9"><input type="text" name="last" id="t4" placeholder="Enter Last Name" size="25" required autofocus maxlength="25"    class="form-control"></div>
                                    </div>


                                     <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Company Name:</label></div>
                                        <div class="col-12 col-md-9"><input  type="text" name="company"  placeholder="Enter Company Name" maxlength="150" required autofocus class="form-control"></div>
                                    </div>



                                     <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label"> Industry Type:</label></div>
                                        <div class="col-12 col-md-9"><select required       name="industry"  autofocus placeholder="Enter Company/Industry Type" class="form-control"> 
                                                   <option> Select Industry</option> 
                                                    <?php
                                            while($row1=mysqli_fetch_array($qry8))
                                                 {
                                                   echo"<option>".$row1[0]."</option>";
                                                 }
                                                ?>
                                                
                                            </select>
                                        </div>
                                    </div>

                                        <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Budget:</label></div>
                                        <div class="col-12 col-md-9"><input  type="tel" name="budget" id="budget"  required autofocus placeholder="Enter Budget "  maxlength="10"   onkeyup="number1(this)"  class="form-control"></div>
                                    </div>


            <div class="row form-group">
            <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email ID:</label></div>
            <div class="col-12 col-md-9"><input type="email" id="eml" name="email" required maxlength="50" placeholder="Enter Company Email" onfocusout="return checkbae()" autofocus class="form-control"></div>
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
    <div class="col col-md-3"><label for="text-input" class=" form-control-label"> Company Website:</label></div>
    <div class="col-12 col-md-9"><input  type="text" name="website" maxlength="50" required autofocus placeholder="Enter Company Website" id="websiteInput"   class="form-control"></div>
    </div>



<div class="row form-group">
<div class="col col-md-3"><label for="state" class=" form-control-label"> State:</label></div>
       <div class="col-12 col-md-9"> <select id="state" name="state" class="form-control" required>
            <option value="">Select State</option>
            <?php

                // Assuming you have a database connection established
                $query = "SELECT DISTINCT State FROM cities order by State";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['State'] . "'>" . $row['State'] . "</option>";
                }
            ?>
        </select></div></div>




        <div class="row form-group">
<div class="col col-md-3"><label for="district" class=" form-control-label" > District:</label></div>
         <div class="col-12 col-md-9"> <select id="district" name="district" class="form-control" required>
            <option value="">Select District</option>
        </select></div></div>










    <div class="row form-group">
        <div class="col col-md-3"><label for="city" class="form-control-label">City:</label></div>
        <div class="col-12 col-md-9">
            <select id="city" name="city" class="form-control" required>
                <option value="">Select City</option>
                
            </select>
        </div>
    </div>

    <div id="otherInput" style="display: none;">
        <div class="row form-group"><div class="col col-md-3"><label for="city" class="form-control-label"></label></div>
            <div class="col-12 col-md-9">
                <input type="text" name="city1" placeholder="Enter your City" class="form-control" maxlength="25">
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
    $('#Ind_Type').change(function(){
      $.post("f1.php",{
        parent_id8: $('#Ind_Type').val(),
      }, function(response){
        $('#Ind_Type').val(response);
      
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
<!--p></p--><script>
        $(document).ready(function() {
            $('#state').change(function() {
                var state = $(this).val();
                if (state !== '') {
                    $.ajax({
                        url: 'get_data.php', // Create a PHP file to fetch districts for the selected state
                        type: 'POST',
                        data: {state: state},
                        success: function(response) {
                            $('#district').html(response);
                        }
                    });
                }
            });

            $('#district').change(function() {
                var district = $(this).val();
                if (district !== '') {
                    $.ajax({
                        url: 'getCities.php', // Create a PHP file to fetch cities for the selected district
                        type: 'POST',
                        data: {district: district},
                        success: function(response) {
                            $('#city').html(response);
                        }
                    });
                }
            });
        });



        document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('frm');
    const websiteInput = document.getElementById('websiteInput');

    form.addEventListener('submit', function(event) {
        if (!isValidDomain(websiteInput.value)) {
            event.preventDefault();
            alert('Please enter a valid website.');
        }
    });

    function isValidDomain(domain) {
        // Regular expression to check for specific domain extensions
        const domainRegex = /\.(com|in|org|net|edu|gov|mil)$/i;
        return domainRegex.test(domain);
    }
});

    </script>


 <script>
        $(document).ready(function() {
            $('#city').on('change', function() {
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
  
    $first=$_POST['first'];
  $last=$_POST['last'];
   
    $company=$_POST['company'];
  
    $industry=$_POST['industry'];
   
    $budget=$_POST['budget'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
     $landline=$_POST['landline'];
     $website=$_POST['website'];
    $status=$_POST['status'];
$address=$_POST['address'];
 $state=$_POST['state'];
        $district=$_POST['district'];
     $city = $_POST['city'];
    if ($city === 'other') {
        $city = $_POST['city1'];        
    }  

   


        $result=mysqli_query($conn,"insert into crm_contact (Emp_Email,contact_first,contact_last,company,industry,budget,email,mobile,LandLine,website,status,district,city,address,state,country) values ('$user','$first','$last','$company','$industry','$budget','$email','$mobile','$landline','$website','Opportunity','$district','$city','$address','$state','INDIA')");
        echo '<script>alert("Your Information Successfully Submited")</script>';
        echo "<script>window.location.href='Addopp.php';</script>";
        return false;
   
}
?>
