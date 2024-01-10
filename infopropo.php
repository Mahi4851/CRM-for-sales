<?php 

session_start();

$eml=$_SESSION['email'];
require('config.php');
?>
<?php

    $Quot_No = $_GET['Quot_No'];

    // Fetch the existing data based on the ID for editing
    $sql = "SELECT * FROM crm_proposal WHERE Quot_No = '$Quot_No'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $Company = $row['Cust_Id'];
        $QuotNo = $row['Quot_No'];
        $QuotDate = $row['Quot_Date'];
        $Category = $row['Category'];
        $Subcategory = $row['Subcategory'];
        $WorkScope = $row['Work_Scope'];
        $QuoteAmt = $row['Quote_Amt'];

     }
?>


                    
<?php

$query1 = "SELECT * FROM crm_contact WHERE id = $Company";

$result1 = $conn->query($query1);

if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
    $Comp = $row1['company'];
   $fname=$row1['contact_first'];
 $lname=$row1['contact_last'];
      $mobile=$row1['mobile'];
        $city=$row1['city'];
         $email=$row1['email'];
          $address=$row1['address'];
          $zip=$row1['zip'];
           $state=$row1['state'];
            $district=$row1['district'];

}?>
                                 
                                 <!DOCTYPE html>
                                 <html>
                                 <head>
                                 	<meta charset="utf-8">
                                 	<meta name="viewport" content="width=device-width, initial-scale=1">
                                 	<title></title>
                                 	    <style>
                                 	    	 @page {
                size: auto;   /* auto is used for compatibility with most browsers */
                margin: 0;    /* no margin on printing */
            }

            body {
                margin: 0; /* Reset default body margin */
            }
           
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
          
            border-collapse: collapse;
            margin-bottom: 20px;
        }

         

        th, td {
            padding: 2px;
            text-align: left;
         
        } .footer {
            display: none;
        }
        @media print {
            /* Hide the buttons when printing */
            button {
                display: none;
            }
        } @media print {
            .footer {
                display: block;
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
            
            }
        }

        button {
            padding: 10px;
            margin-right: 10px;
            font-size: 16px;
            cursor: pointer;
            border: 1px solid #000;
            background-color: #f0f0f0;
        } 
    </style>
                                 </head>
                                 <body>

                                 		
                                 		<p style="text-align: center;font-size: 35px;">TRIFRND PVT. LTD.</p>
		<center><span style="text-align: center; font-weight: bolder; font-size: 25px;">Quotation</span></center>
                                 		
<br><br>

									<table align="right" width="25%" >
                                 	<tr>
                                 			<th>Quotation Number:</th>
                                 			<td><?php echo  $QuotNo;?></td>
                                 		</tr>
                                 		<tr>
                                 			<th>Quotation Date:</th>
                                 			<td><?php echo date("d-m-Y", strtotime($QuotDate)); ?></td>
                                 		</tr></table>


								<table align="left" width="50%" >
                                 	<tr>
                                 			<th>Customer Name:</th>
                                 			<td><?php echo  $fname." ".$lname;?></td>
                                 		</tr>
                                 		<tr>
                                 			<th>Company Name:</th>
                                 			<td><?php echo  $Comp;?></td>
                                 		</tr>
                                 		<tr>
                                 			<th>Address:</th>
                                 			<td><?php echo $address." ".$city." <br>".$district." ".$state." ".$zip;?></td>
                                 		</tr>
                                 		<tr>
                                 			<th>Mobile:</th>
                                 			<td><?php echo $mobile;?></td>
                                 		</tr><tr>
                                 			<th>Company Email:</th>
                                 			<td><?php echo  $email;?></td>
                                 		</tr>
                                 	</table>



                                 <center>	<table width="60%" border="1" >
                                 	
                                 		<tr >
                                 			<th style="text-align:center;">Sr.No</th>
                                 			<th style="text-align:center;">Description</th>
                                 			<th style="text-align:center;">Quantity</th>
                                 			<th style="text-align:center;">Amount</th>        			
                                 			
                                 		</tr>
                                 		
  <?php
    $Quot_No1 = $_GET['Quot_No'];

    // Fetch the existing data based on the ID for editing
    $sql11 = "SELECT * FROM crm_proposal WHERE Quot_No = '$Quot_No1'";
    $result11 = $conn->query($sql11);
$i=1;
    
        while ($r = mysqli_fetch_assoc($result11)) {
        echo "<tr>";
         echo '<td style="text-align:center;">' . $i. '</td>';
         echo '<td>' . $r['Category'] . '<br>'. $r['Subcategory'] .'<br>'. $r['Work_Scope'] .'</td>';
         echo '<td style="text-align:center;">1</td>';
         echo '<td style="text-align:right;">' . number_format($r['Quote_Amt'], 2) . '</td>';

      $i++;

     }
?>
                                         
                                 		 </table></center>


                                 	
                                 			
                                 	
            
                                 	     <center>  
      <button onclick="window.history.back()"> Back</button>

    <!-- Button to download proposal details as PDF -->
   <button onclick="downloadPDF()">Download PDF</button>

    <!-- Button to print the displayed proposal details -->
    <button onclick="window.print()">Print</button></center>
                                 
    <script>
        function downloadPDF() {
            // Replace $Quot_No with the actual value
            var Quot_No = '<?php echo $QuotNo; ?>'; // Assuming $Quot_No is the PHP variable

            // Redirect to the PHP script for PDF generation with the Quot_No parameter
            window.location.href = 'empcustpropoPDF.php?Quot_No=' + Quot_No;
        }
    </script>                <div class="footer">
        <p>This is a computer-generated proposal</p>
    </div>        </body>
                                 </html>