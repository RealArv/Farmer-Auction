<?php
    session_start();
   	$servername="localhost";
    $username="root";
    $password="";
    $dbname="hackathon";
    $con=mysqli_connect($servername,$username,$password,$dbname);
    if(!$con)
      echo mysqli_connect_error();
    
      if(isset($_SESSION['a']))
      {
        $sql="SELECT product.Product_ID,product.Name,product.Price,Image,farmerdetails.City FROM product JOIN farmerdetails ON product.Farmer_ID=farmerdetails.FarmerID WHERE AFlag='0'";
        $result=mysqli_query($con,$sql);   
      }
      else  {
        header("location:..\Login\ConsumerLogin.php");
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
    <title>Home</title>
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
      <a class="nav-link" href="..\Profile\profile.php">Profile</a>
      <a class="nav-link" href="Logout.php">Logout</a>
    </div>
  </div>
</nav>

<!--Product-->
<link rel="stylesheet" href="css/style-2.css?v=<?php echo time(); ?>">
<div id="gridview">
<div class="heading" style="background: rgb(50, 226, 88);">Purchase From Here</div>

<div class="container px-4">
<form action="post">
  <div class="row gx-5">

  <div class="col">
  <select class="form-select" aria-label="Default select example">
   <option selected>Select Type</option>
   
   <option value="1">One</option>
   <option value="2">Two</option>
   <option value="3">Three</option>
  </select>
  </div>

  <div class="col">
  <select class="form-select" aria-label="Default select example">
   <option selected>Select State</option>
   
   <option value="1">One</option>
   <option value="2">Two</option>
   <option value="3">Three</option>
  </select> 
  </div>

  
  <div class="col">
    <button class="flex ml-auto text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Sort</button>
  </div>
 
 </div>
 </form>
</div>

<?php

while($rows=$result->fetch_assoc())
{
   ?>

<div class="image">
  <a href="ProductView.php?proid=<?php echo $rows['Product_ID'];?>"><img src="<?php echo $rows['Image'];?>" style="height:250px;width:250px;"/></a>
    <div class="home-product-bottom">
      <p style="text-transform: uppercase;font-weight: bold;text-align:left;"> Name:<?php echo $rows['Name'];?></p>
      <p style="text-transform: uppercase;font-weight: bold;text-align:left;"> City:<?php echo $rows['City'];?></p>	
      <p style="text-transform: uppercase;font-weight: bold;text-align:left;"> Price:<?php echo $rows['Price'];?></p>	
    </div>
</div>	
<?php
    }
	mysqli_close($con);
?>
</div>
<!--product end here-->


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
</html>