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
	
		if(isset($_POST['submit0']))
		{
		$pname=$_POST['pname'];
		$type=$_POST['type'];
		$price=$_POST['price'];
		$stock=$_POST['stock'];
		$des=$_POST['description'];
		
		//for image
		$imname = $_FILES["imfile"]["name"];
		$tmpimname = $_FILES["imfile"]["tmp_name"];
		$path="images/".$imname;
		$img1=$path;
		move_uploaded_file($tmpimname, $path);
		
		//farmers id
		
		$farmerid=$_SESSION['farmerid'];
		
		$sql="INSERT INTO product(Name, Type, Stock, Price, Description, Image, Farmer_ID,) VALUES ('$pname', '$type', '$stock', '$price', '$des', '$img1', '$farmerid','0')";
		if (mysqli_query($con, $sql))
		{
		header("location: LandingPage.php");
		}
		else
		{
		echo "Error: " . $sql . "<br>" . mysqli_error($con);
		}
	  }else
		  if(isset($_POST['submit1']))
		{
		$pname=$_POST['pname'];
		$type=$_POST['type'];
		$price=$_POST['price'];
		$stock=$_POST['stock'];
		$des=$_POST['description'];
		
		//for image
		$imname = $_FILES["imfile"]["name"];
		$tmpimname = $_FILES["imfile"]["tmp_name"];
		$path="images/".$imname;
		$img1=$path;
		move_uploaded_file($tmpimname, $path);
		
		//farmers id
		
		$farmerid=$_SESSION['farmerid'];
		
		$sql="INSERT INTO product(Name, Type, Stock, Price, Description, Image, Farmer_ID, AFlag) VALUES ('$pname', '$type', '$stock', '$price', '$des', '$img1', '$farmerid','1')";
		if (mysqli_query($con, $sql))
		{
		header("location: LandingPage.php");
		}
		else
		{
		echo "Error: " . $sql . "<br>" . mysqli_error($con);
		}
	  }
	 
    }
    else
    {
        header("location:..\Login\ConsumerLogin.php");
    }
	
	mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell</title>
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
        <a class="nav-link" href="..\Profile\profile.php">Profile</a>
        <a class="nav-link" href="Logout.php">Logout</a>
      </div>
    </div>
  </div>
</nav>


<!-- Sell Product-->

<link rel="stylesheet" href="css/style-2.css?v=<?php echo time(); ?>">
<div id="gridview">
<div class="heading" style="background: rgb(50, 226, 88);">Set Product Details</div>

<form method="POST" enctype="multipart/form-data" class="form-floating">
<div class="container-fluid" style="margin-top:40px;">
  <div class="row">
    <div class="col-6">
      <h4>Important Info</h4>
      <div class="FAQ">
        <p class="FAQ-p">1. You can only auction items if the quantity is more than 50kg.</p>
        <p class="FAQ-p">2. Auction Items will stay for upto 24hrs.</p>
        <p class="FAQ-p">3. If no one bids on the item, user can try again after few days.</p>
        <p class="FAQ-p">4. 3% commission will reducted for the delivery and website's maintanence. </p>
      </div>
    </div>
    <div class="col-4">
      <div class="p-3 mr-5 border bg-light">
          <div class="input-heading mb-3">
              <p>Enter product details</p>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" >Name</span>
            <input type="text" name="pname" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" >Type</span>
            <input type="text" name="type" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" >Price/Starting Bid</span>
            <input type="text" name="price" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Quantity</span>
            <input type="text" name="stock" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" >Description</span>
            <textarea type="textarea" name="description" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required></textarea>
          </div>
          <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02" name="imfile" required>
            <label class="input-group-text" for="inputGroupFile02">Upload Image</label>
          </div>
      </div>
      <button type="submit" name="submit1" class="text-white bg-indigo-600 border-0 py-2 px-6 mr-6 focus:outline-none hover:bg-red-500 rounded" style="margin-top:15px;">Auction</button>
      <button type="submit" name="submit0" class="text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded" style="margin-top:15px;">Sell</button>
    </div>
    <div  class="col-2">
      </div>
  </div>
</div>
  
</form>   

<!--sell product end here-->


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