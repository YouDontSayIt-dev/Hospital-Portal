<?php
session_start();

include("../dist/backend files/connection.php");
include("../dist/backend files/functions.php");

$user_data = check_user_login($con); //collect user data and check connection
$userID = $user_data['userID'];
$fName = $user_data['first_name'];
$lName = $user_data['last_name'];

$userName = $fName.' '.$lName;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Board</title>
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
            <a href="health-board.php">
            <img src="../assets/logo.png" alt="logo" class="mx-auto pt-[34px]">
            </a>
            <!-- nav -->
            <!-- HEALTH BOARD  -->
            <a href="health-board.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] bg-white rounded-3xl mx-auto mt-[61px] justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/health-board-active.png" alt="health-board-active">
                    <h1 class="text-side-navbar-active-text">Health Board</h1> 
                </div>
            </a>

            <!-- MEDICINE  -->
            <a href="user-medication.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/medicine.png" alt="medicine">
                    <h1 class="text-white">Medicine</h1> 
                </div>
            </a>
            
            <!-- APPOINTMENT  -->
            <a href="user-appointment.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/appointment.png" alt="appointment">
                    <h1 class="text-white">Appointment</h1> 
                </div>
            </a>

            <!-- MESSAGE  -->
            <a href="user-message.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/message.png" alt="message">
                    <h1 class="text-white">Message</h1> 
                </div>
            </a>
           
            <!-- FINANCE  -->
            <a href="user-finance.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/finance.png" alt="finance">
                    <h1 class="text-white">Finance</h1> 
                </div>
            </a>    
        </div>

        <!-- MAIN CONTENT  -->
        <div class="flex-col flex-grow lg:ml-[60px]">

            <!-- TOP ITEMS (SEARCHBAR AND USER-DROPDOWN) -->
            <div class="flex w-full justify-end">
                <!-- USER PROFILE -->
                <div id="dropdown-button" class=" mr-3 mt-6 z-50">
                    <button class="flex flex-row lg:w-28 lg:h-12 bg-white justify-center rounded-3xl items-center">
                        <img src="../assets/profilesample.jpg" alt="profile pic" class="rounded-full w-10 h-10">
                        <img id="dropdown-arrow" src="../assets/arrow.png" alt="dropdown-arrow" class="ml-7 rotate-180">
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

            <!-- MAIN CONTENT  -->
            <div class="flex flex-col">
                <!-- UPPER BOXES  -->
                <div class="flex flex-col lg:flex-row">
                    <!-- PROFILE SECTION -->
                    <a href="../dist/user-profile.php">
                        <div class="w-full h-[179px] lg:w-[483px] lg:h-[274px] mt-[20px] rounded-3xl shadow-custom lg:mr-7 hover:scale-105 transform transition-transform duration-300">
                            <?php $profile_query = "select * from patient_details where userID = '$userID'"?>
                            <?php $profile = mysqli_query($con, $profile_query) or die(mysqli_error($con));?>
                            <!-- USER NAME AND ICON  -->
                            <?php while($profile_row = mysqli_fetch_assoc($profile)){?>
                            <div class="flex flex-col justify-center items-center w-full h-[50%]">
                                <img src="../assets/profilesample.jpg" alt="user" class="absolute w-24 h-24 rounded-full -mt-[100px] left-[190px]">
                                <h1 class="mt-[60px] text-2xl"><?php echo $userName?></h1>
                                <span class="text-gray-text"><?php echo $profile_row['Age'] ?> years old</span>
                            </div>  

                            <!-- USER WEIGHT, HEIGHT, BLOOD  -->
                            <div class="flex w-full h-fit mt-5 justify-around">
                                <span class="text-side-navbar">Blood</span>
                                <span class="text-side-navbar">Height</span>
                                <span class="text-side-navbar">Weight</span>
                            </div>

                            <!-- USER WEIGHT, HEIGHT, BLOOD VALUES -->                            
                            <div class="flex w-full h-fit justify-around mt-4">
                                <span class="text-2xl"><?php echo $profile_row['Blood'] ?></span>
                                <span class="text-2xl"><?php echo $profile_row['Height'].' cm' ?></span>
                                <span class="text-2xl"><?php echo $profile_row['Weight'].' kg' ?></span>
                            </div>
                            <?php } ?>
                        </div>
                    </a>

                    <!-- DIAGNOSIS SECTION -->
                    <a href="../dist/user-medication.php">
                        <?php $illness_query = "select * from illness where userID = '$userID'"?>
                        <?php $illness = mysqli_query($con, $illness_query) or die(mysqli_error($con));?>
                        
                        <div class=" w-full h-[224px] lg:w-[638px] lg:h-[274px] mt-[20px] rounded-3xl shadow-custom lg:mr-7 overflow-auto hover:scale-105 transform transition-transform duration-300">
                            <div class="w-full h-fit my-2"><h1 class="text-start ml-5 font-medium text-side-navbar lg:text-2xl">Diagnosis</h1></div>
                            <hr>
                            
                            <div class="flex flex-row flex-wrap">
                            <?php while($ill_row = mysqli_fetch_assoc($illness)){?>
                                <!-- DIAGNOSIS BULLET POINT -->
                                <div class="flex flex-row w-[50%] h-fit mt-3">
                                    <img src="../assets/Rectangle-green.png" alt="bullet" class="h-20 ml-5 pt-3"> 
                                    <div class="w-full h-fit">
                                        <!-- DATE  -->
                                        <div class="flex flex-row w-full h-fit justify-between pt-[10px]">
                                            <span class="text-sm ml-5 text-gray-text"><?php echo $ill_row['date'] ?></span>
                                        </div>
    
                                        <!-- DIAGNOSIS  -->
                                        <div class="flex flex-row w-full h-fit justify-between">
                                            <span class="text-3xl ml-5"><?php echo $ill_row['Illness'] ?></span>
                                        </div>
            
                                        <!-- STATUS -->
                                        <div class="flex flex-row w-full h-fit justify-between">
                                            <span class="text-sm ml-5 text-gray-text"><?php echo $ill_row['status'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php }?> 
                            </div>
                        </div>
                    </a>
                    
                    <!-- NOTES SECTION -->
                    <div class="w-full h-[112px] lg:w-[451px] lg:h-[274px] mt-[20px] rounded-3xl shadow-custom lg:mr-7 overflow-auto z-30 hover:scale-105 transform transition-transform duration-300">
                        <?php $note_query = "select * from notes where userID = '$userID'"?>
                        <?php $note = mysqli_query($con, $note_query) or die(mysqli_error($con));?>
                        <div class="w-full h-fit my-2">
                            <h1 class="text-start ml-5 font-medium text-side-navbar lg:text-2xl">Notes</h1>
                        </div>
                        <hr>
                        <?php while($note_row = mysqli_fetch_assoc($note)){?>
                        <!-- NOTE BULLET POINT -->
                        <div class="flex flex-row w-full h-fit pb-3">
                            <img src="../assets/bullet-point.png" alt="bullet" class="mt-[35px] ml-5 w-3 h-3"> 
                            
                            <div class="w-full h-fit">
                                <!-- NOTE  -->
                                <div class="flex flex-row w-full h-fit">
                                    <span class="text-sm mr-5 mt-[26px] pl-5 text-justify"><?php echo $note_row['notes'] ?></span>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                
                <!-- LOWER BOXES  -->
                <div class="hidden lg:flex flex-col lg:flex-row">
                    <!-- NOTIFICATIONS SECTION -->
                    <div class="w-full h-[282px] lg:w-[483px] lg:h-[515px] mt-[18px] rounded-3xl shadow-custom lg:mr-7 overflow-auto hover:scale-105 transform transition-transform duration-300">
                        <?php $meds_query = "select * from medication where userID = '$userID'"?>
                        <?php $meds = mysqli_query($con, $meds_query) or die(mysqli_error($con));?>
                        <div class="w-full h-fit my-2"><h1 class="text-start ml-5 font-medium text-side-navbar lg:text-2xl">Notifications</h1></div>
                        <hr>
                        <?php while($meds_row = mysqli_fetch_assoc($meds)){?>
                        <!-- MEDICINE BULLET POINT -->
                        <div class="flex flex-row w-full h-[130px]">
                            <img src="../assets/bullet-point.png" alt="bullet" class="mt-[35px] ml-5 w-5 h-5"> 
                            <div class="w-full h-fit">
                                <!-- MEDICINE  -->
                                <div class="flex flex-row w-full h-fit justify-between">
                                    <span class="text-3xl ml-5 mt-[27px]"><?php echo $meds_row['medicine'] ?></span>
                                    <span class="text-xl mr-5 mt-[32px]"><?php echo $meds_row['dosage'] ?></span>
                                </div>
    
                                <!-- SCHEDULE  -->
                                <div class="flex flex-row w-full h-fit justify-between">
                                    <span class="text-base ml-5 text-gray-text"><?php echo $meds_row['notes'] ?></span>
                                </div>

                                <!-- REPITITIONS  -->
                                <div class="flex flex-row w-full h-fit justify-between">
                                    <span class="text-base ml-5 text-side-navbar"><?php echo $meds_row['schedule'] ?></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <?php } ?> 
                    </div>

                    <!-- APPOINTMENTS SECTION -->
                    <div class="w-full h-[189px] lg:w-[471px] lg:h-[515px] mt-[18px] rounded-3xl shadow-custom lg:mr-7 overflow-auto hover:scale-105 transform transition-transform duration-300">
                        <?php $apmt_query = "select * from appointment where userID = '$userID'"?>
                        <?php $apmt = mysqli_query($con, $apmt_query) or die(mysqli_error($con));?>
                        
                        <div class="w-full h-fit my-2"><h1 class="text-start ml-5 font-medium text-side-navbar lg:text-2xl">Appointments</h1></div>
                        <hr>
                        
                        <?php while($apmt_row = mysqli_fetch_assoc($apmt)){?>
                       
                           
                        <!-- APPOINTMENT BULLET POINT  -->
                        <div class="flex flex-col w-full h-fit pb-2">
                            <div class="flex flex-row w-full h-fit">
                                <img src="../assets/profilesample.jpg" alt="doctor's_profile" class="w-20 h-20 rounded-full ml-5 mt-5">
                                <!-- DOCTOR'S DETAILS  -->
                                <div class="flex flex-col w-full h-fit mt-7">
                                    <span class="text-2xl ml-5"><?php echo $apmt_row['doctorName']?></span>
                                    <span class="text-sm ml-5 text-gray-text"><?php echo $apmt_row['specialty'] ?></span>
                                </div>
                            </div>
                            <!-- APPOINTMENT'S DETAILS  -->
                            <div class="flex flex-col w-full h-fit">
                                <div class="flex flex-row w-full h-fit mt-2 justify-between">
                                    <span class="text-2xl ml-10"></span>
                                    <span class="text-sm mr-10 mt-2 text-gray-text">Clinic Consultation</span>
                                </div> 
                                
                                <!-- DATE AND TIME  -->
                                <div class="flex flex-row w-full h-fit justify-between">
                                    <span class="text-sm ml-10 mt-1 text-side-navbar">Date</span>
                                    <span class="text-sm mr-32 mt-1 text-side-navbar">Time</span>
                                </div>

                                <!-- DATE AND TIME VALUES -->
                                <div class="flex flex-row w-full h-fit justify-between">
                                    <span class="text-2xl ml-10"><?php echo $apmt_row['date'] ?></span>
                                    <span class="text-2xl mr-auto ml-28"><?php echo $apmt_row['time'] ?></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <?php } ?>
                    </div>
                    
                    <!-- LABORATORY RESULTS SECTION -->
                    <div class="w-full h-[182px] lg:w-[620px] lg:h-[515px] mt-[18px] rounded-3xl shadow-custom lg:mr-7 overflow-auto hover:scale-105 transform transition-transform duration-300">
                        <?php $lab_query = "select * from lab_results where userID = '$userID'"?>
                        <?php $lab = mysqli_query($con, $lab_query) or die(mysqli_error($con));?>
                        <div class="w-full h-fit my-2"><h1 class="text-start ml-5 font-medium text-side-navbar lg:text-2xl">Laboratory Results</h1></div>
                        <hr>
                        <?php while($lab_row = mysqli_fetch_assoc($lab)){?>
                        <!-- LAB BULLET POINT -->
                        <div class="flex flex-row w-full h-[130px]">
                            <img src="../assets/Rectangle-green.png" alt="bullet" class="mt-[35px] ml-5"> 
                            <div class="w-full h-fit">
                                <!-- DATE  -->
                                <div class="flex flex-row w-full h-fit justify-between pt-[32px]">
                                    <span class="text-sm ml-5 text-gray-text"><?php echo $lab_row['date'] ?></span>
                                </div>

                                <!-- LAB TEST  -->
                                <div class="flex flex-row w-full h-fit justify-between">
                                    <span class="text-3xl ml-5"><?php echo $lab_row['lab_test'] ?></span>
                                    <span class="text-2xl mr-5 text-side-navbar"><?php echo $lab_row['lab_result'] ?></span>
                                </div>
    
                                <!-- NORMAL RANGE  -->
                                <div class="flex flex-row w-full h-fit justify-between">
                                    <span class="text-sm ml-5 text-gray-text">Normal Range:</span>
                                </div>
                                
                                <!-- NORMAL RANGE VALUE  -->
                                <div class="flex flex-row w-full h-fit justify-between">
                                    <span class="text-sm ml-5 text-gray-text"><?php echo $lab_row['normal_range'] ?></span>
                                </div>
                            </div>
                        </div>
                        <?php } ?> 
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <script src="../dist/JS animations/profile-dropdown.js"></script>
</body>
</html>
