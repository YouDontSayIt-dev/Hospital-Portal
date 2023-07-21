<?php

include("connection.php");
include("functions.php");
session_start();

if(isset($_POST["submit"])){
    $uid = $_SESSION['userID'];
    // echo $_POST["email-edit"];
    // echo $_POST["mobile-edit"];
    // echo $_POST["address-edit"];
    // echo $_POST["contact-person-edit"];
    // echo $_POST["contact-mobile-edit"];

    $email = $_POST["email-edit"];
    $mobile = $_POST["mobile-edit"];
    $address = $_POST["address-edit"];
    $family = $_POST["contact-person-edit"];
    $familyno = $_POST["contact-mobile-edit"];

    $query = "UPDATE user set email = '".$email."', contact_number = '".$mobile."', address = '".$address."', family = '".$family."',  family_number = '".$familyno."' where userID='".$uid."';";
    $result = mysqli_query($con, $query);
    
    if($result)
    {
        header("location:../user-profile.php");
    }
    else{
        header("location:../user-profile-edit.php?update error");
    }
    
}

