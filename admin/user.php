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

  <?php require_once 'process3.php';?>
        
        <?php
          $mysqli = new mysqli('localhost','root','','hackathon') or die(mysqli_error($mysqli));
          $result = $mysqli->query("select * from consumerdetails") or die($mysqli->error);
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
  
<!--------------------------------admin details---------------------------------->
  <div class="container" >  
    
    <table class="table table-striped">
  <thead>
    <tr>
    <tr>
          <th scope="col">Consumer Id</th>
          <th scopr="col">Name</th>
          <th scope="col">Address</th>
          <th scope="col">Email</th>
          <th scope="col">phone</th>
          <th colspan="1">Delete</th>
        </tr>
    </tr>
  </thead>
  <tbody>
      <?php
          while ($row= $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['ConsumerID'] ?></td>
          <td><?php echo $row['Cname'] ?></td>
          <td><?php echo $row['Address'] ?></td>
          <td><?php echo $row['Phone'] ?></td>
          <td><?php echo $row['Email'] ?></td>
          <td>
                <a href="user.php?delete=<?php echo $row['ConsumerID']; ?>"
                  class="btn btn-danger">Delete</a>
                  
          </td>
        </tr>
      <?php endwhile; ?>
  </tbody>
</table>
                                
  </div> 
    
<!------------------------------------------------------------------------->
</body>
</html>