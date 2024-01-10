<?php
session_start();

$eml = $_SESSION['email'];

// Check if a search query has been made
$searchValue = isset($_GET['search']) ? $_GET['search'] : '';
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10; 
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("include/head.php"); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lead Page</title>
    <style type="text/css">
        table { margin: 20px; }
        th { text-align: center; }
        td { padding: 5px; }
        .button th { padding: 10px; }
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
        }  .records-select {
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
    <?php include("include/menu.php"); ?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <?php include("include/fixt.php"); ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Lead View</strong>
                                <!-- Search Form -->
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
                                     <script type="text/javascript">
        // JavaScript function to change the number of records displayed per page
        function changeRecordsPerPage(selectElement) {
            const selectedValue = selectElement.value;
            window.location.href = `?page=1&search=<?php echo htmlspecialchars($searchValue); ?>&limit=${selectedValue}`;
        }
    </script>
                  
                            <div class="card-body card-block">
                                <table border="1" class="rpt">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Company Name</th>
                                        <th>Industry</th>
                                        <th>Website</th>
                                        <th>Mobile</th> <th>state</th>
                                        <th>district</th>
                                        <th>City</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    include_once("config.php");

                                    // Add search condition to the query
                                    $whereClause = ($searchValue != '') ? " AND (contact_first LIKE '%$searchValue%' OR contact_last LIKE '%$searchValue%' OR company LIKE '%$searchValue%' OR industry LIKE '%$searchValue%' OR website LIKE '%$searchValue%' OR mobile LIKE '%$searchValue%' OR city LIKE '%$searchValue%')" : "";

                                   
                                    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM crm_contact WHERE Emp_Email='$eml' AND status='Lead' $whereClause");
                                    $total_rows = $result->fetch_assoc()['total'];

                                    $totalRecords = $total_rows;
                                    $totalPages = ceil($totalRecords / $limit);

                                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $offset = ($page - 1) * $limit;

                                    $query = "SELECT * FROM crm_contact WHERE Emp_Email='$eml' AND status='Lead' $whereClause LIMIT $offset, $limit";
                                    $result = mysqli_query($conn, $query);
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        echo "<td>".$i."</td>";
                                        echo "<td>".$row['contact_first']." ".$row['contact_last']."</td>";
                                        echo "<td>".$row['company']."</td>";
                                        echo "<td>".$row['industry']."</td>";
                                        echo "<td>".$row['website']."</td>";
                                        echo "<td>".$row['mobile']."</td>";
                                         echo "<td>".$row['state']."</td>";
                                        echo "<td>".$row['district']."</td>";
                                        echo "<td>".$row['city']."</td>";
echo "<td><a href=\"emptask.php?id=$row[id]\">Task View</a> | <a href=\"leadedit.php?id=$row[id]\">Edit</a> | <a href=\"leaddelete.php?id=$row[id]\" onClick=\" return confirm('Are you sure ,you want to delete?')\">Delete</a></td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                    ?>
                                </table>

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
                                <!-- Pagination -->
                                <table class="button" border="1" align="right">
                                    <!-- Pagination -->
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
        <?php include("include/footer.php"); ?>
    </div>
    <?php include("include/allscr.php"); ?>
</body>
</html>
