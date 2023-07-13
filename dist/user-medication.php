<?php 
session_start();

require_once("../dist/backend files/connection.php");
require_once("../dist/backend files/functions.php");

$user_data = check_login($con);
$user_id = $user_data['userID'];
$doctor_id = $user_data['doctorID'];
$query = "select * from illness where userID = '$user_id'";
$result = mysqli_query($con, $query);

        $docName = $_COOKIE['docName'];
        $illnessName = $_COOKIE['illnessName'];
        echo $docName;
        echo $illnessName;
        // echo $value;  // Retrieve the value from the cookie
        // Use the $value variable in your PHP code
        $highlight_query = "select * from medication where userID = '$user_id' and doctorID = '$docName'";
        $highlight_result = mysqli_query($con, $highlight_query);

        $doctor_query = "select * from admin where doctorID = '$docName'";
        $doctor_result = mysqli_query($con, $doctor_query);
        
        $medicine_query = "select * from medication where userID = '$user_id' and doctorID = '$docName' and illnessID = '$illnessName'";
        $medicine_result = mysqli_query($con, $medicine_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine</title>
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
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl mx-auto mt-[61px] justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/health-board.png" alt="health-board-active">
                    <h1 class="text-white">Health Board</h1> 
                </div>
            </a>

            <!-- MEDICINE  -->
            <a href="user-medication.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] bg-white rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/medicine-active.png" alt="medicine">
                    <h1 class="text-side-navbar-active-text">Medicine</h1> 
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

        <!-- MAIN CONTENT -->
        <div class="flex-col flex-grow lg:ml-[60px]">
            <!-- TOP ITEMS (USER-DROPDOWN) -->
            <div class="flex justify-end">
                <!-- USER PROFILE -->
                <div id="dropdown-button" class="mr-3 mt-6 z-50"> 
                    <button class="flex flex-row lg:w-28 lg:h-12 bg-white justify-center rounded-3xl items-center"> 
                        <img src="../assets/profilesample.jpg" alt="profile pic" class="rounded-full lg:w-10 lg:h-10"> 
                        <img id="dropdown-arrow" src="../assets/arrow.png" alt="dropdown-arrow" class="ml-7 rotate-180">
                    </button> 
                    <!--profile dropdown-->                
                    <ul id="dropdown-menu" class="absolute hidden w-40 right-3 mt-1"> 
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-t-md" href="user-profile.php">Profile</a></li> 
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap" href="user-change-pass.php">Change Password</a></li> 
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
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-t-md"href="user-profile.php">Profile</a></li> 
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap" href="user-change-pass.php">Change Password</a></li> 
                        <hr>
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-b-md" href="splash.php"><?session_start();unset($_SESSION);
                        session_destroy();session_write_close();header('Location: splash.php');die;?>Log out</a></li> 
                    </ul>
                </div>
            </div>
            
            <!-- MAIN CONTENT -->
            <div class="flex flex-row w-fit">
                <!-- MEDICATION LIST -->
                <div class="w-[600px] h-[820px] overflow-auto">
                    <div class="mb-7 ml-4">
                        <h1 class="text-3xl text-sidebar-text-bold">Medication</h1>
                    </div>

                    <!-- MEDICATION BOXES UN-ORDERED LIST -->
                    <ul id="medicationList" class="space-y-5">
                        <li>
                            <?php while($row = mysqli_fetch_assoc($result)){?>
                            <!-- MEDICATION BOXES  -->
                            <!-- All medication boxes have an inactive default background color  -->
                            <!-- When clicked, the background color changes to active  -->
                            <div id="click-medicine" name=<?php echo $row['doctorID'] ?> class="item w-[483px] h-[120px] bg-background-inactive cursor-pointer shadow-custom ml-4 rounded-3xl mb-5">
                                <!-- FOR AND DATE  -->
                                <div name=<?php echo $row['illnessID'] ?> class="flex flex-row justify-between ml-7 mr-7 pt-4">
                                    <span class="text-side-navbar-active-text text-lg">FOR</span>
                                    <span id="click-date"  class="text-lg text-gray-text"><?php echo $row['date'] ?></span>
                                </div>

                                <!-- ILLNESS  -->
                                <div name=<?php echo $row['illnessID'] ?> class="flex flex-row justify-between ml-7 mr-7">
                                    <span id="click-illness" class="text-3xl"><?php echo $row['Illness'] ?></span>
                                </div>

                                <!-- PRESCRIBED BY  -->
                                <div name=<?php echo $row['illnessID'] ?> class="flex flex-row justify-between ml-7 mr-7">
                                    <span id="click-notes" class="text-xl text-gray-text"><?php echo $row['notes'] ?></span>
                                </div>
                            </div>
                            <?php ;} ?>
                        </li>
                    </ul>                
                </div>

                <!-- MEDICATION DETAILS -->
                <div class="flex flex-col w-[1050px] h-[800px] rounded-xl bg-white mt-5 shadow-custom">
                    <!-- DOCTOR'S DETAILS  -->
                    <div class="flex flex-row items-center">
                        <?php while($highlight_row = mysqli_fetch_assoc($highlight_result)){
                            while($doctor_row = mysqli_fetch_assoc($doctor_result)){
                            ?>
                            <img src="../assets/doctor-sample.png" alt="doctor" class="w-20 h-20 rounded-full mt-5 ml-5">
                            <div class="flex w-full justify-between">
                                <!-- DOCTOR'S INFO -->
                                <div class="flex flex-col mt-4">
                                    <h1 id="display-doc" class="text-3xl"><?php echo $doctor_row['name'] ?></h1>
                                    <span id="display-spec" class="text-sm text-gray-text ml-0.5"><?php echo $doctor_row['specialty'] ?></span>
                                </div>

                                <!-- DATE INFO -->
                                <div class="flex flex-col mt-8 mr-8">
                                    <span id="display-notes" class="text-sm text-gray-text"><?php echo $highlight_row['prescription_notes'] ?></span>
                                    <span id="display-date" class="text-sm text-gray-text"><?php echo $highlight_row['prescription_date'] ?></span>
                                </div>
                            </div>
                        <?php ;} 
                        ;} ?>    
                    </div>

                    <!-- ACTUAL MEDICATION LIST (PER BOX)-->
                    <ul class="flex flex-wrap h-[600px] mx-8 overflow-auto">
                        <li>
                            <?php while($medicine_row = mysqli_fetch_assoc($medicine_result)){?>
                                <!-- MEDICATION BOX -->
                                <div class="flex w-[482px] h-[300px]">
                                    <img src="../assets/Rectangle-green.png" alt="normal" class="w-1.5 h-full py-10 ml-5">

                                    <!-- MEDICATION DETAILS -->
                                    <div class="flex flex-col mt-14">
                                        <!-- MEDICATION DETAILS -->
                                        <div class="flex flex-col w-fit h-fit ml-6 mb-12">
                                            <h1 id="display-dosage" class="text-3xl"><?php echo $medicine_row['medicine'] ?></h1>
                                            <span class="text-xl"><?php echo $medicine_row['dosage'] ?></span>
                                            <span class="text-lg text-side-navbar-active-text"><?php echo $medicine_row['schedule'] ?></span>
                                        </div>

                                        <!-- MEDICATION NOTES -->
                                        <div class="flex w-fit h-fit ml-6">
                                            <span id="display-schedule" class="text-sm"><?php echo $medicine_row['notes'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php ;} ?>
                        </li>
                        
                        <li>
                        </li>
                    </ul>

                    
                    <div class="flex flex-col ml-8 mt-10 mb-5">
                        <span class="text-xs text-gray-text">License No: XXXXX </span>
                        <span class="text-xs text-gray-text">PTR No: XXXXXXX </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../dist/JS animations/medicine-display.js"></script>
    <script src="../dist/JS animations/profile-dropdown.js"></script>
    <script src="../dist/JS animations/active-bg.js"></script>
</body>
</html>