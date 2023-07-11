<?php 
session_start();

include("../dist/backend files/connection.php");
include("../dist/backend files/functions.php");

$user_data = check_login($con);
$user_id = $user_data['userID'];
$query = "select * from appointment where userID = '$user_id'";
$result = mysqli_query($con, $query);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Commissioner&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/">
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
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/medicine.png" alt="medicine">
                    <h1 class="text-white">Medicine</h1> 
                </div>
            </a>
            
            <!-- APPOINTMENT  -->
            <a href="user-appointment.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] bg-white rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/appointment-active.png" alt="appointment">
                    <h1 class="text-side-navbar-active-text">Appointment</h1> 
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
                <!-- APPOINTMENT LIST -->
                <div class="w-[600px] h-[820px] overflow-auto">
                    <div class="mb-7 ml-4">
                        <h1 class="text-3xl text-sidebar-text-bold">Appointment</h1>
                    </div>

                    <!-- BUTTON FOR NEW APPOINTMENT -->
                    <button class="item flex flex-row items-center space-x-5 item w-[483px] h-[87px] bg-white cursor-pointer shadow-custom ml-4 rounded-3xl">
                        <img src="../assets/add-btn.png" alt="add-btn" class="w-[21px] h-[21px] ml-4">
                        <h1 class="text-2xl text-sidebar-text-bold font-medium">Add</h1>
                    </button>

                    <!-- APPOINTMENT BOXES UN-ORDERED LIST -->
                    <ul id="appointmentList" class="space-y-5 mt-5">
                        <li>
                            <?php while($row = mysqli_fetch_assoc($result)){?>
                                <!-- APPOINTMENT BOXES  -->
                                <!-- All appointment boxes have an inactive default background color  -->
                                <div class="item w-[483px] h-[87px] bg-background-inactive cursor-pointer shadow-custom ml-4 rounded-3xl mb-5">
                                    <!-- DOCTOR AND DATE  -->
                                    <div class="flex flex-row justify-between ml-7 mr-7 pt-4">
                                        <!-- DOCTOR  -->
                                        <span class="text-3xl"><?php echo $row['doctorName'] ?></span>
                                        <!-- DATE  -->
                                        <span class="text-lg text-appointment-date pt-1"><?php echo $row['date'] ?></span>
                                    </div>

                                    <!-- TYPE AND TIME  -->
                                    <div class="flex flex-row justify-between ml-7 mr-7">
                                        <!-- TYPE  -->
                                        <span class="text-lg text-gray-text"><?php echo $row['specialty'] ?></span>
                                        <!-- TIME  -->
                                        <span class="text-lg text-appointment-date"><?php echo $row['time'] ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </li>
                    </ul>                
                </div>

                <!-- APPOINTMENT DETAILS -->
                <div class="flex flex-col w-[1050px] h-[800px] rounded-xl bg-white mt-5 shadow-custom">
                    <!-- TOP ITEMS -->
                    <!-- THIS INCLUDES SPECIALTY, DOCTOR, THE THE CALENDAR -->
                    <div class="flex flex-row w-full h-[70%]">
                        <!-- FIRST HALF IS FOR THE DROPDOWNS  -->
                        <div class="w-[50%] h-full">
                            <!-- DOCTOR SPECIALTY  -->
                            <h1 class="mt-11 ml-10 mb-3 text-side-navbar-active-text text-2xl">Specialty</h1>
                            <?php $specialty_query = "select specialty from admin";
                            $specialty_result = mysqli_query($con, $specialty_query);
                            
                            ?>
                            <div class="relative ml-10 z-50">
                                <button id="specialtyMenu" class="w-[400px] h-10 rounded-full">
                                    <input class="w-full h-full bg-form-fill rounded-full indent-6" type="text" id="specialtyBox" placeholder="Select">
                                </button>
                                <div id="specialtyDropdown" class="hidden absolute mt-2 w-[400px] bg-white border border-gray-300 rounded-xl shadow-xl">
                                    <?php while($specialty_row = mysqli_fetch_assoc($specialty_result)){?>
                                        <a class="block px-4 py-2 hover:bg-blue-500 hover:text-white cursor-pointer" onclick="updateText"><?php echo $specialty_row['specialty'] ?></a>
                                    <?php ;} ?>
                                    </div>
                            </div>          
                            
                            <!-- DOCTOR  -->
                            <h1 class="mt-11 ml-10 mb-3 text-side-navbar-active-text text-2xl">Doctor</h1>
                            <?php $doctor_query = "select name from admin";
                            $doctor_result = mysqli_query($con, $doctor_query);?>
                            <div class="relative ml-10 z-30">
                                <button id="doctorMenu" class="w-[400px] h-10 rounded-full">
                                    <input class="w-full h-full bg-form-fill rounded-full indent-6" type="text" id="doctorBox" placeholder="Select">
                                </button>
                                <div id="doctorDropdown" class="hidden absolute mt-2 w-[400px] bg-white border border-gray-300 rounded-xl shadow-xl">
                                    <?php while($doctor_row = mysqli_fetch_assoc($doctor_result)){?>        
                                        <a class="block px-4 py-2 hover:bg-blue-500 hover:text-white cursor-pointer" onclick="updateDoctorText"><?php echo $doctor_row['name'] ?></a>
                                     <?php ;} ?>
                                </div>
                            </div>      
                        </div>

                        <!-- SECOND HALF IS FOR THE INLINE CALENDAR -->
                        <div class="w-[50%] h-full">
                            <h1 class="mt-11 mb-3 text-side-navbar-active-text text-2xl">Date</h1>
                            <!-- CALENDAR -->
                            <input type="text" id="booking-date" placeholder="Select a date" class="px-6 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- BOTTOM ITEMS -->
                    <div class="w-full h-[50%]">
                        <!-- TIME BTNS  -->
                        <div class="w-full h-[80%]">
                            <h1 class="text-side-navbar-active-text text-2xl mb-5 mx-10">Time</h1>
                            <!-- DIVISION FOR THE LIST OF THE TIME BTNS -->
                            <div class="w-full h-fit">
                                <!-- TIME BOXES LIST -->
                                <ul id="timeSlotList" class="w-full h-full flex flex-row flex-wrap space-y-5">
                                    <li>
                                        <!-- TIME SLOT BTNS -->
                                        <!-- All timeslot boxes have an inactive default background color  -->
                                        <!-- When clicked, the background color changes to active  -->
                                        <button class="time flex w-[150px] h-[45px] ml-5 mt-5 justify-center items-center rounded-3xl bg-form-fill">
                                            <span class=" text-custom-time text-lg">8:00 am</span>
                                        </button>
                                    </li>

                                    <li>
                                       <!-- TIME SLOT BTNS -->
                                        <!-- All timeslot boxes have an inactive default background color  -->
                                        <!-- When clicked, the background color changes to active  -->
                                        <button class="time flex w-[150px] h-[45px] ml-5 justify-center items-center rounded-3xl bg-form-fill">
                                            <span class=" text-custom-time text-lg">9:00 am</span>
                                        </button>
                                    </li>

                                    <li>
                                       <!-- TIME SLOT BTNS -->
                                        <!-- All timeslot boxes have an inactive default background color  -->
                                        <!-- When clicked, the background color changes to active  -->
                                        <button class="time flex w-[150px] h-[45px] ml-5 justify-center items-center rounded-3xl bg-form-fill">
                                            <span class=" text-custom-time text-lg">10:00 am</span>
                                        </button>
                                    </li>

                                    <li>
                                       <!-- TIME SLOT BTNS -->
                                        <!-- All timeslot boxes have an inactive default background color  -->
                                        <!-- When clicked, the background color changes to active  -->
                                        <button class="time flex w-[150px] h-[45px] ml-5 justify-center items-center rounded-3xl bg-form-fill">
                                            <span class=" text-custom-time text-lg">11:00 am</span>
                                        </button>
                                    </li>

                                    <li>
                                       <!-- TIME SLOT BTNS -->
                                        <!-- All timeslot boxes have an inactive default background color  -->
                                        <!-- When clicked, the background color changes to active  -->
                                        <button class="time flex w-[150px] h-[45px] ml-5 justify-center items-center rounded-3xl bg-form-fill">
                                            <span class=" text-custom-time text-lg">2:00 pm</span>
                                        </button>
                                    </li>

                                    <li>
                                       <!-- TIME SLOT BTNS -->
                                        <!-- All timeslot boxes have an inactive default background color  -->
                                        <!-- When clicked, the background color changes to active  -->
                                        <button class="time flex w-[150px] h-[45px] ml-5 justify-center items-center rounded-3xl bg-form-fill">
                                            <span class=" text-custom-time text-lg">3:00 pm</span>
                                        </button>
                                    </li>

                                    <li>
                                       <!-- TIME SLOT BTNS -->
                                        <!-- All timeslot boxes have an inactive default background color  -->
                                        <!-- When clicked, the background color changes to active  -->
                                        <button class="time flex w-[150px] h-[45px] ml-5 justify-center items-center rounded-3xl bg-form-fill">
                                            <span class=" text-custom-time text-lg">4:00 pm</span>
                                        </button>
                                    </li>

                                    <li>
                                       <!-- TIME SLOT BTNS -->
                                        <!-- All timeslot boxes have an inactive default background color  -->
                                        <!-- When clicked, the background color changes to active  -->
                                        <button class="time flex w-[150px] h-[45px] ml-5 justify-center items-center rounded-3xl bg-form-fill">
                                            <span class=" text-custom-time text-lg">5:00 pm</span>
                                        </button>
                                    </li>

                                    <li>
                                       <!-- TIME SLOT BTNS -->
                                        <!-- All timeslot boxes have an inactive default background color  -->
                                        <!-- When clicked, the background color changes to active  -->
                                        <button class="time flex w-[150px] h-[45px] ml-5 justify-center items-center rounded-3xl bg-form-fill">
                                            <span class=" text-custom-time text-lg">6:00 pm</span>
                                        </button>
                                    </li>

                                    <li>
                                       <!-- TIME SLOT BTNS -->
                                        <!-- All timeslot boxes have an inactive default background color  -->
                                        <!-- When clicked, the background color changes to active  -->
                                        <button class="time flex w-[150px] h-[45px] ml-5 justify-center items-center rounded-3xl bg-form-fill">
                                            <span class=" text-custom-time text-lg">7:00 pm</span>
                                        </button>
                                    </li>
                                </ul> 
                            </div>
                        </div>

                        <!-- CANCEL AND SUBMIT BTNS  -->
                        <div class="flex w-full h-[20%] justify-end items-center">
                            <!-- CANCEL BTN  -->
                            <a href="#">
                                <button class="flex w-[150px] h-[45px] justify-center items-center rounded-3xl shadow-custom hover:scale-105 transform transition-transform duration-300">
                                    <span class=" text-gray-text text-lg">Cancel</span>
                                </button>
                            </a>
                            
                            <!-- SAVE BTN  -->
                            <a href="#">
                                <button class="flex w-[150px] h-[45px] bg-save-button ml-[30px] mr-5 justify-center items-center rounded-3xl shadow-custom hover:scale-105 transform transition-transform duration-300">
                                    <span class=" text-gray-text text-lg" type="submit">Save</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
             
        </div>
    </div>
    <script src="../dist/JS animations/profile-dropdown.js"></script>
    <script src="../dist/JS animations/active-bg.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="../dist/JS animations/appointment-dropdown.js"></script>
    <script>
        flatpickr("#booking-date", {
            // Specify available dates (optional)
            minDate: "today",

            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",

            inline: true,

            // Additional appearance options (optional)
            mode: "single",
            allowInput: true,
        });
    </script>
</body>
</html>