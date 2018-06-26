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
    <head><link rel="stylesheet" href="css_menu/styles.css">

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
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->


</head>

<body>
<div id='cssmenu'>
<ul>
   <li><a href='index.php'>Home</a></li>
   <li><a href='list.php'>Item List</a></li>
   <li class='active'><a href='displayAllRecords.php'>View Orders</a></li>
   <li><a href='contacts.html'>Contact</a></li>
</ul>
</div>

<center>
<h1>orders</h1>

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
        <td>'.$displayRecords['cname'].'</td>
        <td>'.$displayRecords['address'].'</td>
        <td>'.$displayRecords['phone'].'</td>
        <td>'.$displayRecords['total_amount'].'</td>
        <td>'.$displayRecords['days'].'</td>
        <td>'.$displayRecords['total_amount1'].'</td>
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
</body>
</html>