<?php

include_once("config.php");

$limit = 5;
 $result=mysqli_query($conn,"select COUNT(*) as total from crm_contact");
$total_rows = $result->fetch_assoc()['total'];



$totalRecords = $total_rows;
$totalPages = ceil($totalRecords / $limit);

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($page - 1) * $limit;

$query = "SELECT * FROM crm_contact LIMIT $offset, $limit";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>


<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Company</th>
    <th>Industry</th>
    <th>Website</th>
    <th>Mobile</th>
    <th>Landline</th>
    <th>City</th>


</tr>
<?php
while ($row = mysqli_fetch_array($result)) {//echo "<td>".$i."</td>";
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
   echo "<td>".$row['contact_first']." ".$row['contact_last']."</td>";
     echo "<td>".$row['company']."</td>";
      echo "<td>".$row['industry']."</td>";
       echo "<td>".$row['website']."</td>";
        echo "<td>".$row['mobile']."</td>";
        echo "<td>".$row['LandLine']."</td>";
          echo "<td>".$row['city']."</td>";
    echo "</tr>";
}
?>
<?php

//$start=$offset+1;
//$end=$start+($limit-1);

?>

</table>



<div class='pagination'>

    <table>
        <tr>
    <?php
if ($page > 1) {
    echo "<th><a href='?page=" . ($page - 1) . "'>Previous</a></th>";
}
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<th><a href='?page=$i'>$i</a></th>";
}
if ($page < $totalPages) {
    echo "<th><a href='?page=" . ($page + 1) . "'>Next</a></th>";
}

$start=$offset+1;
//$to=$start+$i;
$to=$offset+$limit;
$end;
if($to>=$totalRecords)
{
 $end=$totalRecords; 
}else
{
    $end=$to;
}

?>
    </tr>
</table>

<p>Showing  <?php echo $start; ?>  to  <?php echo $end; ?>  of <?php echo $totalRecords; ?></p>
</div>
<br><br><br>


</body>
</html>
