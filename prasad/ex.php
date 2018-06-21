<?php
$link = mysqli_connect("localhost","root","","demo");
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = "select * from items";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$count = mysqli_num_rows($result);

echo "
<form action='ex.php' method='post'>
<center>
<table border=3 cellpading=20>
<h1>ITEM LIST</h1>
<tr>
<TH>ITEM-ID</TH>
<TH>ITEM-NAME</TH>
<TH>ITEM-QUANTITY</TH>
<TH>AVAILABLE-ITEMS</TH>
<th>PRICE/ITEM</th>
<th>CHECKBOX</th>
</tr>";

$i=0;
$k=0;
while($row = mysqli_fetch_array($result))
{

    echo  '
    <tr>
    <th><input type="number" placeholder='.$row['id'].' name="id'.$i.'" value='.$row['id'].' readonly></th>
    <th><input type="text" placeholder='.$row['name'].' name="name'.$i.'" value='.$row['name'].'></th>
    <th><input type="number" placeholder='.$row['quantity'].' name="quantity'.$i.'" value='.$row['quantity'].'></th>
    <th><input type="number" placeholder='.$row['available'].' name="available'.$i.'" value='.$row['available'].'></th>
    <th><input type="number" step="any" placeholder='.$row['Price'].' name="price'.$i.'" value='.$row['Price'].'></th>
    <th><input type="checkbox" name="check'.$i.'" value="d"></th>
    </tr>
    ';
    $i=$i+1;
}

echo  '<th colspan=5><input type="submit" value="Update" name="address"/>
        <th colspan=5><input type="submit" value="Delete" name="delete"/>
        ';
    $result1;
    if(isset($_POST['delete']))
    {    
        for($k=0;$k<$count;$k++)
        {
            if(isset($_POST['check'.$k.'']))
            {
                $idd=$_POST['id'.$k.''];
                $query1 = "DELETE from items where id='$idd'";
                $result1 = mysqli_query($link, $query1) ;
                if(!$result1)
                {
                    echo "Updation failed";
                }
                else
                {
                echo' <script> location.href="ex.php"</script>';
                }
            }
            
        }
        
    }




if(isset($_POST['address']))
    {    
    for($k=0;$k<$count;$k++)
    {
        $idd=$_POST['id'.$k.''];
        $n=$_POST['name'.$k.''];
        $q=$_POST['quantity'.$k.''];
        $a=$_POST['available'.$k.''];
        $p=(float)$_POST['price'.$k.''];
        if($n=='')
        {
        $n="None";
        }
        $query2 = "UPDATE items SET name='$n', quantity='$q', available='$a', Price='$p' where id='$idd'";
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

echo "</table>";
echo '
<br>
<br>
<br>
<table border=2>
<h1>ADD ITEM</h1>
<tr>
<th><input type="text" placeholder="Name" name="name"  /></th>
<th><input type="number" placeholder="Quantity" name="quantity" /></th>
<th><input type="number" placeholder="Available" name="available"/></th>
<th><input type="number" placeholder="Price" name="price"/></th>
</tr>
<tr>
<th colspan=4>
<input type="submit" name="add" value="ADD"/>
</th>
</tr>
</table>
<br>
</form>


</center>
';

if(isset($_POST['add']))
{
    $n=$_POST['name'];
    $q=$_POST['quantity'];
    $a=$_POST['available'];
    $p=$_POST['price'];
    if($n=='')
        {
        $n="None";
        }
    $query3 = "INSERT INTO items(name,quantity,available,Price)values('$n','$q','$a','$p')";
    $result3 = mysqli_query($link, $query3) ;
    if(!$result3)
        {
            echo "Updation failed";
        }
        else
        {
            echo' <script> location.href="ex.php"</script>';
        }
}

echo '
<center>
<br>
<a href="list.php"><button>Check List</button></a>
<br>
</center>
';
mysqli_close($link);

?>

