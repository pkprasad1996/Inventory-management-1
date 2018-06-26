<?php
    $link = mysqli_connect("localhost","root",'',"demo");
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    $i=0;
    $k=0;
    $tto=0;

    
    //error reporting and warning display.
    //error_reporting(E_ALL);
    //ini_set('display_errors', 'off');

    //GET param from href
    
    

    session_start();
    if(isset($_SESSION['oid'])) {
  $thisUserID = $_SESSION['oid'];
}



    $query = "select * from orders join customer on orders.cid = customer.cid
                                    join order_details on orders.oid = order_details.oid 
                                    where orders.oid = '$thisUserID'";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $result2 = mysqli_query($link, $query) or die(mysqli_error($link));
    $count = mysqli_num_rows($result2);
    $r = mysqli_fetch_array($result);
    $tto=0;



    



    if(isset($_POST['address']))
    {   
            $amount=(float)$_POST['amount'];
            $days=$_POST['days'];
            $total=(float)$_POST['total'];
            $paid=(float)$_POST['paid'];
            $total=$amount*$days;

        

            $query22="UPDATE orders SET days='$days', total_amount='$amount', total_amount1='$total', amount_paid='$paid' where oid='$thisUserID' ";
            $result22 = mysqli_query($link, $query22) ;


        for($k=0;$k<$count;$k++)
        {  
                $idd=$_POST['id'.$k.''];
                $n=$_POST['name'.$k.''];
                $oid=$_POST['oid'];
                $total=(float)$_POST['total'.$k.''];
                
    
                $p=(float)$_POST['price'.$k.''];
                $rent=$_POST['rentq'.$k.''];
                $ret=$_POST['ret'.$k.''];
                $ret=intval($ret);
                $rem=$_POST['rem'.$k.''];
                
                
                $rem=$rem-$ret;

                $total=$rent*$p;
                $tto=$tto+$total;

                $query4 = "UPDATE order_details SET rentq='$rent', total='$total', returned=returned+'$ret', remained='$rem' where oid='$oid' and id='$idd'";
                $result4 = mysqli_query($link, $query4) ;


                if(!$result4)
                {
                    echo "Updation failed";
                }

                $query44 = "UPDATE items SET  available=available+'$ret'  where id='$idd'";
                $result44 = mysqli_query($link, $query44);

             
                
                if(!$result44)
                {
                    echo "Updation failed";
                }
                else
                {
                echo' <script> location.href="UpdateOrder.php"</script>';
                }

          

        }
            
           $q="UPDATE orders SET total_amount=$tto where oid='$thisUserID'";
           $r = mysqli_query($link, $q) ;
           

            
     
        
       
}

?>

<html>
<head>
<link rel="stylesheet" href="css_menu/styles.css">
   
<script src="jquery-3.3.1.min.js"></script>

    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="table/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="table/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="table/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="table/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="table/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->

</head>
<body>
<div id='cssmenu'>
<ul>
   <li><a href='index.php'>Home</a></li>
   <li><a href='list.php'>Item List</a></li>
   <li><a href='displayAllRecords.php'>View Orders</a></li>
   <li><a href='contacts.html'>Contact</a></li>
</ul>
</div>

<form  method='post'>
<center>
    <B>order details</B>
    <BR>
    <BR>
    <table border=3 cellpading=20>
    <?php
     
    echo '
       
        <tr>
            <td>Name</td>
            <td>'.$r['cname'].'</td></tr>
        <tr>
            <td>Address</td>
            <td>'.$r['address'].'</td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>'.$r['phone'].'</td>
        </tr>
        <tr>
            <td>Amount</td>
            <td><input id="amount" type="number" step="any" name="amount" value='.$r['total_amount'].'></td>
        </tr>
        <tr>
            <td>Days</td>
            <td><input  id ="days" type="number" name="days" value='.$r['days'].'></td>
        </tr>
        <tr>
            <td>Total</td>
            <td><input  id="total" type="number" step="any" name="total" value='.$r['total_amount1'].'></td>
        </tr>
        <tr>
            <td>Amount_paid</td>
            <td><input  id="paid" type="number" step="any" name="paid" value='.$r['amount_paid'].'></td>
        </tr>
       
    ';
    
   
    ?>
    
     </table>
    <br>
    <table border=3 cellpading=20>
        <tr>
            <TH>ORDER-ID</TH>
            <th>ITEM-ID</th>
            <TH>Items</TH>
            <TH>Unit Cost</TH>
            <TH>Quantity</TH>
            <th>returned</th>
            <th>Remained</th>
            <TH>Price</TH>
             <th>Check</th>     
        </tr>

        <?php


while($row = mysqli_fetch_array($result2))
{

    echo  '
    <tr>
    <input type="hidden" name="oid" value='.$row['oid'].' >
    <td><a href="UpdateOrder1.php">'.$row['oid'].' </a></td>
    <th><input type="number" name="id'.$i.'" value='.$row['id'].' readonly></th>
    <th><input type="text" name="name'.$i.'" value='.$row['name'].' readonly></th>
    <th><input type="number" name="price'.$i.'" value='.$row['price'].' readonly></th>
    <th><input type="number" name="rentq'.$i.'" value='.$row['rentq'].' ></th>
    <th><input type="number" name="ret'.$i.'" value=0></th>
    <th><input type="number" name="rem'.$i.'" value='.$row['remained'].'></th>
    <th><input type="number" name="total'.$i.'" value='.$row['total'].'></th>
    <th><input type="checkbox" name="check'.$i.'" value="d"></th>
    </tr>
    ';
    $i=$i+1;
}
echo  '<td colspan=8><center><input type="submit" value="Update" name="address"/></center></td>
<td colspan=1><center><input type="submit" value="Delete" name="delete"/></center></td>
';
         ?>


    </table>

</center>
</form>
</body>
</html>

<?php
mysqli_close($link);
?>