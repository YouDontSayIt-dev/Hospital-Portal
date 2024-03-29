<?php

function check_user_login($con){
    if(isset($_SESSION['userID'])){
        $id = $_SESSION['userID'];
        $query = "select * from user where userID = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    // redirect to login
    header("Location: health-board.php");
    die; 
}


function check_doc_login($con){
    if(isset($_SESSION['doctorID'])){
        $id = $_SESSION['doctorID'];
        $query = "select * from admin where doctorID = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $doctor_data = mysqli_fetch_assoc($result);
            return $doctor_data;
        }
    }
    // redirect to login
    header("Location: splash.php");
    die; 
}

function check_root_login($con){
    if(isset($_SESSION['adminID'])){
        $id = $_SESSION['adminID'];
        $query = "select * from root where adminID = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $admin_data = mysqli_fetch_assoc($result);
            return $admin_data;
        }
    }
    // redirect to login
    header("Location: splash.php");
    die; 
}

function page_refresh($location){
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$location.'">';
    exit;
}

