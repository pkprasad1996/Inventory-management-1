<?php
$link = mysqli_connect("localhost","root","","demo");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = "select * from orders join customer on orders.cid = customer.cid";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$count=mysqli_num_rows($result);
$k=0;
$i=0;




session_start();



?>
<html>


<center>
<B>orders</B>
<BR>
<BR>
<form method="post" action="displayAllRecords.php">
<table border=3 cellpading=20>
<tr>
<th>Check</th>
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
    //foreach($result as $displayRecords)
    
    while($displayRecords = mysqli_fetch_array($result))
    { 
        echo '
        <tr>
        <th><input type="submit" name="add'.$i.'" value="View Details" ></th>
        <td><input type="text" value='.$displayRecords['oid'].' name ="oid'.$i.'" readonly></td>
        <th>'.$displayRecords['cname'].'</th>
        <th>'.$displayRecords['address'].'</th>
        <th>'.$displayRecords['phone'].'</th>
        <th>'.$displayRecords['total_amount'].'</th>
        <th>'.$displayRecords['days'].'</th>
        <th>'.$displayRecords['total_amount1'].'</th>
        </tr>
        
        ';
        $i=$i+1;
     } 


  //   echo"<tr><td colspan=8 align='middle'><input type='submit' name='add' value='View Details' ></td></tr>";
     
   //  echo"<a href='UpdateOrder.php'>View Bill</a>";
     ?>
        
        




<?php
for($k=0;$k<$count;$k++)
{
   
    if(isset($_POST['add'.$k.'']))
        {   
                $oid=$_POST['oid'.$k.''];
                $_SESSION['oid']=$oid;
                echo' <script> location.href="UpdateOrder.php"</script>';
        }
}



mysqli_close($link);
?>

</table>
</form>
</center>

</html>