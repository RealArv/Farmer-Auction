<?php
  session_start();
if(isset($_SESSION['a']))
    {
		
    }
    else
    {
        header("location:..\Login\ConsumerLogin.php");
    }
?>
<!-----------------------database--------------------------------------->
    
    <?php
        $total=0;
        $mysqli = new mysqli('localhost','root','','hackathon') or die(mysqli_error($mysqli));
        $result = $mysqli->query("select product.*, cart.quantity from product JOIN cart on cart.Product_ID=product.Product_ID ") or die($mysqli->error);
        $transt = $mysqli->query("select product.*, cart.* from product JOIN cart on cart.Product_ID=product.Product_ID ") or die($mysqli->error);
        $countno = $mysqli->query("SELECT Product_ID FROM cart") or die($mysqli->error);
        $NO= mysqli_num_rows($countno);
    ?>     

<!---------------------------------------------------------------------->

<!--------------------------------remove from cart-------------------------->
    
    <?php
    if(isset($_POST['remove']))
    {
        $did=$_POST['remove'];
        $mysqli->query("delete from cart where Product_ID=$did") or die($mysqli->error);
        header("location:checkout.php");
    }
    ?>

<!--------------------------------------------------------------------------->


<!--------------------------------Credit-card------------------------------------->

    <?php 
        if(isset($_POST['destroy']))
        {
            while($row=$transt->fetch_assoc())
            {
                $invid='';
                $conid=$row['Consumer_ID'];
                $prodid=$row['Product_ID'];
                $framid=$row['Farmer_ID'];
                $qty=$row['Quantity'];
                $sto=$row['Stock'];
                $totpric= $qty * $row['Price'];
                $stkp=$sto-$qty;
                $mysqli->query("update product set Stock=$stkp where Product_ID=$prodid") or die($mysqli->error);
                $mysqli->query("INSERT INTO invoice(Inv_ID, Consumer_ID, Product_ID, Farmer_ID, Quantity, TotalPrice) VALUES ('',$conid,$prodid,$framid,$qty,$totpric)") or die($mysqli->error);
            }

            $mysqli->query("delete from cart") or die($mysqli->error);
            header("location:transaction.php");
        }
    ?>

<!-------------------------------------------------------------------------------->


<!--------------------------------------------HTML------------------------------------->

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CheckOut</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">


</head>
<body>
<!------------------------nav-bar---------------------------------->
  <div class="greenbox">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a href="index.php"><img src="pic/t2.png" style="width:120px;height:40px;" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav mr-auto">
            <a class="nav-link" href="..\LandingPage.php">Home</a>
            <?php if(isset($_SESSION['auction'])){ ?>
              <a class="nav-link" href="..\SellForm.php">Sell your product</a>
            <?php } ?>
            <a class="nav-link" href="..\Auction.php">Auction</a>
          </div>
        <a class="nav-link" href="Profile\profile.php">Profile</a>
        <a class="nav-link" href="..\Logout.php">Logout</a>
        </div>
    </div>
    </nav>
  </div>
<!----------------------------------------------------------------->

