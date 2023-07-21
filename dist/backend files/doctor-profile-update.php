<?php

include("connection.php");
include("functions.php");
session_start();

if(isset($_POST["submit"])){
    $uid =  $_SESSION['doctorID'];; // change to $_SESSION['userID'];
    // echo $_POST["email-edit"];
    // echo $_POST["mobile-edit"];
    // echo $_POST["address-edit"];

    $email = $_POST["email-edit"];
    $mobile = $_POST["mobile-edit"];
    $address = $_POST["address-edit"];

    $query = "UPDATE `admin` set email = '".$email."', mobile_number = '".$mobile."', address = '".$address."' where doctorID='".$uid."';";
    $result = mysqli_query($con, $query);
    
    if($result)
    {
        header("location:../doctor-profile.php");
    }
    else{
        header("location:../doctor-profile-edit.php?update error");
    }
    
}

