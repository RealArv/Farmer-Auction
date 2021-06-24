<?php
    session_start();
    
    if(isset($_SESSION['a']))
    {
        
    }
    else
    {
        header("location:..\Login\ConsumerLogin.php");
    }

    $servername="localhost";
    $username="root";
    $password="";
    $dbname="hackathon";
    $con=mysqli_connect($servername,$username,$password,$dbname);
    if(!$con)
      echo mysqli_connect_error();

      $sessionProfile = $_SESSION['profile_ID'];
    
    if(!isset($_SESSION['auction'])) {
                $sql3="SELECT* FROM consumerdetails WHERE ConsumerID = '$sessionProfile'";
                $result3 = mysqli_query($con,$sql3);  
                $row3 = mysqli_fetch_assoc($result3);  
                $name=$row3["Cname"];
            } else {
                $sql3="SELECT* FROM farmerdetails WHERE FarmerID = '$sessionProfile'";
                $result3 = mysqli_query($con,$sql3);
                $row3 = mysqli_fetch_assoc($result3);
                $name=$row3["Fname"];
            }

            $sql="SELECT product.*, invoice.*, consumerdetails.* from invoice,product,consumerdetails where invoice.Farmer_ID = $sessionProfile AND invoice.Consumer_ID = consumerdetails.ConsumerID AND invoice.Product_ID = product.Product_ID";

            $result = mysqli_query($con,$sql);

            mysqli_close($con)

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Profile</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="..\Profile\css\style.css?v=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #fafafa;">
        <div class="container-fluid">
        <a href="..\Index\LandingPage.php"><img src="images/logo.png" style="width:120px;height:40px;" /></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav mr-auto">
              <a class="nav-link" href="..\Index\LandingPage.php">Home</a>
              <?php if(isset($_SESSION['auction'])){ ?>
              <a class="nav-link" href="..\Index\SellForm.php">Sell your product</a>
              <?php } ?>
              <a class="nav-link" href="..\Index\Auction.php">Auction</a>
            </div>
            <a class="nav-link" href="..\Index\Logout.php">Logout</a>
          </div>
        </div>
      </nav>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 style="font-conlour font-weight: 200">Hey <?php echo $name; ?></h3>
                <p></p>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="profile.php">Profile</a>
                </li>
                <?php if(isset($_SESSION['auction'])){ ?>
                    <li>
                        <a href="FarmerActiveOrders.php">Active orders</a>
                    </li>
                    <li class="active">
                        <a href="FarmerProductHistory.php">Product history</a>
                    </li>
                <?php } ?>
                <?php if(!isset($_SESSION['auction'])){ ?>
                <li>
                    <a href="ConsumerOrders.php">Orders placed</a>
                </li>
                <?php } ?>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <div class="user-details">
                <div class="">
                <h4>History</h4>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>                                
                                <th class="table-class">Customer Name</th>
                                <th class="table-class">Product</th>
                                <th class="table-class">Product type</th>
                                <th class="table-class">Quantity bought</th>
                                <th class="table-class">Total price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['Cname']; ?></td>
                                <td><?php echo $row['Name']; ?></td>
                                <td><?php echo $row['Type']; ?></td>
                                <td><?php echo $row['Quantity']; ?></td>
                                <td><?php echo $row['TotalPrice']; ?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>