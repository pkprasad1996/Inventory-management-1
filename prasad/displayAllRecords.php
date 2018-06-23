<?php
$link = mysqli_connect("localhost","root","","demo");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = "select * from orders join customer on orders.cid = customer.cid";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

$i=0;

?>
<html>


<center>
<B>orders</B>
<BR>
<BR>
<table border=3 cellpading=20>
<tr>
<TH>ORDER-ID</TH>
<TH>NAME</TH>
<TH>ADDRESS</TH>
<TH>PHONE</TH>
<TH>AMOUNT</TH>
<TH>DAYS</TH>
<TH>TOTAL_AMOUNT</TH>
</tr>


    <?php
    $i=0;
    foreach($result as $displayRecords) { 
        echo '
        <tr>
        <td><a href="UpdateOrder.php?oid='.$displayRecords['oid'].'">
                    '.$displayRecords['oid'].'</td>
        <th>'.$displayRecords['cname'].'</th>
        <th>'.$displayRecords['address'].'</th>
        <th>'.$displayRecords['phone'].'</th>
        <th><input type="number" name="amount'.$i.'" value='.$displayRecords['total_amount'].'></th>
        <th><input type="number" name="days'.$i.'" value='.$displayRecords['days'].'></th>
        <th><input type="number" name="total'.$i.'" value='.$displayRecords['total_amount1'].'></th>
        </tr>
        ';
        $i=$i+1;
     } 
     ?>
        


</table>

</center>

</html>

<?php
mysqli_close($link);
?>
