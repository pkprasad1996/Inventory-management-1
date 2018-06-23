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
    $thisUserID = $_GET['oid'];
    

    $query = "select * from orders join customer on orders.cid = customer.cid
                                    join order_details on orders.oid = order_details.oid 
                                    where orders.oid = '$thisUserID'";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $result2 = mysqli_query($link, $query) or die(mysqli_error($link));
    $count = mysqli_num_rows($result2);
    $r = mysqli_fetch_array($result);
    



    



    if(isset($_POST['address']))
    {   
    
        for($k=0;$k<$count;$k++)
        {  
            
            
            if(isset($_POST['check'.$k.'']))
            {
                $idd=$_POST['id'.$k.''];
                $n=$_POST['name'.$k.''];
                $oid=$_POST['oid'];
                $p=(float)$_POST['price'.$k.''];
                $rent=$_POST['rentq'.$k.''];
                $ret=$_POST['ret'.$k.''];
                $rem=$_POST['rem'.$k.''];
                $total=(float)$_POST['total'.$k.''];
                $rem=$rem-$ret;

                

                $total=$rent*$p;


                $query4 = "UPDATE order_details SET rentq='$rent', total='$total', returned='$ret', remained='$rem' where oid='$oid' and id='$idd'";
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

            }

           

        }
        
       
}



if(isset($_POST['address1']))
    {   
    


        $amount=$_POST['amount'];
        $days=$_POST['days'];
        $total=$_POST['total'];
        $paid=$_POST['paid'];
        $total=$amount*$days;

       

        $query22="UPDATE orders SET days='$days', total_amount1='$total', amount_paid='$paid' where oid='$thisUserID' ";
        $result22 = mysqli_query($link, $query22) ;
        if(!$result22)
        {
            echo "Updation failed";
        }
    }

?>

<html>
<head>
<script src="jquery-3.3.1.min.js"></script>
<script>
/*
 $(document).ready(function()
            {
                $("input").change(function()
                {
                    var days = document.find('.days').value;
                    alert(days);
                //  var amount=document.getElemetById("amount").value;
                // var total=days*amount;
                // document.getElemetById("total").value=total;
            }); 
        });
*/
</script>

</head>
<body>
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
            <td><input id="amount" type="number" name="amount" value='.$r['total_amount'].'></td>
        <tr>
        <tr>
            <td>Days</td>
            <td><input  id ="days" type="number" name="days" value='.$r['days'].'></td>
        <tr>
        <tr>
            <td>Total</td>
            <td><input  id="total" type="number" name="total" value='.$r['total_amount1'].'></td>
        <tr>
        <tr>
            <td>Amount_paid</td>
            <td><input  id="paid" type="number" name="paid" value='.$r['amount_paid'].'></td>
        <tr>
        <th colspan=3><input type="submit" value="Update" name="address1"/></th>
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
    <td><a href="UpdateOrder1.php?oid='.$row['oid'].'">'.$row['oid'].' </a></td>
    <th><input type="number" name="id'.$i.'" value='.$row['id'].' readonly></th>
    <th><input type="text" name="name'.$i.'" value='.$row['name'].' readonly></th>
    <th><input type="number" name="price'.$i.'" value='.$row['price'].' readonly></th>
    <th><input type="number" name="rentq'.$i.'" value='.$row['rentq'].' readonly></th>
    <th><input type="number" name="ret'.$i.'" value=0></th>
    <th><input type="number" name="rem'.$i.'" value='.$row['remained'].'></th>
    <th><input type="number" name="total'.$i.'" value='.$row['total'].'></th>
    <th><input type="checkbox" name="check'.$i.'" value="d"></th>
    </tr>
    ';
    $i=$i+1;
}
echo  '<th colspan=3><input type="submit" value="Update" name="address"/></th>
 <th> <input type="button" value="Refresh Page" onClick="window.location.reload()"></th>
<th colspan=3><input type="submit" value="Delete" name="delete"/></th>
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