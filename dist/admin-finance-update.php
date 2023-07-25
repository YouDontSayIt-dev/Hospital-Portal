<?php
include("../dist/backend files/connection.php");
include("../dist/backend files/functions.php");
session_start();
check_root_login($con);

if (isset($_GET['update_finance'])){
    $financePost = $_GET['update_finance'];
}else{
    $financePost = 1;
}

if (isset($_COOKIE['financeName'])){
    $financeName = $_COOKIE['financeName'];
}else{
    $financeName = "Juan Dela Cruz";
}


if(isset($_POST['submit']) && isset($_POST['update_agenda']) && isset($_POST['update_doctor']) 
&& isset($_POST['update_date']) && isset($_POST['update_amount']) && isset($_POST['update_status'])){
    $agenda = $_POST['update_agenda'];
    $doctor = $_POST['update_doctor'];
    $date = $_POST['update_date'];
    $amount = $_POST['update_amount'];
    $status = $_POST['update_status'];
    if(!empty($agenda) && !empty($doctor) && !empty($date) && !empty($amount) && !empty($status)){
        $update_finance = $con->prepare("UPDATE `finance` SET `agenda`=?,`doctor`=?,`date`=?,`amount`=?,`status`=? WHERE financeID = ?");
        $update_finance->execute([$agenda, $doctor, $date, $amount, $status, $financePost]);
    header('location:admin-finance.php');
    }
}

