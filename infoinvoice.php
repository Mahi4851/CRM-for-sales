<?php
session_start();
require('config.php');

 $Bill_No = $_GET['Bill_No'];

$sql = "SELECT * FROM crm_invoice WHERE Bill_No = $Bill_No";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $company = $row['Cust_Id'];
    $billno = $row['Bill_No'];
    $billdate = $row['Bill_Date'];
    $categories = $row['Category'];
    $subcategories = $row['Subcategory'];
    $works = $row['Work_Scope'];

    $totalAmount = $row['Bill_Subtot'];
    $gst = $row['Bill_GST'];
    $sgst = $row['Bill_SGST'];
    $cgst = $row['Bill_CGST'];
    $grossTotal = $row['Bill_Amt'];

}
   
?>


<?php
require('config.php');
$query1 = "SELECT * FROM crm_contact WHERE id = $company";

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
        body {
            font-family: Arial, sans-serif;
            margin: 20px;padding: 30px;
        }
        table {          
            border-collapse: collapse;
            margin-bottom: 20px;
        } 

        th, td {
            padding: 2px;
            text-align: left;
         
        }.footer {
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
        } @page {
                size: auto;   /* auto is used for compatibility with most browsers */
                margin: 0;    /* no margin on printing */
            }

            body {
                margin: 0; /* Reset default body margin */
            }
        @media print {
            /* Hide the buttons when printing */
            button {
        #page-url, #date-time 
            display: none;              
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
    <script>
        function convertToWords() {
            const ones = [
                '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten',
                'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen',
                'Eighteen', 'Nineteen'
            ];
            const tens = [
                '', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'
            ];
            const scales = ['', 'Thousand', 'Million', 'Billion', 'Trillion'];

            function convertToWords(num) {
                if (num === 0) return 'Zero';
                
                let words = '';
                for (let i = 0; num > 0; i++) {
                    if (num % 1000 !== 0) {
                        words = helper(num % 1000) + scales[i] + ' ' + words;
                    }
                    num = Math.floor(num / 1000);
                }
                return words.trim();
            }

            function helper(num) {
                if (num === 0) return '';
                else if (num < 20) return ones[num] + ' ';
                else if (num < 100) return tens[Math.floor(num / 10)] + ' ' + helper(num % 10);
                else return ones[Math.floor(num / 100)] + ' Hundred ' + helper(num % 100);
            }

            // Get the gross total value
            const grossTotal = parseFloat(<?php echo $grossTotal; ?>); // Replace with your PHP variable containing the gross total

            // Display the result
            document.getElementById('result').innerText =  convertToWords(grossTotal) + ' Only';
        }
    </script>
       </head>
        <body onload="convertToWords()">


                           
    <p id="page-url" style="display: none;"><?php echo 'URL: ' . $_SERVER['REQUEST_URI']; ?></p>
    <p id="date-time" style="display: none;"><?php echo 'Printed on: ' . date("Y-m-d H:i:s"); ?></p>             
                                       


                                        
<br><br>

      
 <center><span style="text-align: center;font-size: 35px; margin: 5px;">TRIFRND PVT. LTD.</span></center>
 <center ><b style="margin: 5px;">D-13, 3rd Floor, KK Market, Bibwewadi Road, Dhanakawadi, Pune-411 043</b></center>

 <p style="margin:5px; text-align:center;">GSTIN: 27AAJCT8817G1ZX</p>

        <center><span style="text-align: center; font-weight: bolder; font-size: 25px;">TAX INVOICE</span></center>
                                        
<br><br>

<table  width="100%" border="1">
<tr>
    <td colspan="6"><b>To</b>
    <ul style="list-style-type: none;">
    <li><b>Contact:</b><?php echo  $fname." ".$lname;?></li>                                    
  <li><b>Company:</b><?php echo  $Comp;?></li>
<b>Address:</b><?php echo $address." ".$city." ".$zip."<br> ".$district." ".$state;?>
<li><b>Mobile: </b><?php echo $mobile;?></li>
<li><b>Email:</b> <?php echo  $email;?></li>
</ul></td>
</tr>                                      

<tr>
    <th colspan="2" style="border-right:hidden;text-align: center; padding-top: 10px; padding-bottom: 10px;">Invoice No:</th>
    <th colspan="2" style="border-right:hidden;"><?php echo $billno; ?></th>
    <th style="border-right:hidden; text-align: right; padding-top: 10px; padding-bottom: 10px;">Date:</th>
    <th style="text-align:center;"><?php echo date("d-m-Y", strtotime($billdate)); ?></th>
</tr>


<tr>
   <th style="text-align:center;"width="5%">Sr.No</th>
   <th style="text-align:center;"width="12%">HSN</th>
   <th style="text-align:center;">DESCRIPTION</th>
   <th style="text-align:center;"width="7%">QTY.</th>
   <th style="text-align:center;"width="12%">Rate</th>
   <th style="text-align:center;"width="12%">Amount</th>
</tr>
                               
                                     
                                           <?php 
             $sql11 = "SELECT * FROM crm_invoice WHERE Bill_No = '$billno'";
            $result11 = $conn->query($sql11);
                                           $i=1;                                    
                                           
            while ($r = mysqli_fetch_assoc($result11)) { ?>
                                              
        <tr>
        <td style="text-align:center;<?php  echo 'border-bottom:;'; ?>"><?php echo $i;?></td>
        <td style="text-align:center;border-bottom:;">998314</td>
        <td style="border-bottom:;">
            <?php echo $r['Category'] . '<br>' . $r['Subcategory'] . '<br>' . $r['Work_Scope']; ?>
        </td>
        <td style="text-align:center;border-bottom:;"><?php echo $r['Qty']; ?></td>
        <td style="text-align:right;border-bottom:;">
            <?php echo number_format($r['Amt'], 2); ?>
        </td>
        <td style="text-align:right;border-bottom:;">
            <?php echo number_format($r['TotAmt'], 2); ?>
        </td>
    

    </tr><?php   $i++; } ?>


<!-- style="border-top: 1px solid black;" -->
<tr>
    <td  colspan="3" style="padding-top: 0;">
        <u style="font-weight: bold;">Gross Total (in Words) :</u><br>
        <b>Rupees:</b><span id="result"></span>
    </td>

    <th colspan="2" style="text-align:right;">Sub Total:</th>
    <td style="text-align:right;"><?php echo number_format($totalAmount, 2); ?></td>
</tr>


      
        <tr>
            <th  rowspan="3" colspan="3" style="padding-top: 0;border-top: hidden;">
            <th colspan="2" style="text-align:right;">SGST:</th>
            <td style="text-align:right;"><?php echo number_format($sgst, 2); ?></td>
        </tr>
        <tr>
            
            <th colspan="2" style="text-align:right;">CGST:</th>
            <td style="text-align:right;"><?php echo number_format($cgst, 2); ?></td>
        </tr>
        <tr>
            
            <th colspan="2" style="text-align:right;">Gross Total:</th>
            <td style="text-align:right;"><?php echo number_format($grossTotal, 2); ?></td>
        </tr>

        <tr>
            <th colspan="4" style="border-right: hidden;border-bottom: hidden;border-left: hidden;"></th>
            <th colspan="2" style="text-align:center; padding: 10px;border-bottom: hidden;border-right: hidden;">For TRIFRND Pvt. Ltd.<br><br><br><br><br><br>
            Authorised Signature</th>
        </tr>
              
            
        </table>
  <br>
<div>
<center>
    <!-- Buttons for Back and Print -->
    <table style="margin-top: 50px;">
        <tr>
            <th><button onclick="window.history.back()">Back</button></th>
            <th><button onclick="window.print()">Print</button></th>
            <th>  <button onclick="downloadPDF()"> PDF</button></th>
        </tr>
    </table>
</center></div>

<script>
        function downloadPDF() {
           
            var Bill_No = '<?php echo $billno; ?>';
            window.location.href = 'infoinvoicePDF.php?Bill_No=' + Bill_No;
        }
    </script> 


  <div class="footer">
        <p>This is a computer-generated invoice</p>
    </div> 
                                    
                                 </body>
                                 </html>



