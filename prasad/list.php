<?php
$link = mysqli_connect("localhost","root","","demo");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = "select * from items";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

?>
<html>
<head>
<link rel="stylesheet" href="css_menu/styles.css">


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
   <li class='active'><a href='list.php'>Item List</a></li>
   <li><a href='displayAllRecords.php'>View Orders</a></li>
   <li><a href='contacts.html'>Contact</a></li>
</ul>
</div>

<?php
echo "<center>
<h1></h1>
<BR>
<BR>
<div class='table100-body js-pscroll'>
<table border=1 cellpadding='10' >

<tr class='row100 body'>
<TH>ITEM-ID</TH>
<Th>ITEM-NAME</Th>
<TH>ITEM-QUANTITY</TH>
<TH>AVAILABLE-ITEMS</TH>
<th>PRICE</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
    echo  '<tr class="row100 body">
    <td class="cell100 column1">'.$row['id'].'</td>
    <td class="cell100 column2">'.$row['name'].'</td>
    <td class="cell100 column3">'.$row['quantity'].'</td>
    <td class="cell100 column4">'.$row['available'].'</td>
    <td class="cell100 column5">'.$row['Price'].'</td>
    </tr>' ;

}



echo "</table></div>";

echo "
<a href='ex.php'><button>UPDATE</button></a>
<br>
<br>

</center>


";

mysqli_close($link);
?>

</body>
</html>