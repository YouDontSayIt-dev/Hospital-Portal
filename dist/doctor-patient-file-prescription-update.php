<?php

include("../dist/backend files/connection.php");
include("../dist/backend files/functions.php");

session_start();

if(isset($_POST['medication-edit']) && isset($_POST['dosage-edit']) 
&& isset($_POST['daily-basis-edit']) && isset($_POST['instruction-edit']) ){
    $medsID = $_GET['update_prescription'];
    $medication = $_POST['medication-edit'];
    $dosage = $_POST['dosage-edit'];
    $daily_basis = $_POST['daily-basis-edit'];
    $instruction = $_POST['instruction-edit'];

    $query = "UPDATE `medication` SET `medicine`='$medication',`dosage`='$dosage',`schedule`='$daily_basis',`notes`='$instruction' WHERE medicineID = ".$_GET['update_prescription'].";";
    $result = mysqli_query($con, $query);
    if ($result) {
        header("location:../dist/doctor-patient-file.php");
    }else{
        header("location:../dist/doctor-patient-file.php?update=error");
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient</title>
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
            <a href="doctor-patient-file.php">
                <div
                    class="flex flex-col lg:w-[125px] lg:h-[144px] bg-white rounded-3xl mx-auto mt-[61px] justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/patient-active.png" alt="health-board-active">
                    <h1 class="text-side-navbar-active-text">Patient</h1>
                </div>
            </a>

            <!-- APPOINTMENT  -->
            <a href="doctor-appointment.php">
                <div
                    class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/appointment.png" alt="appointment">
                    <h1 class="text-white">Appointment</h1>
                </div>
            </a>

            <!-- MESSAGE  -->
            <a href="doctor-message.php">
                <div
                    class="flex flex-col lg:w-[125px] lg:h-[144px]  rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/message.png" alt="message">
                    <h1 class="text-white">Message</h1>
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
                        <img src="../assets/doctor-sample.png" alt="profile pic" class="rounded-full lg:w-12 lg:h-12">
                        <img id="dropdown-arrow" src="../assets/arrow.png" alt="dropdown-arrow" class="ml-7 rotate-180">
                    </button>
                    <!--profile dropdown-->
                    <ul id="dropdown-menu" class="absolute hidden w-40 right-3 mt-1">
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-t-md"
                                href="doctor-profile.php">Profile</a></li>
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap" href="doctor-change-pass.php">Change
                                Password</a></li>
                        <hr>
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-b-md"
                                href="../dist/logout.php">Log out</a></li>
                    </ul>
                </div>

                <!-- USER PROFILE MOBILE  -->
                <div id="dropdown-button" class="lg:hidden mr-3 mt-6 rounded-lg">
                    <button class="">
                        <img src="../assets/profilesample.jpg" alt="profile pic"
                            class="rounded-full w-7 h-7 lg:w-10 lg:h-10">
                    </button>
                    <!-- profile dropdown -->
                    <ul id="dropdown-menu" class="absolute hidden w-40 right-3 mt-1">
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-t-md"
                                href="doctor-profile.php">Profile</a></li>
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap" href="doctor-change-pass.php">Change
                                Password</a></li>
                        <hr>
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-b-md"
                                href="../dist/logout.php">Log out</a></li>
                    </ul>
                </div>
            </div>

            <!-- MAIN CONTENT -->
            <div class="flex flex-row w-fit">


                <!-- PATIENT RECORD LIST -->
                <div class="w-[600px] h-[820px] overflow-auto">
                    <div class="mb-7 ml-4">
                        <h1 class="text-3xl text-sidebar-text-bold">Patient Record</h1>
                    </div>

                    <!-- PATIENT RECORD BOXES UN-ORDERED LIST -->
                    <ul id="patientList" class="space-y-5 mt-5">
                        <?php 
                            $doctorID = $_SESSION['doctorID']; // change to $_SESSION['doctorID']
                            $query = "SELECT * FROM `user` WHERE doctorID=$doctorID;"; 
                            $result = mysqli_query($con, $query);

                            while($row = mysqli_fetch_assoc($result)){ 
                        ?>
                            <li> <!-- admin-patient-file.php?patientID=<?php echo $row['userID']; ?> -->
                                <a href="./backend files/display-patient-record.php?ID=<?php echo $row['userID'];?>">
                                    <!-- PATIENT RECORD BOXES  -->
                                    <!-- patient boxes have an inactive default background color except for the selected box  -->
                                    <!-- no shadow -->
                                    <div
                                        class="item w-[483px] h-[58px] bg-background-inactive cursor-pointer ml-4 rounded-3xl flex items-center">
                                        <!-- PATIENT NAME  -->
                                        <div class="ml-7 mr-7">
                                            <!-- NAME  -->
                                            <span class="text-[22px]"><?php echo $row["first_name"]." ".$row["last_name"];?></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php
                            }
                        ?>
                    </ul>

                </div>


                <!-- PATIENT DETAILS -->
                <div class="flex flex-col w-[1050px] h-[800px] rounded-xl bg-white mt-5 shadow-custom overflow-auto">
                    <?php 
                        if($_SESSION['patientID'] != "none"){
                            $patientID = $_SESSION['patientID'];
                            $query = "SELECT * FROM `user` WHERE userID=$patientID;";
                            $result = mysqli_query($con, $query);

                            while($row = mysqli_fetch_assoc($result)){ 
                    ?>
                    <!--PATIENT ICON & NUMBER-->
                    <div class="flex  flex-row  w-full justify-between items-center">
                        <!-- PATIENT NAME-->
                        <div class="flex flex-row justify-center items-center mt-3 ml-5">
                            <img src="../assets/doctor-sample.png" alt="doctor" class="w-20 h-20 rounded-full mr-6">
                            <h1 class="text-[40px]"><?php echo $row["first_name"]." ".$row["last_name"];?></h1>
                        </div>

                        <!-- PATIENT NUMBER -->
                        <div class="flex flex-col mt-8 mr-8 text-center">
                            <span class="text-sm text-gray-text">Patient Number</span>
                            <span class="text-sm ">
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
                    </div>
                    <?php
                            }
                        }
                    ?>

                    <form method="post">
                    <?php 
                        if($_SESSION['patientID'] != "none"){

                            // only the latest record should show
                            $patientID = $_SESSION['patientID'];
                            $query = "SELECT * FROM `patient_details` where userID=$patientID ORDER BY patientID DESC limit 1;";
                            $result = mysqli_query($con, $query);

                            if(empty($row = mysqli_fetch_assoc($result))){
                                echo "emty";
                                $query = "INSERT INTO `patient_details` (`patientID`, `userID`, `Age`, `Blood`, `Height`, `Weight`, `Temperature`, `Oxygen Level`, `Pulse Rate`, `Blood Pressure`) VALUES (NULL, '$patientID', '', '', '', '', '', '', '', '');";
                                mysqli_query($con, $query);
                                echo "<script> location.reload();</script>";
                            }
                            else{
                                while($row){ 
                    ?>

                    <!-- PATIENT INFORMATION -->
                    <div class="flex flex-row mx-12 mt-2 mb-16">
                        <div class="flex-col w-1/2">
                            <table class="w-full h-fit border-collapse">

                                <!-- AGE -->
                                <tr class="h-10 text-xl font-normal text-left ">
                                    <th class="w-[30%] text-lg text-side-navbar-active-text font-normal">
                                        Age</th>
                                    <!-- AGE VALUE -->
                                    <td class="w-[70%] text-lg font-medium"><?php echo $row["Age"]." years old" ?></td>
                                </tr>

                                <!-- BLOOD -->
                                <tr class="h-10 text-xl font-normal text-left">
                                    <th class="w-[30%] text-lg text-side-navbar-active-text font-normal">
                                        Blood</th>
                                    <!-- BLOOD VALUE -->
                                    <td class="w-[70%] text-lg font-medium"><?php echo $row["Blood"]; ?></td>
                                </tr>

                                <!-- HEIGHT -->
                                <tr class="h-10 text-xl font-normal text-left">
                                    <th class="w-[30%] text-lg text-side-navbar-active-text font-normal">
                                        Height</th>
                                    <!-- HEIGHT VALUE -->
                                    <td class="w-[70%] text-lg font-medium"><?php echo $row["Height"]."cm"; ?></td>
                                </tr>

                                <!-- WEIGHT -->
                                <tr class="h-10 text-xl font-normal text-left">
                                    <th class="w-[30%] text-lg text-side-navbar-active-text font-normal">
                                        Weight</th>
                                    <!-- WEIGHT VALUE -->
                                    <td class="w-[70%] text-lg font-medium"><?php echo $row["Weight"]."kg"; ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class="flex-col w-1/2">
                            <table class="w-full h-fit border-collapse">

                                <!-- TEMPERATURE -->
                                <tr class="h-10 text-xl font-normal text-left ">
                                    <th class="w-[30%] text-lg text-side-navbar-active-text font-normal">
                                        Temperature</th>
                                    <!-- TEMPERATURE VALUE -->
                                    <td class="w-[70%] text-lg font-medium"><?php echo $row["Temperature"]." °C"; ?> </td>
                                </tr>

                                <!-- OXYGEN LEVEL -->
                                <tr class="h-10 text-xl font-normal text-left">
                                    <th class="w-[30%] text-lg text-side-navbar-active-text font-normal">
                                        Oxygen Level</th>
                                    <!-- OXYGEN LEVEL VALUE -->
                                    <td class="w-[70%] text-lg font-medium"><?php echo $row["Oxygen Level"]."%"; ?></td>
                                </tr>

                                <!-- PULSE RATE -->
                                <tr class="h-10 text-xl font-normal text-left">
                                    <th class="w-[30%] text-lg text-side-navbar-active-text font-normal">
                                        Pulse Rate</th>
                                    <!-- PULSE RATE VALUE -->
                                    <td class="w-[70%] text-lg font-medium"><?php echo $row["Pulse Rate"]; ?></td>
                                </tr>

                                <!-- BLOOD PRESSURE -->
                                <tr class="h-10 text-xl font-normal text-left">
                                    <th class="w-[30%] text-lg text-side-navbar-active-text font-normal">
                                        Blood Pressure</th>
                                    <!-- BLOOD PRESSURE VALUE -->
                                    <td class="w-[70%] text-lg font-medium"><?php echo $row["Blood Pressure"]; ?></td>
                                </tr>
                            </table>
                        </div>
                        
                    </div>
                    <?php
                            $row = mysqli_fetch_assoc($result);
                            }
                        }
                    }
                    ?>
                        

                        <!-- PATIENT NOTE & DIAGNOSIS -->
                        <div class="flex flex-row mx-12 mb-16">

                            <div class="flex-col w-1/2">
                                <!-- PATIENT NOTE -->

                                <div class="mb-3">
                                    <span class="text-lg text-side-navbar-active-text font-normal">Note</span>
                                </div>

                                <?php 
                                    if($_SESSION['patientID'] != "none"){
                                        $patientID = $_SESSION['patientID'];
                                        $doctorID = $_SESSION['doctorID']; // change to $_SESSION['doctorID'];
                                        $query = "SELECT * FROM `notes` WHERE userID=$patientID AND doctorID=$doctorID;";
                                        $result = mysqli_query($con, $query);

                                        while($row = mysqli_fetch_assoc($result)){ 
                                ?>
                                <!-- PATIENT NOTE BOXES-->
                                <div class="flex flex-row items-center w-4/5">
                                    <img src="../assets/bullet-point.png" class="w-3 h-3 mr-[27px]">
                                    <p class="text-lg"><?php echo $row['notes'] ?></p>
                                </div>
                                <!-- EDIT PATIENT NOTE BOXES-->
                                <!-- <div class="flex flex-row items-center w-4/5">
                                    <img src="../assets/bullet-point.png" class="w-3 h-3 mr-[27px]">
                                    <input
                                        class="w-full  h-[35px] pl-5 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                        type="text" name="note-edit" placeholder="">
                                </div> -->
                                <?php
                                        }
                                    }
                                ?>

                                
                            </div>

                            <div class="flex-col w-1/2">
                                <!-- PATIENT DIAGNOSIS -->
                                <div class="mb-3">
                                    <span class="text-lg text-side-navbar-active-text font-normal">Diagnosis</span>
                                </div>

                                <!-- PATIENT DIAGNOSIS BOXES-->
                                <div class="flex flex-row flex-wrap gap-2 mb-3">
                                    <?php 
                                        if($_SESSION['patientID'] != "none"){
                                            $patientID = $_SESSION['patientID'];
                                            $doctorID = $_SESSION['doctorID']; // change to $_SESSION['doctorID'];
                                            // get the max date from user
                                            // then get the row 
                                            $query = "SELECT * FROM `illness` WHERE userID=$patientID AND doctorID=$doctorID;";
                                            $result = mysqli_query($con, $query);

                                            while($row = mysqli_fetch_assoc($result)){ 
                                    ?>
                                <div class="flex flex-row items-center">
                                    <img src="../assets/Rectangle-yellow.png" class="w-[6px] h-[56px] mr-[12px]">
                                    <div>
                                        <p class="text-2xl"><?php echo $row["Illness"]; ?></p>
                                        <p class="text-gray-text text-base"><?php echo date("m-d-Y", strtotime($row['date']))." | ".$row['status']; ?> </p>
                                    </div>                     
                                </div>
                                <!-- <div class="flex flex-row">
                                    <div class="flex flex-row items-center">
                                        <img src="../assets/Rectangle-gray.png" class="w-[6px] h-[56px] mr-[12px]">
                                        <div>
                                            <input
                                                class="w-[200px]  h-[35px] pl-5 pr-3 mb-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                                type="text" name="diagnosis-edit" placeholder="" value="">
                                            <div class="flex flex-row">
                                                <input
                                                    class="w-[90px]  h-[35px] pl-5 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                                    type="date" name="date-edit" value="">
                                                <span class="mr-2 ml-2">|</span>
                                                <input
                                                    class="w-[90px]  h-[35px] pl-5 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                                    type="text" name="treatment-edit" placeholder="" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>

                                <!--EDIT PATIENT DIAGNOSIS BOXES-->
                                <!-- <div class="flex flex-row">
                                    <div class="flex flex-row items-center">
                                        <img src="../assets/Rectangle-gray.png" class="w-[6px] h-[56px] mr-[12px]">
                                        <div>
                                            <input
                                                class="w-[200px]  h-[35px] pl-5 pr-3 mb-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                                type="text" name="diagnosis-edit" placeholder="Diagnosis">
                                            <div class="flex flex-row">
                                                <input
                                                    class="w-[90px]  h-[35px] pl-5 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                                    type="date" name="date-edit" placeholder="Date">
                                                <span class="mr-2 ml-2">|</span>
                                                <input
                                                    class="w-[90px]  h-[35px] pl-5 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                                    type="text" name="treatment-edit" placeholder="Treatment">
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>

                        </div>

                        <!-- PATIENT LAB & PRESCRIPTION -->
                        <div class="flex flex-row mx-12 mb-16">
                            <div class="flex-col w-1/2">

                                <!-- PATIENT LAB RESULT -->
                                <div class="mb-3">
                                    <span class="text-lg text-side-navbar-active-text font-normal">Current Laboratory
                                        Results</span>
                                </div>

                                <?php 
                                    if($_SESSION['patientID'] != "none"){
                                        $patientID = $_SESSION['patientID'];
                                        $doctorID = $_SESSION['doctorID']; // change to $_SESSION['doctorID'];
                                        $query = "SELECT * FROM `lab_results` WHERE userid=$patientID AND doctorID = $doctorID;";
                                        $result = mysqli_query($con, $query);

                                        while($row = mysqli_fetch_assoc($result)){ 
                                ?>

                                <!-- PATIENT LAB BOXES -->
                                <div class="flex flex-row items-center mb-[19px]">
                                    <img src="../assets/Rectangle-yellow.png" class="w-[6px] h-[80px] mr-[12px]">
                                    <div class="flex flex-col">
                                        <div class="flex flex-row justify-between w-[350px]">
                                            <p class="text-2xl"><?php echo $row['lab_test']; ?></p>
                                            <p class="text-2xl"><?php echo $row['lab_result']; ?></p>
                                        </div>
                                        <p class="text-gray-text text-base"><?php echo date("m-d-Y", strtotime($row['date'])); ?></p>
                                        <p class="text-gray-text text-base">Normal Range: <?php echo $row['normal_range']; ?></p>
                                    </div>
                                </div>
                                <?php
                                        }
                                    }
                                ?>

                                <!-- EDIT  PATIENT LAB BOXES -->
                                <!-- <div class="flex flex-row items-center mb-[19px]">
                                    <img src="../assets/Rectangle-gray.png" class="w-[6px] h-[80px] mr-[12px]">
                                    <div class="flex flex-col">
                                        <div class="flex flex-row justify-between w-[350px] mb-2">
                                            <input
                                                class="w-[170px]  h-[35px] pl-5 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                                type="text" name="laboratory-edit" placeholder="Laboratory">
                                            <input
                                                class="w-[170px]  h-[35px] pl-5 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                                type="text" name="result-edit" placeholder="Result">
                                        </div>
                                        <input
                                            class="w-[100px]  h-[35px] pl-5 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                            type="date" name="lab-date-edit" placeholder="Date">
                                        <p class="text-gray-text text-base">Normal Range: <input
                                                class="w-[250px]  h-[35px] pl-5 pr-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                                type="text" name="range-edit" placeholder="Range"></p>
                                    </div>
                                </div> -->
                            </div>


                            <div class="flex-col w-1/2">
                                <!-- PATIENT PRESCIPTION -->
                                <div class="mb-3">
                                    <span class="text-lg text-side-navbar-active-text font-normal">
                                        Prescription</span>
                                </div>

                                <?php 
                                    if($_GET['update_prescription'] != "none"){
                                        $medsID = $_GET['update_prescription'];
                                        // $doctorID = $_SESSION['doctorID']; // change to $_SESSION['doctorID'];
                                        $query = "SELECT * FROM `medication` WHERE medicineID = $medsID;";
                                        $result = mysqli_query($con, $query);

                                        while($row = mysqli_fetch_assoc($result)){ 
                                ?>

                                <!-- PATIENT PRESCRIPTION BOXES -->
                                <!-- <div class="flex flex-row items-center mb-[19px]">
                                    <img src="../assets/Rectangle-yellow.png" class="w-[6px] h-[86px] mr-[12px]">
                                    <div class="flex flex-col">
                                        <p class="text-2xl"><?php echo $row['medicine'] ?></p>
                                        <div class="flex flex-row justify-between w-[250px]">
                                            <p class="text-lg"><?php echo $row['dosage'] ?></p>
                                            <p class="text-base text-gray-text"><?php echo $row['schedule'] ?></p>
                                        </div>
                                        <p class="text-lg"><?php echo $row['notes'] ?></p>
                                    </div>
                                </div> -->
                                <div class="flex flex-row items-center mb-[19px]">
                                    <img src="../assets/Rectangle-gray.png" class="w-[6px] h-[86px] mr-[12px]">
                                    <div class="flex flex-col">
                                        <input
                                            class="w-full  h-[35px] pl-5 pr-3 mb-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                            type="text" name="medication-edit" placeholder="<?php echo $row['medicine'] ?>" value="<?php echo $row['medicine'] ?>">

                                        <div class="flex flex-row justify-between w-[300px]">
                                            <span class="text-lg"> <input
                                                    class="w-[120px]  h-[35px] pl-5 pr-3 mb-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                                    type="text" name="dosage-edit" placeholder="<?php echo $row['dosage'] ?>" value="<?php echo $row['dosage'] ?>">mg</span>
                                            <input
                                                class="w-[120px]  h-[35px] pl-5 pr-3 mb-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                                type="text" name="daily-basis-edit" placeholder="<?php echo $row['schedule'] ?>" value="<?php echo $row['schedule'] ?>">
                                        </div>
                                        <input
                                            class="w-full  h-[35px] pl-5 pr-3 mb-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                            type="text" name="instruction-edit" placeholder="<?php echo $row['notes'] ?>" value="<?php echo $row['notes'] ?>">
                                    </div>
                                </div>
                                <?php
                                        }
                                    }
                                ?>

                                <!-- EDIT PATIENT PRESCRIPTION BOXES -->
                                <!-- <div class="flex flex-row items-center mb-[19px]">
                                    <img src="../assets/Rectangle-gray.png" class="w-[6px] h-[86px] mr-[12px]">
                                    <div class="flex flex-col">
                                        <input
                                            class="w-full  h-[35px] pl-5 pr-3 mb-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                            type="text" name="medication-edit" placeholder="Medication">

                                        <div class="flex flex-row justify-between w-[300px]">
                                            <span class="text-lg"> <input
                                                    class="w-[120px]  h-[35px] pl-5 pr-3 mb-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                                    type="text" name="dosage-edit" placeholder="00">mg</span>
                                            <input
                                                class="w-[120px]  h-[35px] pl-5 pr-3 mb-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                                type="text" name="daily-basis-edit" placeholder="Daily basis">
                                        </div>
                                        <input
                                            class="w-full  h-[35px] pl-5 pr-3 mb-3 leading-5 text-black placeholder-gray-500 bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                            type="text" name="instruction-edit" placeholder="Instruction">
                                    </div>
                                </div> -->
                            </div>
                        </div>

                        <!-- BOTTOM BUTTON -->
                        <div class="flex  w-full justify-end items-center ">
                            <!-- CNCL BTN  -->
                            <a href="doctor-patient-file.php"
                                class="flex w-[90px] h-[45px] mt-3 mb-5  justify-center items-center rounded-3xl shadow-custom hover:scale-105 transform transition-transform duration-300">
                                <span class=" text-gray-text text-lg">Cancel</span>
                            </a>

                            <!-- SAVE BTN  -->
                            <button
                                class="flex w-[90px] h-[45px] bg-save-button mt-3 ml-5 mr-5 mb-5 justify-center items-center rounded-3xl shadow-custom hover:scale-105 transform transition-transform duration-300">
                                <span class=" text-gray-text text-lg">Save</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="./JS animations/profile-dropdown.js"></script>
    <script src="./JS animations/active-bg.js"></script>
</body>

</html>