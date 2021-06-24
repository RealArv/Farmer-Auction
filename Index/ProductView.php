<?php
    session_start();
   	$servername="localhost";
    $username="root";
    $password="";
    $dbname="hackathon";
    $con=mysqli_connect($servername,$username,$password,$dbname);
    if(!$con)
      echo mysqli_connect_error();
      
      $proid=$_GET['proid'];
      if(isset($_SESSION['a'])) {
        $sql="SELECT product.*,farmerdetails.City FROM product JOIN farmerdetails ON product.Farmer_ID=farmerdetails.FarmerID WHERE product.Product_ID=$proid";
        $result=mysqli_query($con,$sql);
      }
      else {
          header("location:..\Login\ConsumerLogin.php");
      }

      if(isset($_POST['submit'])) {
        echo '<script>alert("Welcome to Geeks for Geeks")</script>';
        $quantity = $_POST['quantity'];
        $id = $_SESSION['profile_ID'];
       
        if(isset($_SESSION['auction'])){
          $sql2 = "INSERT into cart(Consumer_ID,FarmerID,Product_ID,Quantity) values('0','$id','$proid','$quantity')";
          $result2=mysqli_query($con,$sql2);
          header("location: ..\Index\checkout2\checkout.php");
        } else {
          $sql2 = "INSERT into cart(Consumer_ID,FarmerID,Product_ID,Quantity) values('$id','0','$proid','$quantity')";
          $result2=mysqli_query($con,$sql2);
          header("location: ..\Index\checkout2\checkout.php");
        }
      }
	
?>

<!DOCTYPE html>
<html lang="en">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>

    <link rel="stylesheet" href="css/style-2.css?v=<?php echo time(); ?>">
</head>

<body>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-light bg-white" style="background-color: #e3f2fd;">
  <div class="container-fluid">
  <a href="LandingPage.php"><img src="images/logo.png" style="width:120px;height:40px;" /></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav mr-auto">
        <a class="nav-link" href="LandingPage.php">Home</a>
        <?php if(isset($_SESSION['auction'])){ ?>
        <a class="nav-link" href="SellForm.php">Sell your product</a>
        <?php } ?>
        <a class="nav-link" href="Auction.php">Auction</a>
      </div>
	  <div class="navbar-nav">
		<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" style="height:25px;width:25px;" viewBox="0 0 20 20" fill="currentColor">
			<a href="#">
			<path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
			</a>
		</svg>
	  </div>
      <div class="navbar-nav">
      <a class="nav-link" href="..\Profile\profile.php">Profile</a>
      <a class="nav-link" href="Logout.php">Logout</a>
      </div>
    </div>
  </div>
</nav>

<!--Single contents-->
<?php
while($rows=$result->fetch_assoc())
{
   ?>

<section class="text-gray-600 body-font overflow-hidden">
<div class="heading text-center" style="background: rgb(50, 226, 88);">Product</div>
  <div class=" container px-5 py-20 mx-auto">
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" style="height:300px;width:300px;" src="<?php echo $rows['Image'];?>">
      <div class="lg:w-1/2 w-full lg:pl-10 mt-6 lg:mt-0">

        <h2 class="text-gray-900 text-3xl title-font font-medium mb-1">Name: <span class="fontw"> <?php echo $rows['Name'];?></span> </h2>
        <h2 class="text-gray-900 text-3xl title-font font-medium mb-1">Price:<span class="fontw"> <?php echo $rows['Price'];?></span></h2>
        <h2 class="text-gray-900 text-3xl title-font font-medium mb-1">Area:<span class="fontw"> <?php echo $rows['City'];?></span></h2>
        <h2 class="text-gray-900 text-3xl title-font font-medium mb-1">Description:</h2>
        <p class="leading-relaxed"><?php echo $rows['Description'];?> </p>
          <form action="" method="POST" class="form-floating">
            <input type="text" style="width:300px;margin-top:10px;" class="form-control" name="quantity" id="floatingInput" placeholder="eg:50">
            <label for="floatingInput" style="">Enter Quantity</label>
         <div class="row">
            <div class="col-6">
              <button name="submit" type="submit" value="ProductView.php?proid=<?php echo $rows['Product_ID'];?>" style="margin-top:10px;" class="prod-button flex ml-auto text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Buy</button>
            </div>
            <div class="col-6">
              <button style="margin-top:10px;" class="flex ml-auto bg-green-500 text-white  border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Add to cart</button>
            </div>
         </div> 
         </form>       
         
         <!-- <div class="row button-cls">
            <div class="col-6">
            <button style="border-color: #48bb78" type="button" class="btn btn-block btn-primary bg-green-500">Buy</button>
            </div>
          </div> -->
        </div>
<?php } ?>
    </div>
  </div>
</section>

<!--Footer-->
<footer class="text-gray-600 body-font">
    <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
      <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">© 2020 FarmerConsumerInfoTech —
        <a class="text-gray-600 ml-1" rel="noopener noreferrer" target="_blank">Build by Auora dev team</a>
      </p>
      <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
        <a class="text-gray-500">
          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
          </svg>
        </a>
        <a class="ml-3 text-gray-500">
          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
          </svg>
        </a>
        <a class="ml-3 text-gray-500">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
          </svg>
        </a>
        <a class="ml-3 text-gray-500">
          <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
            <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
            <circle cx="4" cy="4" r="2" stroke="none"></circle>
          </svg>
        </a>
      </span>
    </div>
  </footer>
</body>

<?php

mysqli_close($con);
?>

</html>
