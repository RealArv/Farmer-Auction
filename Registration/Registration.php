<?php
session_start();

$servername="localhost";
$username="root";
$password="";
$dbname="hackathon";
$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con)
	echo mysqli_connect_error();

    if(isset($_POST['submit']))
    {
      $uname=$_POST['uname'];
      $email=$_POST['email'];
      $passw=$_POST['password'];
      $phone=$_POST['phone'];
      $user_type=$_POST['user_type'];
      $city=$_POST['city'];
      $state=$_POST['state'];
      $address=$_POST['address'];
      // For farmer
      $kisanID=$_POST['kisanID'];

      if($user_type == 'Consumer') {
          $sql="INSERT INTO consumerdetails(Cname, Password, Address, Phone, Email, City, State) VALUES ('$uname', '$passw', '$address', '$phone', '$email', '$city', '$state')";
            if (mysqli_query($con, $sql)) {
                header("location: ..\Login\ConsumerLogin.php");
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
              }
            }
        else {
        $sql="INSERT INTO farmerdetails(Fname, Password, Address, Phone, Email, City, State, KisanID, Status) VALUES ('$uname', '$passw', '$address', '$phone', '$email', '$city', '$state', '$kisanID', 'Unverified')";
            if (mysqli_query($con, $sql)) {
                header("location: ..\Login\FarmerLogin.php");
                
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
                }
            }
      }		
  
  mysqli_close($con);
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">
        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="post" action="" class="signup-form">
                        <h2 class="form-title">Create an account</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="uname" id="name" placeholder="Name"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Email"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-input" name="phone" id="phone" placeholder="Phone number"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="address" id="address" placeholder="House No, Locality, Area"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="city" id="city" placeholder="City"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="state" id="state" placeholder="State"/>
                        </div>
                        <div class="form-group">
                            <label for="user-type" class="label-user-type"><span>User Type</span></label>
                            <input type="radio" name="user_type" id="Farmer" value="Farmer" onclick = "RadioFunction()" /><label for="user-type">Farmer</label>
                            <input type="radio" name="user_type" id="Consumer" value="Consumer" onclick = "RadioFunction()"  /><label for="user-type">Consumer</label>
                        </div>
                        <div hidden id="FarmerDiv">
                            <div style="margin-top: 10px;" class="form-group">
                                <input type="text" class="form-input" name="kisanID" id="farmer_ID" placeholder="Kisan ID"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="form-submit"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Already have an account? <a href="..\Login\ConsumerLogin.php" class="loginhere-link ">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function RadioFunction() {
            var x = document.getElementById("FarmerDiv");
            var y = document.getElementById("Farmer");
            FarmerDiv.style.display = Farmer.checked ? "block" : "none";

            var x = document.getElementById("ConsumerDiv");
            var y = document.getElementById("Consumer");
            ConsumerDiv.style.display = Consumer.checked ? "block" : "none";
        }
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>

