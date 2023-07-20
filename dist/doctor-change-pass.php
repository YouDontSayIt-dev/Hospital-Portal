<?php 
session_start();

include("../dist/backend files/connection.php");
include("../dist/backend files/functions.php");

if(isset($_POST['submit'])){
    if(isset($_POST['old-password']) && isset($_POST['new-password']) && isset($_POST['confirm-new-password'])){
        $op = $_POST['old-password'];
	    $np = $_POST['new-password'];
	    $c_np = $_POST['confirm-new-password'];

        if(empty($op)){
            echo "Old Password is required";
    }else if(empty($np)){
            echo "New Password is required";
    }else if($np !== $c_np){
        echo "Confirmation password  does not match";
    }else{

        $id = $_SESSION['doctorID'];
        $query = "SELECT password FROM admin WHERE doctorID = '$id' AND password = '$op'";
        $result = mysqli_query($con, $query);


        if($result){
            if($result && mysqli_num_rows($result) > 0){
                $query_2 = "UPDATE admin SET password = '$np' WHERE doctorID = '$id'";
                mysqli_query($con, $query_2);
                echo "Password has been changed successfully";
            }else {
                echo "Incorrect password";
            }
        }
    }


    }

}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Commissioner&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/favicon.png" type="image/x-icon">
</head>

<body class="bg-custom-color p-0 m-0 font-Commissioner flex-nowrap">
    <div class="flex">
        <!-- SIDEBAR NAV -->
        <div class="sticky hidden lg:block lg:w-[172px] lg:h-screen">
            <!-- logo -->
            <a href="doctor-patient-file.php">
            <img src="../assets/logo.png" alt="logo" class="mx-auto pt-[34px]">
            </a>
        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-col flex-grow lg:ml-[60px]">
        <div class="flex-col flex-grow lg:ml-[60px]">
            <!-- TOP ITEMS (USER-DROPDOWN) -->
            <div class="flex justify-end">
                <!-- USER PROFILE -->
                <div id="dropdown-button" class="mr-3 mt-6 z-50"> 
                    <button class="flex flex-row lg:w-28 lg:h-12 bg-white justify-center rounded-3xl items-center"> 
                        <img src="../assets/doctor-sample.png" alt="profile pic" class="rounded-full lg:w-10 lg:h-10"> 
                        <img id="dropdown-arrow" src="../assets/arrow.png" alt="dropdown-arrow" class="ml-7 rotate-180">
                    </button> 
                    <!--profile dropdown-->                
                    <ul id="dropdown-menu" class="absolute hidden w-40 right-3 mt-1"> 
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-t-md" href="doctor-profile.php">Profile</a></li> 
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap" href="doctor-change-pass.php">Change Password</a></li> 
                        <hr>
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-b-md" href="splash.php"><?session_start();unset($_SESSION);
                        session_destroy();session_write_close();header('Location: splash.php');die;?>Log out</a></li> 
                    </ul>
                </div>

                <!-- USER PROFILE MOBILE  -->
                <div id="dropdown-button" class="lg:hidden mr-3 mt-6 rounded-lg"> 
                    <button class=""> 
                        <img src="../assets/profilesample.jpg" alt="profile pic" class="rounded-full w-7 h-7 lg:w-10 lg:h-10"> 
                    </button> 
                    <!-- profile dropdown -->
                    <ul id="dropdown-menu" class="absolute hidden w-40 right-3 mt-1"> 
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-t-md"href="doctor-profile.php">Profile</a></li> 
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap" href="doctor-change-pass.php">Change Password</a></li> 
                        <hr>
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-b-md" href="splash.php"><?session_start();unset($_SESSION);
                        session_destroy();session_write_close();header('Location: splash.php');die;?>Log out</a></li> 
                    </ul>
                </div>
            </div>

            <!-- MAIN CONTENT -->
            <div class="flex flex-col">
                <!-- TOP CONTENT  -->
                <div class="mt-4">
                    <h1 class="text-3xl text-sidebar-text-bold">Change Password</h1>
                </div>

                <!-- CHANGE PASSWORD BOX  -->
                <div class="flex flex-col w-[1636px] h-[310px] mt-[45px] bg-white rounded-[30px] shadow-custom">
                
                <form method="post">
                
                    <!-- OLD PASSWORD -->
                    <div class="flex flex-row justify-center items-center w-fit h-fit ml-10 mt-9">
                        <span class="text-lg text-side-navbar-active-text">Old Password</span>

                        <!-- OLD PASSWORD INPUT -->
                        <input
                            class="w-[774px] h-[42px] ml-[88px] pl-10 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                            type="password"
                            name="old-password"
                            placeholder=""
                        >
                    </div>

                    <!-- NEW PASSWORD -->
                    <div class="flex flex-row justify-center items-center w-fit h-fit ml-10 mt-9">
                        <span class="text-lg text-side-navbar-active-text">New Password</span>

                        <!-- NEW PASSWORD INPUT -->
                        <input
                            class="w-[774px] h-[42px] ml-[80px] pl-10 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                            type="password"
                            name="new-password"
                            placeholder=""
                        >
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="flex flex-row justify-center items-center w-fit h-fit ml-10 mt-9">
                        <span class="text-lg text-side-navbar-active-text">Confirm Password</span>

                        <!-- CONFIRM PASSWORD INPUT -->
                        <input
                            class="w-[774px] h-[42px] ml-[50px] pl-10 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                            type="password"
                            name="confirm-new-password"
                            placeholder=""
                        >
                    </div>

                    <!-- BOTTOM ITEMS  -->
                    <div class="flex w-fit h-20 ml-10">
                        <!-- CANCEL BTN  -->
                        <a href="#">
                            <button class="flex w-[90px] h-[45px] mt-3 ml-[1350px] justify-center items-center rounded-3xl shadow-custom hover:scale-105 transform transition-transform duration-300">
                                <span class=" text-gray-text text-lg">Cancel</span>
                            </button>
                        </a>
                        
                        <!-- SAVE BTN  -->
                        <a href="#">
                            <button name="submit" type="submit" class="flex w-[90px] h-[45px] bg-save-button mt-3 ml-[30px] justify-center items-center rounded-3xl shadow-custom hover:scale-105 transform transition-transform duration-300">
                                <span name="submit" type="submit" class=" text-gray-text text-lg">Save</span>
                            </button>
                        </a>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../dist/JS animations/profile-dropdown.js"></script>
</body>

</html>