<!---------------------cart-list------------------------->

  <!----------------------------cart-items-php-code------------------------------------>

        
    <div class="container-cart col-6"> 
    <form method="POST">
    <h4 class="d-flex justify-content-between align-items-center mb-3">

            <span class="text-primary">Your cart</span>

            <span class="badge bg-primary rounded-pill"><?php echo $NO ?></span>
            </h4>
            <?php
                 while($rows=$result->fetch_assoc())
                    {
            ?>
            <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                <h6 class="my-0">
                    <span class="badge bg-warning rounded-pill"><?php echo $rows['quantity']; ?></span>
                    <?php echo $rows['Name']; ?> </h6>
                </div>
                <span class="text-muted"><?php echo $rows['quantity']*$rows['Price'];?> &nbsp;
                <button value="<?php echo $rows['Product_ID']?>" name="remove" class="btn btn-danger" style="border-radius: 100px; font-weight: 900;"  >-</button> </span>
            </li>
            <?php 
                    $total= $total+($rows['quantity']*$rows['Price']);
                     }  
            ?>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (Rs)</span>
                <strong><?php echo $total; ?></strong>
            </li>
            </ul></form>
    </div>
    <div class="container-pay col-6 ">
  
  <!---------------------------------------------------------------------->

  <!----------------------------------credit-card-validation-form-------->

    <form method="post" name="validates" onsubmit="return validateForm()" >
    <div class="card-details">
            <h3 class="title">Credit Card Details</h3>
            <hr/>
            <div class="row">
              <div class="form-group col-sm-7">
                <label for="card-holder">Card Holder</label>
                <input id="card-holder" name="validatename" type="text" class="form-control" placeholder="Card Holder" aria-label="Card Holder" aria-describedby="basic-addon1">
              </div>
              <div class="form-group col-sm-5">
                <label for="">Expiration Date</label>
                <div class="input-group expiration-date">
                  <input type="text" name="validatemonth" class="form-control" placeholder="MM" aria-label="MM" aria-describedby="basic-addon1">
                  <span class="date-separator">/</span>
                  <input type="text" name="validateyear" class="form-control" placeholder="YY" aria-label="YY" aria-describedby="basic-addon1">
                </div>
              </div>
              <div class="form-group col-sm-8">
                <label for="card-number">Card Number</label>
                <input name="validateno" id="card-number" type="text" class="form-control" placeholder="Card Number" aria-label="Card Holder" aria-describedby="basic-addon1">
              </div>
              <div class="form-group col-sm-4">
                <label for="cvc">CVC</label>
                <input id="cvc" name="vatedatecvv" type="text" class="form-control" placeholder="CVC" aria-label="Card Holder" aria-describedby="basic-addon1">
              </div>

                <button type="submit" class="btn btn-primary" name="destroy">Proceed </button>
              
            </div>
          </div>
    </form>
    </div>
                     <!---------------------script for form validation------------------------>
                     
                        <script>
                            function validateForm() 
                            {
                                    var x = document.forms["validates"]["validatename"].value;
                                    if (x == "") 
                                       { alert("Card Holder must be filled out");}
                                    if(x>=0)
                                       { alert("Card Holder must be valid");
                                        return false;}
                                    
                                    var x = document.forms["validates"]["validatemonth"].value;
                                    if (x == "")
                                        {alert("Month must be filled out");
                                             return false;}
                                    if(x>='A'&& x<='Z' || x>='a' && x<='z')
                                          {  alert("Month number must be number");
                                            return false;}
                                    if(x<0 || x>12)
                                           { alert("Month must be valid");
                                            return false;}
                                    
                                    var x = document.forms["validates"]["validateyear"].value;
                                    if (x == "") 
                                        {alert("Year must be filled out");
                                            return false;}
                                    if(x>='A'&& x<='Z' || x>='a' && x<='z')
                                        {  alert("Month number must be number");
                                            return false;}
                                    if(x<0 || x>100)
                                           { alert("Year must be valid");
                                                return false;}
                                    
                                    var x = document.forms["validates"]["validateno"].value;
                                    if (x == "") 
                                        {alert("Card number must be filled out");
                                             return false;}
                                    if(x>='A'&& x<='Z' || x>='a' && x<='z')
                                          {  alert("Card number must be number");
                                            return false;}
                                    
                                    var x = document.forms["validates"]["vatedatecvv"].value;
                                    if (x == "") 
                                        {alert("CVV must be filled out");
                                             return false;}
                                    if(x>='A'&& x<='Z' || x>='a' && x<='z')
                                       { alert("cvv must be valid");
                                        return false;}
                                    if(x<0 || x>1000)
                                       { alert("cvv not valid");
                                        return false;}
                            }
                        </script>

                     <!----------------------------------------------------------------------->

  <!--------------------------------------------------------------------->   
  
<!-------------------------------------------------->

</body>
</html>