if (isset($_GET['delete_finance'])){

    $financeID = $_GET['delete_finance'];
    $delete_finance = $con->prepare("DELETE FROM `finance` WHERE financeID = ?");
    $delete_finance->execute([$financeID]);
    header('location:admin-finance.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance</title>
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
            <a href="../dist/admin-finance.php">
            <img src="../assets/logo.png" alt="logo" class="mx-auto pt-[34px]">
            </a>
            <!-- nav -->

            <!-- FINANCE  -->
            <a href="../dist/admin-finance.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl bg-white mx-auto mt-[61px] justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/finance-active.png" alt="health-board-active">
                    <h1 class="text-side-navbar-active-text">Finance</h1> 
                </div>
            </a>

            <!-- APPOINTMENT  -->
            <a href="../dist/admin-appointment.php">
                <div
                    class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/appointment.png" alt="appointment">
                    <h1 class="text-white">Appointment</h1>
                </div>
            </a>

            <!-- ACCOUNTS -->
            <a href="../dist/admin-accounts.php">
                <div class="flex flex-col lg:w-[125px] lg:h-[144px] rounded-3xl mx-auto justify-center items-center space-y-3 hover:scale-105 transform transition-transform duration-300">
                    <img src="../assets/sidebar/accounts.png" alt="health-board-active">
                    <h1 class="text-white">Accounts</h1> 
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
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-md" href="../dist/logout.php">Log out</a></li> 
                    </ul>
                </div>

                <!-- USER PROFILE MOBILE  -->
                <div id="dropdown-button" class="lg:hidden mr-3 mt-6 rounded-lg"> 
                    <button class=""> 
                        <img src="../assets/profilesample.jpg" alt="profile pic" class="rounded-full w-7 h-7 lg:w-10 lg:h-10"> 
                    </button> 
                    <!-- profile dropdown -->
                    <ul id="dropdown-menu" class="absolute hidden w-40 right-3 mt-1"> 
                        <li><a class="bg-white hover:bg-side-navbar py-2 px-4 block whitespace-no-wrap rounded-b-md" href="../dist/logout.php">Log out</a></li> 
                    </ul>
                </div>
            </div>
            
            <!-- MAIN CONTENT -->
            <div class="flex flex-row w-fit">
                <!-- PATIENT FINANCE LIST -->
                <div class="w-[600px] h-[820px] overflow-auto">
                    <div class="mb-7 ml-4">
                        <h1 class="text-3xl text-sidebar-text-bold">Patient Finance</h1>
                    </div>
                    <?php $finance_query = "select * from user"?>
                    <?php $finance = mysqli_query($con, $finance_query) or die(mysqli_error($con));?> 
                    <!-- PATIENT BOXES UN-ORDERED LIST -->
                    <ul id="patientFinanceListAdmin" class="space-y-5">
                        <!-- PATIENT FINANCE BOXES  -->
                        <!-- All patient finance boxes have an inactive default background color  -->
                        <!-- When clicked, the background color changes to active  -->
                        <?php while($financeRow = mysqli_fetch_assoc($finance)){ ?>
                        <li>
                       
                            <div name="<?php echo $financeRow['userID'] ?>" id="<?php echo $financeRow['first_name'].' '.$financeRow['last_name'] ?>" class="patientFinanceAdmin w-[483px] h-[58px] flex bg-background-inactive cursor-pointer shadow-custom ml-4 rounded-3xl">
                                <h1 id="financeSelect" class="my-auto ml-9 text-2xl"><?php echo $financeRow['first_name'].' '.$financeRow['last_name'] ?></h1>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>                
                </div>

                <!-- PATIENT FINANCE DETAILS -->
                <div class="flex flex-col w-[1050px] h-[800px] rounded-xl bg-white mt-5 shadow-custom">
                <form method="post">
                    <!-- PATIENT'S DETAILS  -->
                    <?php $findisplay_query = "select * from finance where financeID = '$financePost'"?>
                    <?php $findisplay = mysqli_query($con, $findisplay_query) or die(mysqli_error($con));?> 
                    <div class="flex flex-row items-center">
                        <img src="../assets/profilesample.jpg" alt="doctor" class="w-20 h-20 rounded-full mt-5 ml-5">
                        <div class="flex w-full justify-between">
                            <!-- PATIENT'S INFO -->
                            <div class="flex flex-col mt-4">
                                <h1 class="text-3xl ml-8"><?php echo $financeName ?></h1>
                            </div>
                        
                            <!-- DATE INFO -->
                            <div class="flex flex-col mt-3 mr-8">
                                <span class="text-sm text-side-navbar-active-text">Patient Number</span>
                                <span class="text-sm text-gray-text">000-000-000</span>
                            </div>   
                        </div>
                    </div>

                    <!-- ACTUAL PATIENT FINANCE LIST (PER BOX)-->
                    <ul id="" class="flex flex-col h-[570px] mx-8 overflow-auto mt-5">
                    <?php while($display_row = mysqli_fetch_assoc($findisplay)){ ?>
                        <li class="flex flex-row w-full h-fit mt-4">

                            <!-- DOCTOR'S DETAILS  -->
                           <div class="w-[25%] h-fit flex flex-row">
                                <img src="../assets/Rectangle-yellow.png" class="w-2 h-16">
                                <!-- DR DETAILS -->
                                <div class="flex flex-col ml-5 w-full space-y-1">
                                    <input
                                        class="w-full h-[30px] pl-5 pr-3 leading-5 text-black placeholder-edit-text-admin bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                        type="text"
                                        name="update_agenda"
                                        placeholder="<?php echo $display_row['agenda'] ?>"
                                        value="<?php echo $display_row['agenda'] ?>"
                                    >

                                    <input
                                        class="w-full h-[30px] pl-5 pr-3 leading-5 text-black placeholder-edit-text-admin bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                        type="text"
                                        name="update_doctor"
                                        placeholder="<?php echo $display_row['doctor'] ?>"
                                        value="<?php echo $display_row['doctor'] ?>"
                                    >
                                </div>
                           </div>

                            <!-- DATE -->
                           <div class="w-[25%] h-fit flex justify-center items-center">
                                <input
                                    class="w-[200px] h-[30px] pl-5 pr-3 leading-5 text-black placeholder-edit-text-admin bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                    type="date"
                                    name="update_date"
                                    placeholder="<?php echo $display_row['date'] ?>"
                                    value="<?php echo $display_row['date'] ?>"
                                >
                           </div>

                            <!-- AMOUNT AND STATUS-->
                           <div class="w-[25%] h-fit flex items-center justify-center">
                                <div class="flex flex-col ml-5 space-y-1">
                                    <input
                                        class="w-full h-[30px] pl-5 pr-3 leading-5 text-black placeholder-edit-text-admin bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                        type="number"
                                        name="update_amount"
                                        placeholder="<?php echo $display_row['amount'] ?>"
                                        value="<?php echo $display_row['amount'] ?>"
                                    >

                                    <input
                                        class="w-full h-[30px] pl-5 pr-3 leading-5 text-black placeholder-edit-text-admin bg-form-fill border border-gray-200 rounded-full focus:outline-none sm:text-sm"
                                        type="text"
                                        name="update_status"
                                        placeholder="<?php echo $display_row['status'] ?>"
                                        value="<?php echo $display_row['status'] ?>"
                                    >
                                </div>
                           </div>

                           <!-- DELETE BTN  -->
                           <!-- <div class="w-[25%] h-fit flex justify-center items-center my-auto">
                                <a href="../dist/admin-finance.php?delete_finance=<?php echo $display_row['financeID'] ?>">
                                <button class="w-24 h-10 rounded-3xl bg-form-fill text-delete-btn hover:scale-105 transform transition-transform duration-300">Delete</button>
                                </a>
                           </div> -->
                        </li>
                        <?php } ?>
                    </ul>

                    <!-- BOTTOM ITEMS  -->
                    <div class="flex w-full h-fit py-2 justify-end">
                        <!-- CANCEL BTN  -->
                        <a href="../dist/admin-finance.php">
                            <button type="button" class="flex w-[90px] h-[45px] justify-center items-center rounded-3xl shadow-custom hover:scale-105 transform transition-transform duration-300">
                                <span class=" text-gray-text text-lg">Cancel</span>
                            </button>
                        </a>
                        
                        <!-- SAVE BTN  -->
                        <input type="submit" name="submit" value="Save" class="text-gray-text text-lg w-[90px] h-[45px] bg-save-button mx-[30px] justify-center items-center rounded-3xl shadow-custom hover:cursor-pointer hover:scale-105 transform transition-transform duration-300">
                    </div>
                </form>    
                </div>
            </div>
        </div>
    </div>
    <script src="../dist/JS animations/profile-dropdown.js"></script>
    <script src="../dist/JS animations/active-bg.js"></script>
</body>
</html>