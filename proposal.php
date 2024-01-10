<?php 
session_start();
$eml = $_SESSION['email'];
require('config.php');
?>
<?php
$searchValue = isset($_GET['search']) ? $_GET['search'] : '';
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10; 
?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <?php include("include/head.php"); ?>
    <style type="text/css">
        table { margin: 20px; }
        td, th {
            padding: 3px;
        }
        .button th {
            padding: 10px;
        }
        .pagination {
            text-align: center;
            margin-top: 10px;
        }.search-container {
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
        }
         .records-select {
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
    <div id="right-panel" class="right-panel">
        <?php include("include/fixt.php"); ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Proposal List</strong>
                                <div class="search-container">
                                     <p style="float: left; margin-top: 7px;">Show Entries</p>
                          <select class="records-select" onchange="changeRecordsPerPage(this)">
            <option value="10" <?php if ($limit == 10) echo "selected"; ?>>10</option>
            <option value="25" <?php if ($limit == 25) echo "selected"; ?>>25</option>
            <option value="50" <?php if ($limit == 50) echo "selected"; ?>>50</option>
            <option value="100" <?php if ($limit == 100) echo "selected"; ?>>100</option> <option value="500" <?php if ($limit == 500) echo "selected"; ?>>500</option>
        </select>

                                    <form method="GET" style="display: inline-block;">
                                        <input type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($searchValue); ?>">
                                        <button type="submit"><b>Search</b></button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body card-block">
                      
    <script type="text/javascript">
        // JavaScript function to change the number of records displayed per page
        function changeRecordsPerPage(selectElement) {
            const selectedValue = selectElement.value;
            window.location.href = `?page=1&search=<?php echo htmlspecialchars($searchValue); ?>&limit=${selectedValue}`;
        }
    </script>          

                                <?php
                                 

                                // Query to count total records
                                $sql1 = "SELECT COUNT(*) AS total FROM (SELECT cp.Quot_No FROM crm_proposal AS cp
                                            INNER JOIN crm_contact AS cc ON cp.Cust_Id = cc.id
                                            WHERE cp.Cust_Id = cc.id AND cc.Emp_Email = '$eml' 
                                            AND (cp.Quot_No LIKE '%$searchValue%' OR cc.contact_first LIKE '%$searchValue%' OR cc.contact_last LIKE '%$searchValue%' OR cc.company LIKE '%$searchValue%' OR cc.city LIKE '%$searchValue%')
                                            GROUP BY cp.Quot_No) AS TotalCount";

                                $result1 = mysqli_query($conn, $sql1);
                                $row1 = $result1->fetch_assoc();
                                $total_rows = $row1['total'];
                                $totalRecords = $total_rows;
                                $totalPages = ceil($totalRecords / $limit);

                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $offset = ($page - 1) * $limit;

                                // SQL query using JOIN to retrieve data from both tables with search filter
                                $sql = "SELECT cp.id, cp.Quot_No, cp.Quot_Date, cp.Cust_Id, cp.Category, cp.Subcategory, cp.Work_Scope, cp.Quote_Amt,
                                        cc.id, cc.Emp_Email, cc.contact_first, cc.contact_last, cc.company, cc.industry, cc.budget, cc.email,
                                        cc.mobile, cc.LandLine, cc.website, cc.state, cc.district, cc.city, cc.address, cc.country, cc.status
                                        FROM crm_proposal AS cp
                                        INNER JOIN crm_contact AS cc ON cp.Cust_Id = cc.id
                                        WHERE cp.Cust_Id = cc.id AND cc.Emp_Email = '$eml' 
                                        AND (cp.Quot_No LIKE '%$searchValue%' OR cc.contact_first LIKE '%$searchValue%' OR cc.contact_last LIKE '%$searchValue%' OR cc.company LIKE '%$searchValue%' OR cc.city LIKE '%$searchValue%')
                                        GROUP BY cp.Quot_No ORDER BY cp.Quot_No LIMIT $offset, $limit";

                                $result = $conn->query($sql);

                                // Display the table with search results
                                echo '<center><table border="1" style="padding:3px;">
                                        <tr>
                                            <th>Sr. No</th>
                                            <th>Quot No</th>
                                            <th>Quot Date</th>
                                            <th>Customer Name</th>
                                            <th>Company</th>
                                            <th>City</th>
                                            <th>View</th>
                                        </tr>';
                                $i = 1;
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . $row['Quot_No'] . "</td>";
                                    echo "<td>" . date("d-m-Y", strtotime($row['Quot_Date'])) . "</td>";
                                    echo "<td>" . $row['contact_first'] . " " . $row['contact_last'] . "</td>";
                                    echo "<td>" . $row['company'] . "</td>";
                                    echo "<td>" . $row['city'] . "</td>";
                                    echo "<td><a href=\"infopropo.php?Quot_No={$row['Quot_No']}\">View</a></td>";
                                    echo "</tr>";
                                    $i++;
                                }
                                echo '</table></center> ';
?>
                          
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


                                <table class="button" border="1" align="right">
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
