<?php
include_once("config.php");

if (isset($_POST['district'])) {
    $district = $_POST['district'];
 
    $query = "SELECT City FROM cities WHERE District = '$district' order by City";
    $result = mysqli_query($conn, $query);

    $output = '<option value="">Select City</option>';
    while ($row = mysqli_fetch_array($result)) {
        $output .= "<option value='" . $row['City'] . "'>" . $row['City'] . "</option>";
    }

    // Add the "Other" option
    $output .= "<option value='other'>Other</option>";

    echo $output;
}
?>
