<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

    <title>Dashboard</title>
</head>
<body>
<!-------------------------------------database----------------------------->

    <?php require_once 'process.php';?>
    
    <?php
      $mysqli = new mysqli('localhost','root','','hackathon') or die(mysqli_error($mysqli));
      $result = $mysqli->query("select * from admin") or die($mysqli->error);
    ?> 

<!-------------------------------------------------------------------------->
<!----------------------------NavBar------------------------------------->

        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <img src="pic/t2.png" style="width:120px;height:40px;" />

  
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto ">
                <div class="mr-auto"><a class="nav-link" href="dash.php">Home</a></div>
                <div class="ml-auto"><a class="nav-link" href="logout.php">Logout</a></div>
            </div>
            
            </div>
        </div>
        </nav>

  <!---------------------------------------------------------------------------------------------->              

<!----------------------------DASHBOARD---------------------------------->
    <!--sidebar start-->
    <div class="sidebar">
        <center>
            <img src="pic/acc.png" class="profile_image" alt="">
            <h4>Admin</h4>
        </center>
      <a href="farm.php"><i class="fas fa-leaf"></i><span>Farmers</span></a>
      <a href="user.php"><i class="fas fa-users"></i><span>Consumers</span></a>
      <a href="prod.php"><i class="fab fa-product-hunt"></i><span>Product</span></a>
      <a href="invoice.php"><i class="fas fa-file-invoice"></i><span>Invoice</span></a>
      <a href="set.php"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
    </div>
    <!--sidebar end-->

<!----------------------------------------------------------------------->
  
<!--------------------------------admin password change details---------------------------------->
  <div class="container" >   
  
    <div class="row justify-content-center">
        <form action="process.php" method="POST">
        <div class="form-group">
        <label>Name</label>
        <input type="text" name="adminname" class="form-control" placeholder="enter name">
        </div>
        <div class="form-group">
        <label>UserName</label>
        <input type="text" name="adminuser" class="form-control"  placeholder="enter username">
        </div>
        <div class="form-group">
        <label>Old password</label>
        <input type="Password" name="adminpassword" class="form-control" placeholder="Old password">
        </div>
        <label>New password</label>
        <input type="Password" name="adminnewpassword" class="form-control"  placeholder="New password">
        </div><br>
        <div class="form-group">
            <button type="submit" name="update" class="btn btn-info">Update</button>
        </div>
        </form>
                                
  </div> 
    
<!------------------------------------------------------------------------->
</body>
</html>