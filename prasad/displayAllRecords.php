<?php
$link = mysqli_connect("localhost","root","","demo");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = "select * from orders join customer on orders.cid = customer.cid";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

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
</tr>

    <?php
    foreach($result as $displayRecords) { ?>
        <tr>
            <td><a href="UpdateOrder.php?oid=<?php print $displayRecords['oid']; ?>">
                    <?php print $displayRecords['oid']; ?></a></td>
            <td><?php print $displayRecords['cname']; ?></td>
            <td><?php print $displayRecords['address']; ?></td>
            <td><?php print $displayRecords['phone']; ?></td>
        </tr>
    <?php } ?>


</table>

</center>

</html>

<?php
mysqli_close($link);
?>
