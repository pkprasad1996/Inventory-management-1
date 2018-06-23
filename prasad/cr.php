<?php
    $link = mysqli_connect("localhost","root","","demo");
    if($link === false)
    {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    $query = "select * from items";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $count = mysqli_num_rows($result);
    $total=0;

    //error reporting and warning display.
    error_reporting(E_ALL);
    ini_set('display_errors', 'off');

    //For all items
    $query = "select * from items";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    //Generate CID and OID and status
    $character_array = array_merge(range(a, z), range(0, 9));
    $rand_string = "";
    for($i = 0; $i < 6; $i++) 
    {
        $rand_string .= $character_array[rand(0, (count($character_array) - 1))];
    }
    $cid = $rand_string;

    //Generate CID and OID and status
    $character_array = array_merge(range(a, z), range(0, 9));
    $rand_string = "";
    for($i = 0; $i < 6; $i++) 
    {
        $rand_string .= $character_array[rand(0, (count($character_array) - 1))];
    }
    $oid = $rand_string;
    $status = 0;
    $total_price1 = 0;
    //session_start
    session_start();
    $_SESSION["cid"] = cid;
    $_SESSION["oid"] = oid;

    $tto=0;

        if(isset($_POST['add_item'])) 
        {

            $cname = $_POST['cname'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $days = $_POST['days'];

            
            //customer
            $query0 = "INSERT INTO customer (cid,cname,address,phone)values('$cid','$cname','$address','$phone')";
            $result0 = mysqli_query($link, $query0);

            //order details
            $k = 0;
            $total_price = 0;

            
            // $starttime = time();
            for($j=0;$j<$count;$j++)
            {
                if(isset($_POST['check'.$j.'']))
                    {

                        $idd=$_POST['id'.$j.''];
                        $n=$_POST['name'.$j.''];
                        $rentq = $_POST['rentq'.$j.''];
                        $price = $_POST['price'.$j.''];
                        $a=$_POST['available'.$j.''];
                        $total_price = $rentq * $price;
                        $tto=$tto+$total_price;
                        $aa=$a-$rentq;
                        $query11 = "UPDATE items SET available=$aa where id=$idd";
                        $result11 = mysqli_query($link, $query11);


                        $query2 = "INSERT INTO order_details values ('$oid','$idd','$n','$rentq','$k','$price','$total_price','$rentq','$k')";
                        $result2 = mysqli_query($link, $query2);
                        if(!$query2)
                        {
                            echo "q1 Updation failed";
                        }
                        
                    }
                }
                $total_price1=$tto*$days;
                //orders
                $starttime = time();
                $query1 = "INSERT INTO orders (oid,cid,total_amount,status,startdate,days,total_amount1)values('$oid','$cid','$tto','$status','$starttime','$days','$total_price1')";
                $result1 = mysqli_query($link, $query1) ;
                if(!$query1)
                {
                    echo "q1 Updation failed";
                }
                else
                {
                    echo' <script> location.href="cr.php"</script>';
                }

            
        }



        // <th><input type="number" placeholder='.$row['quantity'].' name="quantity'.$i.'" value='.$row['quantity'].' readonly></th>
        // <th><input type="number" placeholder='.$row['available'].' name="available'.$i.'" value='.$row['available'].' readonly></th>
        //('oid','id','name','rentq','returned','price','total','remained','status')

?>

<html>
    <head>
        <title>
            BILL GENERATION
        </title>

        <script src="jquery-3.3.1.min.js"></script>

        <script>
            $(document).ready(function()
            {
                $("input").change(function()
                {
                    var j = <?php echo $count ?>;
                    var i=0;
                    var tt=0;
                    for(i=0;i<j;i++)
                    {
                        //price    
                        var x= document.getElementsByClassName("price")[i];
                        var xx= x.getElementsByClassName("bb")[0].value; 

                        //rent        
                        var y= document.getElementsByClassName("rent")[i];
                        var yy=y.getElementsByClassName("aa")[0].value;

                        //total    
                        var z= document.getElementsByClassName("total")[i];
                        var zz=z.getElementsByClassName("cc")[0].value;

                        //name
                        var n=document.getElementsByClassName("qqq")[i];
                        var nn=n.getElementsByClassName("qq")[0].value;

                        //available
                        var r=document.getElementsByClassName("www")[i];
                        var rr=r.getElementsByClassName("ww")[0].value;  
                        
                        var y1=parseInt(yy);
                        var r1=parseInt(rr);

                        if(yy=='')
                        {
                            yy=0;
                        }

                        if(zz=='')
                        {
                            zz=0;
                        }
                        
                        
                        if(y1>r1)
                        {
                            var abc=alert("Max quantity of "+nn+" is : "+rr);
                        }     
                        
                        var cal;
                        cal=xx*yy;
                        tt=tt+cal;
                        z.getElementsByClassName("cc")[0].value = cal;
                        
                    }
                    var ab =document.getElementById("h1").innerHTML="TOTAL AMOUNT : "+tt;
                }); 
            });
        </script>

    </head>
    <body>
    <center>
    <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
        <table bordor = 1 >
            <tr><th>Customer Name :</th>
                <th><input type="text" name="cname" required/></th>
            </tr>
            <tr><th>Address :</th>
                <th><input type="text" name="address" required/></th>
            </tr>
            <tr><th>Phone number:</th>
                <th><input type="text" name="phone" required/></th>
            </tr>
            <tr><th>No of Days:</th>
                <div class = "ddays">
                <th><input type="text" name="days" required/></th>
                </div>
            </tr>
        </table>   



        <div>
            <table border=1>
                <tr>
                    <TH>ITEM-ID</TH>
                    <TH>ITEM-NAME</TH>
                    <!-- <TH>ITEM-QUANTITY</TH> -->
                    <TH>AVAILABLE-ITEMS</TH>
                    <th>PRICE/ITEM</th>
                    <th>RENT</th>
                    <th>TOTAL_COST</th>
                    <th>SELECT</th>
                </tr>
                
                <?php
                    $i=0;
                    $j=0;
                    $m=0;
                    $total_price=0;
                    while($row = mysqli_fetch_array($result))
                    {
                    
                        echo  '
                        <tr>
                            <th><input type="number" placeholder='.$row['id'].' name="id'.$i.'" value='.$row['id'].' readonly></th>

                            <th>
                                <div class="qqq">
                                    <input type="text" class="qq" placeholder='.$row['name'].' name="name'.$i.'" value='.$row['name']. ' readonly>
                                </div>
                            </th>

                            <th>
                                <div class="www">
                                    <input type="number" class="ww" placeholder='.$row['available'].' name="available'.$i.'" value='.$row['available'].' readonly>
                                </div>
                            </th>
                           
                            <th>
                                <div class="price">
                                    <input type="number" class="bb" placeholder='.$row['Price'].' name="price'.$i.'" value='.$row['Price'].' readonly>
                                </div>
                            </th>
                            
                            <th>
                                <div  class="rent">
                                    <input type="number" class="aa" id="b" name="rentq'.$i.'" placeholder='.$row['available'].' >
                                </div>
                            </th>
                            
                            <th >
                                <div class="total">
                                    <input type="text" class="cc" id="c" placeholder='.$total.' readonly>
                                </div>
                            </th>

                            <th><input type="checkbox"  name="check'.$i.'"/>

                        </tr>
                        ';

                        $i=$i+1;
                }

                    
                    echo'
                        <tr>
                            <h1 id="h1">TOTAL AMOUNT : 0 </h1>
                        </tr>';
                ?>

            </table>
            <br>
            <br>
            <input type="submit" value="Add Items" name="add_item">
        </div>
                    
      </form>  

    </center>
    </body>

</html>