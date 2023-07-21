<?php 
session_start();

include("../dist/backend files/connection.php");
include("../dist/backend files/functions.php");

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    //test commit

    if(!empty($email) && !empty($password)){
        // read from database
        $query = "select * from admin where email = '$email' limit 1";
        $result = mysqli_query($con, $query);

        if($result){
            if($result && mysqli_num_rows($result) > 0){
                $doctor_data = mysqli_fetch_assoc($result);
                if($doctor_data['password'] === $password){
                    $_SESSION['doctorID'] = $doctor_data['doctorID'];
                    header("Location: doctor-patient-file.php");
                    die;
                }
            }
        }
        echo "Wrong username or password!";
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Commissioner&display=swap" rel="stylesheet">
        <link rel="icon" href="../assets/favicon.png" type="image/x-icon">
    </head>
    <body class = "bg-gradient-to-tr from-gray-100 to to-slate-100 p-0 m-0 font-Commissioner flex-nowrap">
        <div class = "flex flex-row h-screen">
            <!-- LEFT SIDE -->
            <div class="bg-white flex items-center justify-center w-[75%] p-5 gap-x-12 rounded-r-[50px] shadow-2xl font-Commissioner">
                    <img class="items-center w-[280px] h-[300px] " src="../assets/Logo Enhanced.png">
                    <p class="text-[130px] leading-tight text-login-font-clr w-[40%] ">I SEE YOU</p>
            </div>
            <!-- RIGHT SIDE -->
            <div class="flex flex-col w-[100%] p-5 justify-center items-center gap-2">
                <h class="font-Commissioner text-5xl pb-5 w-[60%] text-gray-500 text-center leading-tight">Welcome back, have a nice day!</h>
                <form class="w-[50%] font-Commissioner" method="post">
                    <div class="mb-6">
                        <input class="shadow appearance-none border rounded-[200px] border-slate-500 w-full py-5 px-7 text-gray-700 text-center text-2xl leading-tight focus:outline-none focus:shadow-outline" name="email" type="text" placeholder="Email">
                    </div>
                    <div class="mb-6">
                        <input class="shadow appearance-none border rounded-[200px] border-slate-500 w-full py-5 px-7 text-gray-700 text-center text-2xl mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password" type="password" placeholder="Password">
                    </div>
                    <div class="mb-6 w-[95%]">
                        <input class="shadow appearance-none border rounded-[200px] bg-gray-400 w-full py-5 px-7 text-gray-700
                        text-center text-2xl mb-3 leading-tight focus:outline-none focus:shadow-outline" name="submit"  type="submit" placeholder="">
                    </div>
                </form>
                <a class="inline-block align-baseline font-bold text-md text-gray-500  hover:text-gray-900 " href="#">
                    Forgot Password?
                </a>
                <p class="font-Commissioner pt-20 w-[60%] text-center text-gray-500 ">By using this service, you understood and agree to the ISY Online Services Terms of Use and Privacy Statement</p>
            </div>
        </div>
    </body>
</html>
