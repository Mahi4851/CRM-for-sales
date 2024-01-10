
<?php
include_once("config.php");
$id = $_GET['id'];
// Retrieve the data from the database
$sql = "SELECT * FROM crm_contact WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);
   
$contact_first = $row['contact_first'];
    $contact_last=$row['contact_last'];  
      $company = $row['company'];    
 $industry=$row['industry'];
    $address=$row['address'];   
$mobile = $row['mobile'];
$landline = $row['LandLine'];
$city = $row['city'];
$state = $row['state'];
$district = $row['district'];
    $email=$row['email'];
  $status=$row['status'];
    $website=$row['website'];
}
?>
<?php 
// Update record
if(isset($_POST['update']))
 {
$id = $_POST['id'];
$contact_first = $_POST['contact_first'];
    $contact_last=$_POST['contact_last'];
   $company = $_POST['company'];
 $industry=$_POST['industry'];
    $address=$_POST['address'];
$mobile = $_POST['mobile'];
$landline = $_POST['landline'];
//$city = $_POST['city'];
    $email=$_POST['email'];
  $status=$_POST['status'];
    $website=$_POST['website'];
$state = $_POST['state'];$district = $_POST['district'];
    $city = $_POST['city'];
    if ($city === 'other') {
        $city = $_POST['city1'];        
    } 

// Perform update query
$result =mysqli_query($conn,"UPDATE crm_contact SET  contact_first='$contact_first',contact_last='$contact_last', company='$company',industry='$industry', mobile='$mobile',LandLine='$landline',email='$email',website='$website',status='$status',state='$state',district='$district',city='$city',address='$address' WHERE id=$id");

echo '<script>alert("Your Information Successfully Updated")</script>';
        echo "<script>window.location.href='viewopp.php';</script>";
        return false;
}
?>

<!DOCTYPE html>
<html>
<head>		<?php include("include/head.php");?>
<title>Update Form</title>
</head>
</script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                                <strong>Opportunity Update </strong>
                            </div>
                            <div class="card-body card-block">
 <?php
require('config.php');

$qry8=mysqli_query($conn,"SELECT DISTINCT Ind_Type  FROM  crm_industry WHERE Ind_Type <> '$industry'");

    ?>

<form action="editopp.php" method="post"  name="frm" id="frm" onSubmit="return checkemail()" enctype="multipart/form-data" class="form-horizontal">


<input type="hidden" name="id" value="<?php echo $id; ?>">



                        <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label"> First Name:</label></div>
                <div class="col-12 col-md-9"><input  type="text" name="contact_first"   size="25" id="t2" placeholder="Enter First Name" value="<?php echo $contact_first; ?>" required autofocus maxlength="25" class="form-control" ></div>
                </div>

              <div class="row form-group">
            <div class="col col-md-3"><label for="text-input" class=" form-control-label"> Last Name:</label></div>
            <div class="col-12 col-md-9"><input type="text" name="contact_last" id="t4" placeholder="Enter Last Name" size="25" required autofocus maxlength="25" value="<?php echo $contact_last; ?>" onblur="valid2()" onfocus="valid2()" onclick="valid2()"  class="form-control"><span id="nm3"></span></div>
                                    </div>

             <div class="row form-group">
                      <div class="col col-md-3"><label for="text-input" class=" form-control-label">Company Name:</label></div>
                  <div class="col-12 col-md-9"><input  type="text" name="company"  placeholder="Enter Company Name" value="<?php echo $company; ?>" onblur="valid1()" onfocus="valid1()" onclick="valid1()" maxlength="150" required autofocus class="form-control"></div>
            </div>

              <div class="row form-group">
                  <div class="col col-md-3"><label for="text-input" class=" form-control-label"> Industry Type:</label></div>
                <div class="col-12 col-md-9"><select name="industry" id="Ind_Type" required autofocus placeholder="Enter Company/Industry Type" class="form-control">
                <option ><?php echo $industry; ?></option>
                                <?php
                   while($row1=mysqli_fetch_array($qry8))
                 {
                   echo"<option>".$row1[0]."</option>";        }     ?>              </select>
                    </div>
                        </div>


  
                 <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Mobile No:</label></div>
            <div class="col-12 col-md-9"><input  type="tel" name="mobile" id="mobile" value="<?php echo $mobile; ?>" required autofocus placeholder="Enter Mobile No."  maxlength="10" pattern="^[6789]\d{9}$" title="Please enter a valid mobile number "  onkeyup="number1(this)" onfocusout="return validateMobileNumber()" class="form-control"></div>
                </div>

            <div class="row form-group">
            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Company Landline:</label></div>
        <div class="col-12 col-md-9"><input type="tel" name="landline" required placeholder="Enter Company Landline No." value="<?php echo $landline; ?>" autofocus maxlength="15" onkeyup="number1(this)" class="form-control"></div>
                </div>


         <div class="row form-group">
          <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email ID:</label></div>
          <div class="col-12 col-md-9"><input type="email" id="eml" name="email" required maxlength="50" placeholder="Enter Company Email" value="<?php echo $email; ?>" onfocusout="return checkbae()" autofocus class="form-control"></div>
            </div>


             <div class="row form-group">
            <div class="col col-md-3"><label for="text-input" class=" form-control-label"> Company Website:</label></div>
        <div class="col-12 col-md-9"><input  type="text" id="websiteInput" name="website"  required autofocus placeholder="Enter Company Website" value="<?php echo $website; ?>" maxlength="50"  class="form-control"></div>
        </div>


