 <?php

include_once("config.php");

if (isset($_POST['state'])) {
    $state = $_POST['state'];
    // Assuming you have a database connection established
    $query = "SELECT DISTINCT District FROM cities WHERE State = '$state' order by District";
    $result = mysqli_query($conn, $query);

    $output = '<option value="">Select District</option>';
    while ($row = mysqli_fetch_array($result)) {
        $output .= "<option value='" . $row['District'] . "'>" . $row['District'] . "</option>";
    }
    echo $output;
}
?>
