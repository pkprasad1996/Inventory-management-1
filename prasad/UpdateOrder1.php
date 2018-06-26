<?php
$link = mysqli_connect("localhost","root",'',"demo");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$nn=0;
//GET param from href
session_start();
if(isset($_SESSION['oid'])) {
$thisUserID = $_SESSION['oid'];
}


//order_details join
$query ="select * from orders join customer on orders.cid = customer.cid
         join order_details on orders.oid = order_details.oid 
         where orders.oid = '$thisUserID'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));



$r12 = mysqli_fetch_array($result);

//order_details
$query4 = "select * from order_details where order_details.oid='$thisUserID'";
$result1 = mysqli_query($link, $query4) or die(mysqli_error($link));

$count=mysqli_num_rows($result1);
$r = $result->fetch_row();


if(isset($_POST['address']))
    {    
        for($k=0;$k<$count;$k++)
        {
            $name=$_POST['name'.$k.''];
            $rem=$_POST['rem'.$k.''];
            $query2 = "UPDATE order_details SET remained='$rem' where name='$name'";
            $result2 = mysqli_query($link, $query2) ;
        }
        if(!$result2)
        {
            echo "Updation failed";
        }
        else
        {
            echo'<script> location.href="ex.php"</script>';
        }
}





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title>Invoice</title>

    <link rel='stylesheet' type='text/css' href='css/style.css' />
    <link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
    <!-- <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>  -->
    <!--   <script type='text/javascript' src='js/example.js'></script>  -->

    <script>
function print1() {
    window.print();
}

function print2() {
    location.href="UpdateOrder.php";
}


</script>

</head>

<body>


    <form>

<div id="page-wrap">

    <div id="terms">
        <h5>SWAGAT ENTERPRISES</h5>
        <p align="right">Ajay Panchakshari<br>
        Mobile No: 9823047824</p>
    </div>


    <textarea id="header">INVOICE</textarea>

    <div id="identity">

            
        To,<br>
        Name: <?php print $r12['cname']; ?><br>
        Address: <?php print $r12['address']; ?><br>
        Phone : <?php print $r12['phone']; ?>

        <div>
            <img id="image" width="320" height="60" align="right" src="images/logo1.png" alt="logo" />
        </div>

    </div>

    <div style="clear:both"></div>

    <div id="customer">
        <table id="meta" align="right">
            <tr>
                <td class="meta-head">Invoice #</td>
                <td><textarea><?php print $r[0]; ?></textarea></td>
            </tr>
            <tr>
                <td class="meta-head">Date</td>
                <?php $date = $r[4]
                ?>
                <td><textarea><?php print date("Y-M-d",$r[4]); ?></textarea></td>
            </tr>
            <tr>
                <td class="meta-head">Amount Due</td>
                <td><div class="due"><?php print $r[7]-$r[6]; ?></div></td>
            </tr>

        </table>
        
    </div>
    <table id="items" >

        <tr>
            <th>Item</th>
            <th>Unit Cost</th>
            <th>Quantity</th>
            <th>Remained</th>
            <th>Price</th>
        </tr>

      <?php  while($row = mysqli_fetch_array($result1))
      echo' <tr align="middle">
                <td>'.$row['name'].'</td>
                <td>'.$row['price'].'</td>
                <td>'.$row['rentq'].'</td>
                <td>'.$row['remained'].'</td>
                <td>'.$row['total'].'</td>
            </tr> ';
        ?>
        </table>
        <br>
        <table id="items">
        <tr id="hiderow" >
            <td colspan="5" align="middle"><input type="button" onclick="print1()" value="Print Invoice" />
            <input type="button" onclick="print2()" value="Edit Bill" /></td>
        </tr>
       
        <tr >
            
            <td colspan="2"  align="middle">Number of days</td>
            <td class="total-value"><div id="subtotal" ><?php print $r[5]; ?></div></td>
            <td colspan="2" align="middle" > Mr. Ajay Panchakshari.  </td>
        </tr>
        <tr>

            
            <td colspan="2"  align="middle">Total (for 1 day)</td>
            <td class="total-value"><div id="total"><?php print $r[2]; ?></div></td>
            <td colspan="2" class="blank"> </td>
        </tr>
        <tr>
            <td colspan="2"  align="middle">Total  Amount (no of days)</td>
            <td class="total-value"><div class="due"> <?php print $r[7]; ?></td>
            <td colspan="2" class="blank" align="middle"> </td>
        </tr>
        <tr>
            <td colspan="2"  align="middle">Amount Paid</td>
            <td class="total-value"><div class="due"> <?php print $r[6]; ?></td>
            <td colspan="2" class="blank" align="middle"> </td>
        </tr>
        <tr>
            <td colspan="2"  align="middle">Balance Due</td>
            <td class="total-value balance"><div class="due"> <?php print $r[7]-$r[6]; ?></div></td>
            <td colspan="2" class="blank" align="middle"></td>
        </tr>

    </table>

    <div id="terms">
        <h5>Terms</h5>
        <p align="left">1.Transport Charges extra as applicable.<br>2.Hiring Rates are for One Day.<br>3.Shortage, Breakage, Damages will be charged at current market rate.<br>4.Delivery and Pick Time between 10.00 a.m. to 7.00 p.m.</p>
        
    </div>

</div>
</form>
</body>

</html>