<div class="row form-group">
<div class="col col-md-3"><label for="state" class=" form-control-label"> State:</label></div>
       <div class="col-12 col-md-9"> <select id="state" name="state" class="form-control" required>
           <?php
                // Assuming you have a database connection established
                $query = "SELECT DISTINCT State FROM cities order by State";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_array($result)) {
        $selected = ($row['State'] == $state) ? "selected" : "";
        echo "<option value='" . $row['State'] . "' $selected>" . $row['State'] . "</option>";
    }
            ?>
        </select></div></div>




        <div class="row form-group">
<div class="col col-md-3"><label for="district" class=" form-control-label"> District:</label></div>
         <div class="col-12 col-md-9"> <select id="district" name="district" class="form-control" required>
             <?php
            // Retrieve districts for the selected state
            $districtQuery = "SELECT DISTINCT District FROM cities WHERE State = '$state' ORDER BY District";
            $districtResult = mysqli_query($conn, $districtQuery);

            while ($districtRow = mysqli_fetch_array($districtResult)) {
                $selectedDistrict = ($districtRow['District'] == $district) ? "selected" : "";
                echo "<option value='" . $districtRow['District'] . "' $selectedDistrict>" . $districtRow['District'] . "</option>";
            }
            ?>
        </select></div></div>


                                             <div class="row form-group">
        <div class="col col-md-3"><label for="city" class="form-control-label">City:</label></div>
        <div class="col-12 col-md-9">
            <select id="city" name="city" class="form-control" required>
                  <?php
            $cityQuery = "SELECT City FROM cities WHERE District = '$district' ORDER BY City";
            $cityResult = mysqli_query($conn, $cityQuery);

            $cityExists = false; // Flag to check if the retrieved city exists in the options

            while ($cityRow = mysqli_fetch_array($cityResult)) {
                $selectedCity = ($cityRow['City'] == $city) ? "selected" : "";
                echo "<option value='" . $cityRow['City'] . "' $selectedCity>" . $cityRow['City'] . "</option>";

                if ($cityRow['City'] == $city) {
                    $cityExists = true; // Set flag to true if the retrieved city exists in the options
                }
            }

            // If the retrieved city doesn't exist in the options, select the "Other" option
            if (!$cityExists && !empty($city)) {
                echo "<option value='$city' selected>$city </option>";
            }
            ?>
            <option value="other">Other</option>
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
                                        <div class="col-12 col-md-9"><textarea name="address" id="address" rows="5" cols="30" required autofocus placeholder="Enter Company Address"  class="form-control"><?php echo $address ?></textarea></div>
                                    </div>





          <div class="row form-group">
             <div class="col col-md-3"><label for="selectSm" class=" form-control-label">Status:</label></div>
          <div class="col-12 col-md-9">
           <select Name="status" autofocus required  id="selectSm" class="form-control-sm form-control">
               <option ><?php echo $status; ?></option>
                <option> Lead </option>    
               <option> Customer</option> 
        </select>
        </div>
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
<script>
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
<!--p></p-->
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
    <script type="text/javascript">
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
</body>
</html>


