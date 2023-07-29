<?php 
session_start();

include("../dist/backend files/connection.php");
include("../dist/backend files/functions.php");

$user_data = check_user_login($con);
$user_id = $user_data['userID'];

$query = "select * from appointment where userID = '$user_id'";
$result = mysqli_query($con, $query);

if (isset($_SESSION['docID'])){
    $docID = $_SESSION['docID'];
}else{
    $docID = 1;
}


if(isset($_POST['submit'])){
    $timeSelect = $_POST['time-select'];
    $bookingSelect = $_POST['booking-select'];
    $doctorSelect = $_POST['doctor-select'];
    $doctorID = $_POST['doctor-id'];
    $specialtySelect = $_POST['specialty-select'];
    $usernameSelect = $_POST['username'];
    $contactNumSelect = $_POST['contact-number'];
    $emailSelect = $_POST['user-email'];

    $appointment_query = "insert into appointment (userID, doctorID, date, time, doctorName, specialty, username, useremail, contactnumber, status) values ('$user_id', '$doctorID', '$bookingSelect', '$timeSelect', 
    '$doctorSelect', '$specialtySelect', '$usernameSelect', '$emailSelect', '$contactNumSelect', 'Pending')";
    $verify = mysqli_query($con, $appointment_query);
    $tc_query = "update time set status = 'disabled' where time = '$timeSelect' and doctorID = '$docID'";
    $tc_result = mysqli_query($con, $tc_query);

    if($verify){
        echo "<script>alert('Appointment booked successfully!');</script>";
    }
    else{
        echo "<script>alert('Appointment booking failed!');</script>";
    }

    //bind user to doctor
    $bind_query = "update user set doctorID = '$doctorID' where userID = '$user_id'";
    $bind_verify = mysqli_query($con, $bind_query);
    if ($bind_verify){
        echo "<script>alert('Appointment booked successfully!');</script>";
    }else{
        $new_bind_query = "insert into user (doctorID) values  ('$doctorID') where userID = '$user_id'";
        mysqli_query($con, $new_bind_query);   
    }

   
}
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
            <!-- <a href="user-message.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/message.png" alt="message">
                    <h1 class="text-white">Message</h1> 
                </div>
            </a> -->
           
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
                <div id="dropdown-button" class="lg:block hidden sm:hidden md:hidden mr-3 mt-6 z-50 "> 
                    <button class="flex flex-row lg:w-28 lg:h-12 bg-white justify-center rounded-3xl items-center"> 
                        <img src="../assets/profilesample.jpg" alt="profile pic" class="rounded-full lg:w-10 lg:h-10 lg:block sm:hidden md:hidden"> 
                        <img id="dropdown-arrow" src="../assets/arrow.png" alt="dropdown-arrow" class="ml-7 rotate-180 lg:block sm:hidden">
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
                <div id="dropdown-button" class="lg:hidden mr-3 mt-6 rounded-lg bg-red-300"> 
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
            <div class="flex flex-col lg:flex-row w-fit bg-green-200">
                <!-- APPOINTMENT LIST -->
                <div class="lg:w-[600px] lg:h-[820px] lg:overflow-auto">
                    <div class="mb-7 ml-4">
                        <h1 class="text-xl lg:text-3xl text-sidebar-text-bold">Appointment</h1>
                    </div>

                    <!-- BUTTON FOR NEW APPOINTMENT -->
                    <div class="flex-col lg:flex-row">
                    <button class="item flex lg:flex-row items-center space-x-5 item w-[318px] h-[52px] lg:w-[483px] lg:h-[87px] bg-white cursor-pointer shadow-custom mx-2 lg:ml-4 rounded-3xl " onclick="showAppointment()">
                        <img src="../assets/add-btn.png" alt="add-btn" class="w-[17px] h-[17px] lg:w-[21px] lg:h-[21px] ml-4">
                        <h1 class="text-2xl text-sidebar-text-bold font-medium">Add</h1>
                    </button>

                    <!-- APPOINTMENT BOXES UN-ORDERED LIST -->
                    <ul id="appointmentList" class="space-y-5 mt-5">
                        <li>
                            <?php while($row = mysqli_fetch_assoc($result)){?>
                                <!-- APPOINTMENT BOXES  -->
                                <!-- All appointment boxes have an inactive default background color  -->
                                <div class="item w-[318px] h-[52px] lg:w-[483px] lg:h-[123px] bg-background-inactive cursor-pointer shadow-custom mx-2 lg:ml-4 rounded-3xl mb-2 lg:mb-5">
                                    <!-- DOCTOR AND DATE  -->
                                    <div class="flex flex-row justify-between ml-7 mr-7 pt-2 lg:pt-4">
                                        <!-- DOCTOR  -->
                                        <span class="text-base lg:text-3xl"><?php echo $row['doctorName'] ?></span>
                                        <!-- DATE  -->
                                        <span class="text-base lg:text-lg text-appointment-date lg:pt-1"><?php echo $row['date'] ?></span>
                                    </div>

                                    <!-- TYPE AND TIME  -->
                                    <div class="flex flex-row justify-between ml-7 mr-7">
                                        <!-- TYPE  -->
                                        <span class="text-xs lg:text-lg text-gray-text"><?php echo $row['specialty'] ?></span>
                                        <!-- TIME  -->
                                        <span class="text-xs lg:text-lg text-appointment-date"><?php echo $row['time'] ?></span>
                                    </div>

                                    <!-- STATUS  -->
                                    <div class="flex flex-row justify-between ml-7 mr-7">
                                        <!-- STATUS  -->
                                        <span class="text-lg text-blue-text"><?php echo $row['status'] ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </li>
                    </ul>  
                    </div>              
                </div>

                <!-- APPOINTMENT DETAILS -->
                <div id="appointmentDetails" class="flex flex-col w-[318px] lg:w-[1050px] lg:h-[800px] rounded-xl bg-white mt-3 mx-2 lg:mt-5 shadow-custom">
                    <!-- TOP ITEMS -->
                    <!-- THIS INCLUDES SPECIALTY, DOCTOR, THE THE CALENDAR -->
                    <div class="flex flex-col lg:flex-row w-full h-[70%]">
                        <!-- FIRST HALF IS FOR THE DROPDOWNS  -->
                        <div class="w-[50%] h-full">
                            <!-- DOCTOR SPECIALTY  -->
                            <h1 class="mt-6 lg:mt-11 ml-8 lg:ml-10 mb-3 text-side-navbar-active-text text-sm lg:text-2xl">Specialty</h1>
                            <?php $specialty_query = "select specialty from admin";
                            $specialty_result = mysqli_query($con, $specialty_query);
                            
                            ?>
                            <div class="relative ml-2 lg:ml-10 z-50">
                                <button id="specialtyMenu" class="w-[289px] lg:w-[400px] h-10 rounded-full">
                                    <input class="w-full h-full bg-form-fill rounded-full indent-6" name="specialty-select" type="text" id="specialtyBox" placeholder="Select">
                                    <select class="hidden" name="fetchDoc" id="fetchDoc"></select>
                                </button>
                                <div id="specialtyDropdown" class="hidden absolute mt-2 w-[400px] bg-white border border-gray-300 rounded-xl shadow-xl">
                                    <?php while($specialty_row = mysqli_fetch_assoc($specialty_result)){?>
                                        <a id="specialtyInput" class="block px-4 py-2 hover:bg-blue-500 hover:text-white cursor-pointer" onclick="updateText('<?php echo $specialty_row['specialty']?>')"><?php echo $specialty_row['specialty'] ?></a>
                                    <?php ;} ?>
                                    </div>
                            </div>          
                            
                            <!-- DOCTOR  -->
                            <h1 class="mt-11 ml-8 lg:ml-10 mb-3 text-side-navbar-active-text text-sm lg:text-2xl">Doctor</h1>
                            <?php $doctor_query = "select name from admin";
                            $doctor_result = mysqli_query($con, $doctor_query);?>
                            <div class="relative ml-2 lg:ml-10 z-30">
                                <button id="doctorMenu" class="w-[289px] lg:w-[400px] h-10 rounded-full">
                                    <input class="w-full h-full bg-form-fill rounded-full indent-6" name="doctor-select" type="text" id="doctorBox" placeholder="Select">
                                </button>
                                <div id="doctorDropdown" class="hidden absolute mt-2 w-[400px] bg-white border border-gray-300 rounded-xl shadow-xl" onclick="setDate()">
                                </div>
                            </div>      
                        </div>

                        <!-- SECOND HALF IS FOR THE INLINE CALENDAR -->
                        <div class="w-[50%] h-full mx-2">
                            <h1 class="mt-6 lg:mt-11 mb-3 ml-6 lg:ml-0 text-side-navbar-active-text text-sm lg:text-2xl">Date</h1>
                            <!-- CALENDAR -->
                            <input class="hidden" id="book1"></input>
                            <input class="hidden" id="book2"></input>
                            <input class="hidden" id="book3"></input>
                            <input type="text" name="booking-date" id="booking-date" placeholder="Select a date" class="px-6 py-2 ml-4 lg:ml-0 mb-2 lg:mb-0 rounded-lg border border-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- BOTTOM ITEMS -->
                    <div class="w-full h-[50%]">
                        <!-- TIME BTNS  -->
                        <div class="w-full h-[80%] mt-8 lg:mt-0">
                            <h1 class="text-side-navbar-active-text text-sm lg:text-2xl mb-5 mx-10">Time</h1>
                            <!-- DIVISION FOR THE LIST OF THE TIME BTNS -->
                            <div class="w-full h-fit">
                                <!-- TIME BOXES LIST -->
                                <?php
                                $time_query = "select time from time where status = 'enabled' and doctorID = '$docID'"; 
                                $time_result = mysqli_query($con,$time_query)?>
                                <ul id="timeSlotList" class="w-full h-full flex flex-row flex-wrap space-y-5 justify-normal items-center">
                                    <?php while($time_row = mysqli_fetch_assoc($time_result)){?>
                                        <li>
                                            <!-- TIME SLOT BTNS -->
                                            <!-- All timeslot boxes have an inactive default background color  -->
                                            <!-- When clicked, the background color changes to active  -->
                                            <button value="<?php echo $time_row['time'] ?>" class="time flex w-[85px] h-[30px] lg:w-[150px] lg:h-[45px] ml-5 mt-3 lg:mt-5 justify-center items-center rounded-3xl bg-form-fill mb-2 text-custom-time text-base lg:text-lg">
                                               <?php echo $time_row['time'] ?>
                                            </button>
                                        </li>
                                    <?php ;} ?>
                                </ul> 
                            </div>
                        </div>

                        <!-- CANCEL AND SUBMIT BTNS  -->
                        <div class="flex w-full h-[20%] justify-end items-center mt-4 lg:mt-0">
                            <!-- CANCEL BTN  -->
                            <a href="user-appointment.php">
                                <button class="flex w-[85px] h-[33px] lg:w-[150px] lg:h-[45px] justify-center items-center rounded-3xl shadow-custom hover:scale-105 transform transition-transform duration-300">
                                    <span class=" text-gray-text text-lg">Cancel</span>
                                </button>
                            </a>
                            
                            <!-- SAVE BTN  -->
                            <?php $user_query = "select * from user where userID = '$user_id'";
                            $user_result = mysqli_query($con, $user_query);  
                            ?>
                            <?php while($userRow = mysqli_fetch_assoc($user_result)){ ?>           
                                <form method="post">
                                    <input type="text" name="time-select" id="time-select" class="hidden">
                                    <input type="text" name="doctor-select" id="doctor-select" class="hidden">
                                    <input type="text" name="doctor-id" id="doctor-id" class="hidden">
                                    <input type="text" name="specialty-select" id="specialty-select" class="hidden">
                                    <input type="text" name="booking-select" id="booking-select" class="hidden">

                                    <input type="text" name="username" id="username" class="hidden" value = "<?php echo $userRow['first_name'].' '.$userRow['last_name'] ?>">
                                    <input type="text" name="contact-number" id="contact-number" class="hidden" value = "<?php echo $userRow['contact_number'] ?>">
                                    <input type="text" name="user-email" id="user-email" class="hidden" value = "<?php echo $userRow['email'] ?>">
                                    <button class="flex w-[85px] h-[33px] lg:w-[150px] lg:h-[45px] bg-save-button ml-[30px] mr-5 justify-center items-center rounded-3xl shadow-custom hover:scale-105 transform transition-transform duration-300">
                                        <input class=" text-gray-text text-lg" type="submit" name="submit"></input>
                                    </button>
                                </form>
                            <?php } ?>
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
    <script src="../dist/JS animations/appointment-post.js"></script>
    <script>
         var day1;
         var day2;
         var day3;
         var updatedOption = null;
        function setDate(){
            day1 = document.getElementById("book1").value;
            day2 = document.getElementById("book2").value;
            day3 = document.getElementById("book3").value;
            console.log(day1,day2,day3);
            appointDate.destroy();
            render(day1,day2,day3);
        }

        function render(day1,day2,day3){

            flatpickr("#booking-date", {
                // Specify available dates (optional)
                minDate: "today",
                    enable: [function(date) { var intDay1 = parseInt(day1); var intDay2 = parseInt(day2); var intDay3 = parseInt(day3); console.log(intDay1,intDay2,intDay3); 
                        const day = date.getDay(); console.log(day);
                        return(day === intDay1) || (day === intDay2) || (day === intDay3); }],

                    altInput: true,
                    altFormat: "Y-m-j",
                    dateFormat: "Y-m-d",

                    inline: true,

                    // Additional appearance options (optional)
                    mode: "single",
                    allowInput: true,
            });
        }
                var appointDate = flatpickr("#booking-date", {
                // Specify available dates (optional)
                minDate: "today",
                enable: [],

                altInput: true,
                altFormat: "Y-m-j",
                dateFormat: "Y-m-d",

                inline: true,

                // Additional appearance options (optional)
                mode: "single",
                allowInput: true,
            });
          
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#specialtyBox").on('click',function(){
                var value = $(this).val();
                 console.log(value);

                $.ajax({url:"../dist/backend files/fetch.php",
                    type:"POST",
                    data:"request=" + value,
                    dataType: "html",
                    beforeSend:function(){
                        $("#doctorDropdown").html("<option>Working...</option>");
                    },
                    success:function(data){
                        // console.log(data);
                        // console.log("value:" + value);
                        $("#doctorDropdown").html(data);
                    }
                });
            });
        });
    </script>
</body>
</html>