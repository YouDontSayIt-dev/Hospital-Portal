<?php

include("../dist/backend files/connection.php");
include("../dist/backend files/functions.php");

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Commissioner&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/favicon.png" type="image/x-icon">
</head>
<body class="bg-custom-color p-0 m-0 font-Commissioner flex-nowrap">
    <div class="flex">
        <!-- SIDEBAR NAV -->
        <div class="sticky hidden lg:block lg:w-[172px] lg:h-screen bg-side-navbar rounded-tr-3xl rounded-br-3xl">
            <!-- logo -->
            <img src="../assets/logo.png" alt="logo" class="mx-auto pt-[34px]">

            <!-- nav -->
            <!-- HEALTH BOARD  -->
            <a href="../dist/health-board.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] bg-white rounded-3xl mx-auto mt-[61px] justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/health-board-active.png" alt="health-board-active">
                    <h1 class="text-side-navbar-active-text">Health Board</h1> 
                </div>
            </a>

            <!-- MEDICINE  -->
            <a href="../dist/user-medication.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/medicine.png" alt="medicine">
                    <h1 class="text-white">Medicine</h1> 
                </div>
            </a>
            
            <!-- APPOINTMENT  -->
            <a href="../dist/user-appoitment.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/appointment.png" alt="appointment">
                    <h1 class="text-white">Appointment</h1> 
                </div>
            </a>

            <!-- MESSAGE  -->
            <!-- <a href="../dist/user-message.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/message.png" alt="message">
                    <h1 class="text-white">Message</h1> 
                </div>
            </a> -->
           
            <!-- FINANCE  -->
            <a href="../dist/user-finance.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/finance.png" alt="finance">
                    <h1 class="text-white">Finance</h1> 
                </div>
            </a>    
        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-col flex-grow lg:ml-[60px]">
            <!-- TOP ITEMS (USER-DROPDOWN) -->
            <div class="flex justify-end">
                <!-- USER PROFILE -->
                <div id="dropdown-button" class=" mr-3 mt-6 z-50">
                    <button class="flex flex-row lg:w-28 lg:h-12 bg-white justify-center rounded-3xl items-center">
                        <img src="../assets/profilesample.jpg" alt="profile pic" class="rounded-full w-10 h-10">
                        <img id="dropdown-arrow" src="../assets/arrow.png" alt="dropdown-arrow" class="hidden md:block md:mx-2 lg:ml-7 rotate-180">
                    </button>
                    <!--profile dropdown-->
                    <ul id="dropdown-menu" class="absolute hidden w-40 right-3 mt-1">
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-t-md"
                                href="user-profile.php">Profile</a></li>
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap"
                                href="user-change-pass.php">Change Password</a></li>
                        <hr>
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-b-md"
                                href="splash.php">
                                <?session_start();unset($_SESSION);
                        session_destroy();session_write_close();header('Location: splash.php');die;?>Log out
                            </a></li>
                    </ul>
                </div>


            </div>

            <!-- MAIN CONTENT -->
            <div class="flex flex-col">
                <div class="mt-4">
                    <h1 class="text-3xl text-sidebar-text-bold">Personal Data</h1>
                </div>

                <form action="./backend files/user-profile-update.php?" method="post">
                    <!-- PROFILE BOX  -->
                    <div class="flex flex-col w-[90%] h-[830px] lg:w-[1636px] lg:h-[530px] mt-[45px] ml-5 bg-white rounded-[30px] shadow-custom">

                        <!-- The profile box includes the left items (profile, patient, name, birthdate, and sex) as well 
                        as the right items (email, mobile number, address, contact person, and contact mobile number).
                        Below the left and right items are the bottom items (honest clause and edit button). -->

                        <?php 
                            $uid = $_SESSION['userID'];

                            $query = "SELECT * FROM `user` WHERE userID=$uid;"; // change to the value of $_SESSION['userID']; 
                            $result = mysqli_query($con, $query);

                            while($row = mysqli_fetch_assoc($result)){ ?>

                        <div class="flex flex-col lg:flex-row w-full h-fit">

                            <!-- LEFT ITEMS  -->
                            <div class=" w-fit lg:w-[40%] h-[40%] lg:h-full">

                                <!-- PROFILE PIC  -->
                                <div class="w-fit h-fit ml-10 z-50">
                                    <img src="../assets/profilesample.jpg" alt="user-profile" class="ml-[100px] rounded-full w-[90px] h-[90px] lg:ml-[0px] lg:w-[203px] lg:h-[203px] -mt-8">
                                </div>

                                <!-- PATIENT NUMBER  -->
                                <div class="w-full h-fit ml-10 mt-3 lg:mt-14">
                                    <span class="text-lg text-side-navbar-active-text">Patient Number</span>

                                    <!-- PATIENT NUMBER VALUE -->
                                    <span class="text-lg font-medium lg:ml-[160px]">
                                        <?php 
                                            $len = strlen($row['userID']);
                                            if($len == 1){
                                                echo "00-000-00".$row['userID'];
                                            }
                                            else if($len == 2){
                                                echo "00-000-0".$row['userID'];
                                            }
                                            else if($len == 3){
                                                echo "00-000-".$row['userID'];
                                            }
                                        ?>
                                    </span>
                                </div>

                                <!-- NAME  -->
                                <div class="w-fit h-fit ml-10 mt-3 lg:mt-9">
                                    <span class="text-lg text-side-navbar-active-text">Name</span>

                                    <!-- NAME VALUE -->
                                    <span class="text-lg font-medium lg:ml-[244px]"><?php echo $row['first_name']." ".$row['last_name']; ?></span>
                                </div>

                                <!-- DATE OF BIRTH  -->
                                <div class="w-fit h-fit ml-10 mt-3 lg:mt-9">
                                    <span class="text-lg text-side-navbar-active-text">Date of Birth</span>

                                    <!-- DATE OF BIRTH VALUE -->
                                    <span class="text-lg font-medium lg:ml-[184px]"><?php echo date("m-d-Y", strtotime($row['birth_date'])); ?></span>
                                </div>

                                <!-- SEX  -->
                                <div class="w-fit h-fit ml-10 mt-3 lg:mt-9">
                                    <span class="text-lg text-side-navbar-active-text">Sex</span>

                                    <!-- SEX VALUE -->
                                    <span class="text-lg font-medium lg:ml-[260px]"><?php echo $row['gender']; ?></span>
                                </div>
                                
                            </div>

                            <!-- RIGHT ITEMS  -->
                            
                            <div class="w-fit lg:w-[60%] h-[40%] lg:h-full lg:mt-10 mt-5">
                                <!-- EMAIL -->
                                <div class="flex flex-row w-fit h-fit ml-10 mt-3 lg:mt-14 justify-center lg:items-center">
                                    <span class="text-lg text-side-navbar-active-text mr-6 lg:mr-0">Email</span>

                                    <!-- EMAIL VALUE -->
                                    <!-- <span class="text-lg font-medium ml-[200px]">janedoe@google.com</span> -->
                                    <input
                                        class="w-[250px] h-[28px] lg:w-[500px] lg:h-[42px] ml-[10px] lg:ml-[200px] pl-10 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                        type="email"
                                        name="email-edit"
                                        placeholder="<?php echo $row['email']; ?>"
                                        value="<?php echo $row['email']; ?>"
                                    >
                                </div>

                                <!-- MOBILE NUMBER  -->
                                <div class="flex flex-row justify-center lg:items-center w-fit h-fit ml-10 mt-3 lg:mt-9">
                                    <span class="text-lg text-side-navbar-active-text">Mobile Number</span>

                                    <!-- MOBILE NUMBER VALUE -->
                                    <!-- <span class="text-lg font-medium ml-[118px]">0999 0000 000</span> -->
                                    <input
                                        class="w-[250px] h-[28px] lg:w-[500px] lg:h-[42px] lg:ml-[118px] pl-10 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                        type="text"
                                        name="mobile-edit"
                                        placeholder="<?php echo $row['contact_number']; ?>"
                                        value="<?php echo $row['contact_number']; ?>"
                                    >
                                </div>

                                <!-- ADDRESS  -->
                                <div class="w-fit h-fit ml-10 mt-3 lg:mt-9">
                                    <span class="text-lg text-side-navbar-active-text">Address</span>

                                    <!-- ADDRESS VALUE -->
                                    <!-- <span class="text-lg font-medium ml-[180px]">1016 Anonas, Sta. Mesa, Maynila, Kalakhang Maynila</span> -->
                                    <input
                                        class="w-[250px] h-[28px] lg:w-[500px] lg:h-[42px] lg:ml-[176px] pl-10 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                        type="text"
                                        name="address-edit"
                                        placeholder="<?php echo $row['address']; ?>"
                                        value="<?php echo $row['address']; ?>"
                                    >
                                </div>

                                <!-- CONTACT PERSON  -->
                                <div class="flex flex-row justify-center lg:items-center w-fit h-fit ml-10 mt-3 lg:mt-9">
                                    <span class="text-lg text-side-navbar-active-text">Contact Person</span>

                                    <!-- CONTACT PERSON VALUE -->
                                    <!-- <span class="text-lg font-medium ml-[120px]">John Doe</span> -->
                                    <input
                                        class="w-[250px] h-[28px] lg:w-[500px] lg:h-[42px] lg:ml-[120px] pl-10 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                        type="text"
                                        name="contact-person-edit"
                                        placeholder="<?php echo $row['family']; ?>"
                                        value="<?php echo $row['family']; ?>"
                                    >
                                </div>

                                <!-- CONTACT MOBILE NUMBER  -->
                                <div class="flex flex-row justify-center lg:items-center w-fit h-fit ml-10 mt-3 lg:mt-9">
                                    <span class="text-lg text-side-navbar-active-text">Contact Mobile No.</span>

                                    <!-- CONTACT MOBILE VALUE -->
                                    <!-- <span class="text-lg font-medium ml-[88px]">0999 0000 000</span> -->
                                    <input
                                        class="w-[250px] h-[28px] lg:w-[500px] lg:h-[42px] lg:ml-[88px] pl-10 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                        type="text"
                                        name="contact-mobile-edit"
                                        placeholder="<?php echo $row['family_number']; ?>"
                                        value="<?php echo $row['family_number']; ?>"
                                    >
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        
                        <!-- BOTTOM ITEMS  -->
                        <div class="flex flex-col lg:flex-row lg:w-fit lg:h-20 ml-10 mt-2 lg:-mt-5">
                            <div class="flex flex-row w-[90%]">
                                <img src="../assets/Rectangle-yellow.png" alt="honest-clause" class="w-1 h-10 mt-5">
                                <span class="mt-7 ml-2 italic">I hereby certify that all the information provided are true and correct to the best of my knowledge.</span>
                            </div>
                            <div class="flex justify-end mr-5">
                                <!-- CANCEL BTN  -->
                                <a href="user-profile.php" class="flex w-[90px] h-[45px] mt-3 lg:ml-[600px] justify-center items-center rounded-3xl shadow-custom hover:scale-105 transform transition-transform duration-300">
                                    <span class=" text-gray-text text-lg">Cancel</span>
                                </a>
                                
                                <!-- SAVE BTN  -->
                                <input type="submit" name="submit" value="Save" class="text-gray-text text-lg w-[90px] h-[45px] bg-save-button mt-3 ml-[30px] justify-center items-center rounded-3xl shadow-custom hover:cursor-pointer hover:scale-105 transform transition-transform duration-300">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    
    <script src="./JS animations/profile-dropdown.js"></script>
</body>
</html>