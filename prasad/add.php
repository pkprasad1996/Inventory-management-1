
<?php
$link = mysqli_connect("localhost","root","","demo");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_POST['un']) and isset($_POST['p']) and isset($_POST['name']))
{
    $un=$_POST['un'];
    $n=$_POST['name'];
    $p=$_POST['p'];

    $query = "INSERT INTO admin(name,username,password)values('$n','$un','$p')";
   
    if(mysqli_query($link, $query)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}

mysqli_close($link);
?>


<html>
<head>


</head>
<body>
    <form action="" method="post">
    <center>
    <h1>New Admin Information</h1>
    <table border=1>
        <tr>
            <th>
                Enter Name :
            </th>
            <th>
                <input type="text" name="name" placeholder="Name"required/>
            </th>
        </tr>
        <tr>
            <th>
                Enter UserName :
            </th>
            <th>
                <input type="text" name="un"placeholder="UserName"required/>
            </th>
        </tr>
        <tr>
            <th>
                Enter Password :
            </th>
            <th>
                <input type="password" name="p"placeholder="Enter Password"required/>
            </th>
        </tr>
        <tr >
            <th colspan=2>
                <input type="submit" value="SUBMIT"/>
            </th>
        </tr>
    </table>
    </center>
    </form>




</body>
</html>