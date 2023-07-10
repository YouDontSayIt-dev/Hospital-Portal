<?php echo '
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Commissioner&display=swap" rel="stylesheet">
        <link rel="icon" href="/assets/favicon.png" type="image/x-icon">
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
                <h class="font-Commissioner text-5xl pb-5 w-[60%] text-gray-500 text-center leading-tight">Welcome to your gateway to wellness!</h>
                <form class="w-[70%] font-Commissioner">
                    <div class="h-[80%] flex flex-wrap gap-5">
                        <div class="mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-lg font-bold mb-2" for="grid-first-name">
                                First Name
                            </label>
                            <input class="shadow appearance-none border rounded-[200px] border-slate-500 w-full py-5 px-7 text-gray-700 text-center text-2xl leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="">
                        </div>
                        <div class="mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-lg font-bold mb-2" for="grid-email">
                                Email
                            </label>
                            <input class="shadow appearance-none border rounded-[200px] border-slate-500 w-full py-5 px-7 text-gray-700 text-center text-2xl mb-3 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" placeholder="">
                        </div>
                        <div class="mb-6 w-[46%]">
                            <label class="block uppercase tracking-wide text-gray-700 text-lg font-bold mb-2" for="grid-gender">
                                Gender
                            </label>
                            <div class="">
                                <select class="block appearance-none w-full border border-slate-500 text-gray-700 py-6 px-7 rounded-[200px] leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Rather not say</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-lg font-bold mb-2" for="grid-email">
                                Password
                            </label>
                            <input class="shadow appearance-none border rounded-[200px] border-slate-500 w-full py-5 px-7 text-gray-700 text-center text-2xl mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="">
                        </div>
                        <div class="mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-lg font-bold mb-2" for="grid-email">
                                Last Name
                            </label>
                            <input class="shadow appearance-none border rounded-[200px] border-slate-500 w-full py-5 px-7 text-gray-700 text-center text-2xl mb-3 leading-tight focus:outline-none focus:shadow-outline" id="last-name" type="text" placeholder="">
                        </div>
                        <div class="mb-6 w-[46%] data-te-input-wrapper-init">
                            <label class="block uppercase tracking-wide text-gray-700 text-lg font-bold mb-2" for="grid-email">
                                Birth Date
                            </label>
                            <input class="shadow appearance-none border rounded-[200px] border-slate-500 w-full py-5 px-7 text-gray-700 text-center text-2xl mb-3 leading-tight focus:outline-none focus:shadow-outline" id="birth-date" type="date" placeholder="">
                        </div>
                        <div class="mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-lg font-bold mb-2" for="grid-email">
                                Contact No.
                            </label>
                            <input class="shadow appearance-none border rounded-[200px] border-slate-500 w-full py-5 px-7 text-gray-700 text-center text-2xl mb-3 leading-tight focus:outline-none focus:shadow-outline" id="contact-num" type="text" placeholder="">
                        </div>
                        <div class="mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-lg font-bold mb-2" for="grid-email">
                                Confirm Password
                            </label>
                            <input class="shadow appearance-none border rounded-[200px] border-slate-500 w-full py-5 px-7 text-gray-700 text-center text-2xl mb-3 leading-tight focus:outline-none focus:shadow-outline" id="conf-password" type="password" placeholder="">
                        </div>
                        <div class="w-[95%]">
                            <button class="bg-gray-400 appearance-none border rounded-[200px] border-slate-500 w-full py-5 px-7 text-gray-700 text-center text-2xl mb-3 leading-tight focus:outline-none focus:shadow-outline">
                                Sign up
                            </button>
                        </div>
                    </div>    
                </form>
                <p class="font-Commissioner pt-2 w-[60%] text-center text-gray-500 ">By using this service, you understood and agree to the ISY Online Services Terms of Use and Privacy Statement</p>
            </div>
        </div>
    </body>
</html>
' 
    ?>