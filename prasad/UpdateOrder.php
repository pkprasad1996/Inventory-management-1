<?php
    $link = mysqli_connect("localhost","root","","demo");
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    //GET param from href
    $thisUserID = $_GET['oid'];
    

    $query = "select * from orders join customer on orders.cid = customer.cid
                                    join order_details on orders.oid = order_details.oid 
                                    where orders.oid = '$thisUserID'";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));

?>

<html>


<center>
    <B>order details</B>
    <BR>
    <BR>
    <table border=3 cellpading=20>
        <tr>
            <TH>ORDER-ID</TH>
            <!-- <TH>NAME</TH> -->
            <!-- <TH>ADDRESS</TH> -->
            <!-- <TH>PHONE</TH> -->
            <TH>Items</TH>
            <TH>Rent</TH>
            <TH>Price</TH>
            <TH>Total</TH>
        </tr>

        <?php
        foreach($result as $displayRecords) { ?>
            <tr>
                <td><a href="UpdateOrder.php?oid=<?php print $displayRecords['oid']; ?>">
                        <?php print $displayRecords['oid']; ?></a></td>
                    <td><?php print $displayRecords['name']; ?></td>
                    <td><?php print $displayRecords['rentq']; ?></td>
                    <td><?php print $displayRecords['price']; ?></td>
                    <td><?php print $displayRecords['total']; ?></td>
            </tr>
        <?php } ?>


    </table>

</center>

</html>

<?php
mysqli_close($link);
?>