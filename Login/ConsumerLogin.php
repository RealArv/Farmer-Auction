<?php 
  session_start();

  $invalid_password = "";
  $invalid_username = "";

  $servername="localhost";
  $username="root";
  $password="";
  $dbname="hackathon";
  $con=mysqli_connect($servername,$username,$password,$dbname);
  if(!$con)
    echo mysqli_connect_error();
  
    if(isset($_POST['submit']))
    {
        $email=$_POST['email'];
        $passw=$_POST['password'];
        $sql="SELECT* FROM consumerdetails WHERE Email='$email'";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result)>0)
        { 
          $row=mysqli_fetch_assoc($result);	
          $e=$row["Email"];
          $p=$row["Password"];
          $d=$row["ConsumerID"];
          if($email==$e)
          {
              if($passw==$p) {
                $_SESSION['a'] = 10;
                $_SESSION['profile_ID'] = $d;
                header('location: ..\Index\LandingPage.php');
              }
              else echo '<script>alert("Welcome to Geeks for Geeks")</script>';
            }
          else echo '<script>alert("Welcome to Geeks for Geeks")</script>';
          }
        }		
  
  mysqli_close($con);
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;1,100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Login!</title>
  </head>
  <body style="background-color: #f3ecec;">
  
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_1.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="mb-4">
              <h3>Sign In</h3>
              <p style="color: rgb(70, 60, 60);" class="mb-4 fw-normal">Login to access all the features of our website</p>
            </div>
            <form action="" method="post">
              <div class="form-group first">
                <label style="color: rgb(70, 60, 60);" for="email">E-mail</label>
                <input style="background-color: #f3ecec;" type="text" class="form-control" id="email" name="email">
                <?php echo $invalid_username; ?>
              </div>
              <div class="form-group last mb-3">
                <label style="color: rgb(70, 60, 60);" for="password">Password</label>
                <input style="background-color: #f3ecec;"type="password" class="form-control" id="password" name="password">
                <?php echo $invalid_password; ?>
              </div>

              <input style=" background-color: #6dc8d4;" type="submit" name="submit" class="btn btn-block">

              <span class="d-block text-center my-4 text-muted">&mdash; or &mdash;</span>
              
              <div class="social-login d-flex justify-content-around">
                <a href="..\Registration\Registration.php"><p style="color: black; font-weight: 400;">Sign up</p></a>
                <a href="FarmerLogin.php"><p style="color: black; font-weight: 400;">Login as a farmer</p></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    
  
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>