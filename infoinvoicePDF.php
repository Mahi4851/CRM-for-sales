<?php
session_start();
require('config.php');
require_once('dompdf/autoload.inc.php');

use Dompdf\Dompdf;

 $dompdf = new Dompdf();
$Bill_No = $_GET['Bill_No'];

$sql = "SELECT * FROM crm_invoice WHERE Bill_No = '$Bill_No'";
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

}
    ob_start();
?>
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
        }
       .footer {
    text-align: center;
    font-size: 12px;
    margin-top: 20px;
    position: fixed; /* Change the position to fixed */
    bottom: 1px; /* Adjust the bottom spacing */
    left: 0;
    right: 0;
}
    
    </style>
    <?php function numberToWords($num){
    $ones = array(
        0 => 'Zero', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen',
        18 => 'Eighteen', 19 => 'Nineteen'
    );
    $tens = array(
        0 => '', 1 => '', 2 => 'Twenty', 3 => 'Thirty', 4 => 'Forty', 5 => 'Fifty', 6 => 'Sixty', 7 => 'Seventy', 8 => 'Eighty', 9 => 'Ninety'
    );
    $scales = array(
        '', 'Thousand', 'Million', 'Billion', 'Trillion'
    );

    if ($num < 20) {
        return $ones[$num];
    } elseif ($num < 100) {
        return $tens[floor($num / 10)] . (($num % 10 !== 0) ? ' ' . $ones[$num % 10] : '');
    } elseif ($num < 1000) {
        return $ones[floor($num / 100)] . ' Hundred' . (($num % 100 !== 0) ? ' and ' . numberToWords($num % 100) : '');
    }

    for ($i = 0; $i < count($scales); $i++) {
        if ($num >= pow(1000, $i) && $num < pow(1000, $i + 1)) {
            return numberToWords(floor($num / pow(1000, $i))) . ' ' . $scales[$i] . (($num % pow(1000, $i) !== 0) ? ' ' . numberToWords($num % pow(1000, $i)) : '');
        }
    }
}

$amountInWords = numberToWords($grossTotal);

?>
       </head>
        <body onload="convertToWords()">

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
    <th  style="border-right:hidden;"><?php echo $billno; ?></th>
    <th style="border-right:hidden; text-align: center; padding-top: 10px; padding-bottom: 10px;">Date:</th>
    <th colspan="2" style="text-align:left;"><?php echo date("d-m-Y", strtotime($billdate)); ?></th>
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
        <b>Rupees:</b><span id="result"><?php echo $amountInWords." Only"; ?></span>
    </td>

    <th colspan="2" style="text-align:right;">Sub Total:</th>
    <td style="text-align:right;"><?php echo number_format($totalAmount, 2); ?></td>
</tr> <tr>
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
  <br> <br>             
  <div class="footer" style="margin-bottom: 0px;">
    <p>This is a computer-generated invoice</p>
</div>                   
                                 </body>
                                 </html>

<?php
$html = ob_get_clean();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream('Invoice.pdf', ['Attachment' => true]);
?> 