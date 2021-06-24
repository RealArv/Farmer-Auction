<?php

session_start();

$mysqli = new mysqli('localhost','root','','hackathon') or die(mysqli_error($mysqli));

$id=0;
$edit= false;
$user='';


if(isset($_GET['delete'])){
    $id= $_GET['delete'];


    $mysqli->query("delete from invoice where Product_ID=$id") or die($mysqli->error);

    
    $_SESSION['message'] = "record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: invoice.php");

}
