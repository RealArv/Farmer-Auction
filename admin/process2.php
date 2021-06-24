<?php

session_start();

$mysqli = new mysqli('localhost','root','','hackathon') or die(mysqli_error($mysqli));

$id=0;
$edit= false;
$user='';

if(isset($_GET['delete'])){
    $id= $_GET['delete'];


    $mysqli->query("delete from farmerdetails where FarmerID=$id") or die($mysqli->error);

    
    $_SESSION['message'] = "record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: farm.php");

}


if(isset($_GET['verify'])){
    $id= $_GET['verify'];

    $mysqli->query("update farmerdetails set status='Verified' where FarmerID=$id") or 
                die ($mysqli->error);
    
    $_SESSION['message'] = "record has been updated!";
    $_SESSION['msg_type'] = "success";

    header("location: farm.php");

}


if(isset($_GET['unverify'])){
    $id= $_GET['unverify'];

    $mysqli->query("update farmerdetails set status='Unverified' where FarmerID=$id") or 
                die ($mysqli->error);
    
    $_SESSION['message'] = "record has been updated!";
    $_SESSION['msg_type'] = "success";

    header("location: farm.php");

}


?>