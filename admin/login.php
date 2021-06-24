
<!-------------------------------------login admin database------------------------------->
<!---------------------------------------------------------------------------------------->
<?php
session_start();

$invalid = '';
$servername="localhost";
$username="root";
$password="";
$dbname="hackathon";
$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con)
	echo mysqli_connect_error();

if(isset($_POST['login']))
  {
	$uname=$_POST['username'];
    $passw=$_POST['password'];	
		$sql="SELECT Auser, Password FROM admin WHERE Auser='$uname'";
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0)
		{
                        $row=mysqli_fetch_assoc($result);		
			$e=$row["Auser"];
			$p=$row["Password"];
			if($uname==$e)
			{
				if($passw==$p)
				{
					$_SESSION['a']=10;
					header("location: dash.php");
				}
			}
            echo " <script> alert('incorrect username or password'); window.location.href='login.php';</script>";
		}	
            
	}		

mysqli_close($con);

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Easiest Way to Add Input Masks to Your Forms</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
    <div class="col-12"><h1 style="font-weight:400;">Admin Login</h1></div><hr>

    <form method="post">
              <div class="form-group first">
                <label style="color: rgb(70, 60, 60);" for="username">Username</label>
                <input style="background-color: #f3ecec;" type="text" class="form-control" name="username" required>

              </div>
              <div class="form-group last mb-3">
                <label style="color: rgb(70, 60, 60);" for="password">Password</label>
                <input style="background-color: #f3ecec;"type="password" class="form-control" name="password" required>
              </div>
              <input name="login"  type="submit" value="Log In" class="btn btn-block">
            </form>
    </div>
</body>
</html>
