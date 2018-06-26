<?php
$link = mysqli_connect("localhost","root","","demo");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = "select * from items";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

echo "<center>
<B>Item list</B>
<BR>
<BR>
<table border=1 cellpadding='10' >
<tr>
<TH >ITEM-ID</TH>
<Th>ITEM-NAME</Th>
<TH>ITEM-QUANTITY</TH>
<TH>AVAILABLE-ITEMS</TH>
<th>PRICE</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
    echo  '<tr>
    <th>'.$row['id'].'</th>
    <th >'.$row['name'].'</th>
    <th>'.$row['quantity'].'</th>
    <th>'.$row['available'].'</th>
    <th>'.$row['Price'].'</th>
    </tr>' ;

}



echo "</table>";

echo "

<br>
<br>
<a href='ex.php'><button>UPDATE</button></a>
<br>
<br>

</center>


";

mysqli_close($link);
?>
