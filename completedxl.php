<?php
session_start();
$eml=$_SESSION['email'];

include_once("config.php");
?>
<?php
$query = "select crm_tasks.*, crm_contact.company
        FROM crm_tasks
        INNER JOIN crm_contact ON crm_tasks.contact = crm_contact.id
         WHERE crm_tasks.sales_rep = '$eml' and crm_tasks.task_status='Completed'  ";
$result = mysqli_query($conn, $query);

    

header("content-Type: application/vnd.ms-excel");

header("content-Disposition: attachment; Filename=Task_Complete_List.xls");

 echo '<center><h1>Completed Task List</h1></center>';
 echo '<center>
    <table border="1" class="rpt">
        <tr> 
          <th>Sr.No</th>
            <th>Task Type</th>
            <th>Task Description</th>           
            <th>Due Date</th>
            <th>Company</th>            
            <th>Status</th>
                   </tr>';
     
      
        $i = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
           
           echo "<td>".$i."</td>";
            echo "<td>".$row['task_type']."</td>";
            echo "<td>".$row['task_description']."</td>";
            echo "<td>".$row['task_due_date']."</td>";
            echo "<td>".$row['company']."</td>";
            //echo "<td>".$row['sales_rep']."</td>";
            echo "<td>".$row['task_status']."</td>";
            echo "</tr>";
            $i++;
        }
        
    echo ' </table>
</center>';

