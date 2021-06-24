<?php

session_start();

$mysqli = new mysqli('localhost','root','','hackathon') or die(mysqli_error($mysqli));

$id=0;
$edit= false;
$user='';


if(isset($_GET['delete'])){
    $id= $_GET['delete'];


    $mysqli->query("delete from admin where Admin_ID=$id") or die($mysqli->error);

    
    $_SESSION['message'] = "record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: dash.php");

}

if(isset($_POST['update'])){
    $name = $_POST['adminname'];
    $user = $_POST['adminuser'];
    $pass = $_POST['adminpassword'];
    $npass = $_POST['adminnewpassword'];
    $id=$mysqli->query("select Admin_ID from admin where Password='$pass' AND Auser='$user' AND Aname='$name'");
    if(mysqli_num_rows($id)>0)
    {
        $mysqli->query("update admin set Password='$npass' where Password='$pass' AND Auser='$user' AND Aname='$name'")  or die($mysqli->error);
        $_SESSION['message'] = "record has been updated!";
        $_SESSION['msg_type'] = "success";
        header("location: set.php");
    }
    else
    {       
        header("location: set.php");
    }
}