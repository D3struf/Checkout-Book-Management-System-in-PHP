<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Ease</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.png">

    <!-- Tailwind config -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#18191a',
                        card: '#242526',
                        hover: '#3a3b3c',
                        shadow: '#111111',
                        primary_blue: '#1a31cd',
                        primary_text: '#e4e6eb',
                        secondary_text: '#b0b3b8',

                        lightgray: '#1e1e1e',
                        darkgray: '#1C1C1C',
                        lightgreen: '#4F653A'
                    }
                }
            }
        }
    </script>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/styles.css">

    <!-- Flowbite -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</head>
<body class=" bg-background relative h-screen">
    <!-- Background Images -->
    <div class=" bg-fullscreen">
        <img data-tilt data-blit-reverse="True" data-tilt-full-page-listening class=" h-[450px] absolute top-80 left-72 opacity-60" src="../assets/img/book (2).jpg" alt="book1">
        <img data-tilt data-tilt-full-page-listening class=" absolute h-56 top-10 right-1/2 opacity-40" src="../assets/img/book (11).jpg" alt="book1">
        <img data-tilt data-blit-reverse="True" data-tilt-full-page-listening class=" absolute h-56 top-10 left-96 opacity-20" src="../assets/img/book (1).jpg" alt="book1">
        <img data-tilt data-tilt-full-page-listening class=" absolute h-56 top-80 left-16 opacity-40" src="../assets/img/book (3).jpg" alt="book1">
        <img data-tilt data-blit-reverse="True" data-tilt-full-page-listening class=" absolute h-56 top-10 left-36 opacity-10" src="../assets/img/book (5).jpg" alt="book1">
        <img data-tilt data-tilt-full-page-listening class=" absolute h-56 top-10 -left-20 opacity-5" src="../assets/img/book (11).jpg" alt="book1">
        <img data-tilt data-blit-reverse="True" data-tilt-full-page-listening class=" absolute h-56 -bottom-10 left-16 opacity-20" src="../assets/img/book (10).jpg" alt="book1">

        <img data-tilt data-blit-reverse="True" data-tilt-full-page-listening class=" h-[450px] absolute bottom-80 right-72 opacity-60" src="../assets/img/book (4).jpg" alt="book1">
        <img data-tilt data-tilt-full-page-listening class=" absolute h-56 bottom-10 left-1/2 opacity-40" src="../assets/img/book (12).jpg" alt="book1">
        <img data-tilt data-blit-reverse="True" data-tilt-full-page-listening class=" absolute h-56 bottom-10 right-96 opacity-20" src="../assets/img/book (6).jpg" alt="book1">
        <img data-tilt data-tilt-full-page-listening class=" absolute h-56 bottom-80 right-16 opacity-40" src="../assets/img/book (7).jpg" alt="book1">
        <img data-tilt data-blit-reverse="True" data-tilt-full-page-listening class=" absolute h-56 bottom-10 right-36 opacity-10" src="../assets/img/book (8).jpg" alt="book1">
        <img data-tilt data-tilt-full-page-listening class=" absolute h-56 bottom-10 -right-20 opacity-5" src="../assets/img/book (12).jpg" alt="book1">
        <img data-tilt data-blit-reverse="True" data-tilt-full-page-listening class=" absolute h-56 -top-10 right-16 opacity-20" src="../assets/img/book (9).jpg" alt="book1">

    </div>
    
    <?php include('../config/db.php'); ?>
    <!-- Modal -->
    <main class="flex items-center justify-center h-screen ">
        <div  class="flip-container relative mx-auto w-full h-3/4">
            <!-- Sign In -->
            <div class="front backdrop-glass absolute w-[500px] mx-auto p-5 right-0 left-0 rounded-lg shadow-md shadow-shadow">
                <!-- Title -->
                <div class=" sm:w-full sm:mx-auto sm:max-w-sm">
                    <img class="description m-auto h-16 w-16" src="../assets/img/logo.png" alt="book-icon">
                    <h1 id="sign-in" class=" title text-center text-2xl font-bold text-primary_text">Log-in to LibraryEase</h1>
                </div>
                <div class="mt-10 sm:w-full sm:mx-auto sm:max-w-sm">
                    <!-- Log In Form -->
                    <form action="./Utils/account-validation.php" method="post">
                        <!-- Email Address -->
                        <div class="relative">
                            <input type="email" name="email" id="email" placeholder=" " class="block rounded-lg px-2.5 pb-2.5 pt-5 w-full text-sm bg-gray-50 border-0 appearance-none text-black border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                            <label for="email" id="email" class="absolute text-base text-gray-600 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Email Address</label>
                        </div>
                        <!-- Password -->
                        <div class="mt-5 relative">
                            <input type="password" name="password-signup" id="password-signup" placeholder=" " class="block rounded-lg px-2.5 pb-2.5 pt-5 w-full text-sm bg-gray-50 border-0 appearance-none text-black border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                            <label for="password-signup" id="password-signup" class="absolute text-base text-gray-600 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Password</label>
                        </div>
                        <!-- Log In as Admin -->
                        <button type="submit" name="submit-log-in" id="log-in" class="mt-5 w-full border border-indigo-600 bg-indigo-600 text-white text-normal font-semibold rounded-md px-2 py-1.5 hover:border-indigo-500 hover:bg-indigo-500 appearance-none block">Log in</button>
                        <div class=" flex flex-row gap-2 items-center py-5">
                            <span class=" h-1 w-52 border-b-2 border-gray-500"></span>
                            <p class=" text-gray-200 text-sm mx-auto">OR</p>
                            <span class=" h-1 w-52 border-b-2 border-gray-500"></span>
                        </div>
                        
                    </form>
                    <button type="button" name="log-in-as-guest" id="log-in-as-guest" class=" w-full border border-gray-600 bg-transparent text-white text-normal font-semibold rounded-md px-2 py-1.5 hover:border-gray-500 hover:bg-gray-600 appearance-none block">Log in as admin</button>
                    <p class="mt-10 text-center font-normal text-gray-500">Not a member? <a href="javascript:void(0)" id="sign-up" class="text-indigo-700 font-medium hover:text-indigo-400">Sign Up</a></p>
                </div>
            </div>
            <!-- Sign Up -->
            <div class="back backdrop-glass absolute w-[500px] mx-auto -mt-10 p-5 right-0 left-0 rounded-lg shadow-md shadow-shadow">
                <!-- Title -->
                <div class=" sm:w-full sm:mx-auto sm:max--sm">
                    <img class="m-auto h-16 w-16" src="../assets/img/logo.png" alt="book-icon">
                    <h1 id="sign-in" class="text-center text-2xl font-bold text-primary_text">Create Account</h1>
                </div>
                <!-- Sign Up Form -->
                <div class=" mt-5 sm:w-full sm:mx-auto sm:max-w-sm">
                    <form action="./Utils/account-validation.php" method="post">
                        <div class="mt-5 flex flex-row justify-between gap-3">
                            <!-- First Name -->
                            <div class="relative mt-5 w-1/2">
                                <input type="text" name="first-name-signup" id="first-name-signup" placeholder=" " class="block rounded-lg px-2.5 pb-2.5 pt-5 w-full text-sm bg-gray-50 border-0 appearance-none text-black border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                                <label for="first-name-signup" class="absolute text-base text-gray-600 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">First Name*</label>
                            </div>
                            <!-- Last Name -->
                            <div class="relative mt-5 w-1/2">
                                <input type="text" name="last-name-signup" id="last-name-signup" placeholder=" " class="block rounded-lg px-2.5 pb-2.5 pt-5 w-full text-sm bg-gray-50 border-0 appearance-none text-black border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                                <label for="last-name-signup" class="absolute text-base text-gray-600 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto" >Last Name*</label>
                            </div>
                        </div>
                        <!-- Email Address -->
                        <div class="mt-5 relative">
                            <input type="email" name="email-signup" id="email-signup" placeholder=" " class="block rounded-lg px-2.5 pb-2.5 pt-5 w-full text-sm bg-gray-50 border-0 appearance-none text-black border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                            <label for="email-signup" id="email-signup" class="absolute text-base text-gray-600 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Email Address*</label>
                        </div>
                        <!-- Password -->
                        <div class="mt-5 relative">
                            <input type="password" name="password-signup" id="password-signup" placeholder=" " class="block rounded-lg px-2.5 pb-2.5 pt-5 w-full text-sm bg-gray-50 border-0 appearance-none text-black border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                            <label for="password-signup" id="password-signup" class="absolute text-base text-gray-600 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Password*</label>
                            
                        </div>
                        <!-- Account and Membership Type -->
                        <div id="account-membership" class="mt-5 ">
                            <div id="account-type-container" class="relative">
                                <select name="account-type" id="account-type" class="block rounded-lg px-2.5 pb-2.5 pt-6 w-full text-sm bg-gray-50 border-0 appearance-none text-black border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                                    <option disabled selected value="" class=" text-gray-800">Select Account Type</option>
                                    <option value="librarian" class=" text-gray-800">Librarian</option>
                                    <option value="student" class=" text-gray-800">Student</option>
                                </select>
                                <label for="account-type" class="absolute text-base text-gray-600 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Account Type*</label>
                            </div>
                            <div id="membership-container" class="hidden relative w-1/2">
                                <select id="membership-type" name="membership-type" class="block rounded-lg px-2.5 pb-2.5 pt-6 w-full text-sm bg-gray-50 border-0 appearance-none text-black border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                    <option disabled selected value="">Select category</option>
                                    <option value="student">student</option>
                                    <option value="basic">basic</option>
                                    <option value="premium">premium</option>
                                </select>
                                <label for="membership-type" class="absolute text-base text-gray-600 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Membership Type*</label>
                            </div>
                        </div>
                        <button type="submit" name="submit-sign-up" class="mt-5 w-full border border-indigo-600 bg-indigo-600 text-white text-normal font-semibold rounded-md px-2 py-1.5 hover:border-indigo-500 hover:bg-indigo-500 appearance-none block">Sign Up</button>
                        <p class="mt-10 text-center font-normal text-gray-500">Already a member? <a href="javascript:void(0)" id="sign-in-link" class="text-indigo-700 font-medium hover:text-indigo-400">Sign-in</a></p>
                    </form>
                </div>
            </div>
            <!-- Admin Confirmation -->
            <div class=" h-3/4 flex justify-center items-center  max-sm:items-end max-sm:-mt-40">
                <div id="confirm-pop-up" class=" hidden z-20 bg-white rounded-lg h-48 max-w-lg shadow-xl transition-all duration-300 ease-linear max-sm:w-11/12 max-sm:h-52">
                    <div class=" flex w-full p-5 max-sm:flex-col max-sm:gap-1">
                        <div class=" flex pr-4 max-sm:justify-center">
                            <div class=" h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="24px" height="24px"><linearGradient id="5zzMGVQnN_QyRYWGmJUsQa" x1="9.858" x2="38.142" y1="9.858" y2="38.142" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#21ad64"/><stop offset="1" stop-color="#088242"/></linearGradient><path fill="url(#5zzMGVQnN_QyRYWGmJUsQa)" d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z"/><path d="M32.172,16.172L22,26.344l-5.172-5.172c-0.781-0.781-2.047-0.781-2.828,0l-1.414,1.414	c-0.781,0.781-0.781,2.047,0,2.828l8,8c0.781,0.781,2.047,0.781,2.828,0l13-13c0.781-0.781,0.781-2.047,0-2.828L35,16.172	C34.219,15.391,32.953,15.391,32.172,16.172z" opacity=".05"/><path d="M20.939,33.061l-8-8c-0.586-0.586-0.586-1.536,0-2.121l1.414-1.414c0.586-0.586,1.536-0.586,2.121,0	L22,27.051l10.525-10.525c0.586-0.586,1.536-0.586,2.121,0l1.414,1.414c0.586,0.586,0.586,1.536,0,2.121l-13,13	C22.475,33.646,21.525,33.646,20.939,33.061z" opacity=".07"/><path fill="#fff" d="M21.293,32.707l-8-8c-0.391-0.391-0.391-1.024,0-1.414l1.414-1.414c0.391-0.391,1.024-0.391,1.414,0	L22,27.758l10.879-10.879c0.391-0.391,1.024-0.391,1.414,0l1.414,1.414c0.391,0.391,0.391,1.024,0,1.414l-13,13	C22.317,33.098,21.683,33.098,21.293,32.707z"/></svg>
                            </div>
                        </div>
                        <div class=" mt-1.5 w-96 max-sm:text-center max-sm:mx-auto max-sm:w-full">
                            <h1 class=" font-semibold text-lg leading-7 mb-1">Admin Confirmation</h1>
                            <form action="./Utils/admin.php" method="post" class="relative">
                                <input type="password" name="admin-password" id="admin-password" placeholder=" " class="block rounded-lg px-2.5 pb-2.5 pt-5 w-full text-sm bg-gray-50 border-0 border-b-2 appearance-none text-black border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                                <label for="admin-password" class="absolute text-base text-gray-600 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Password</label>
                                <!-- Buttons -->
                                <div class=" bg-slate-50 rounded-b-lg flex justify-end gap-4 pr-5 items-center py-2 max-sm:flex-col-reverse max-sm:justify-center max-sm:px-4 max-sm:gap-1">
                                    <button 
                                        id="cancel"
                                        class=" border border-gray-300 rounded-md py-1.5 px-3 bg-white shadow-sm my-1 text-base font-medium text-black hover:bg-gray-50  max-sm:w-full" type="button">
                                        Cancel
                                    </button>
                                    <button 
                                        id="confirm" name="admin-btn"
                                        onclick="adminConfirmation()"
                                        class=" border border-green-400 rounded-md py-1.5 px-3 bg-green-600 shadow-sm my-1 text-base font-medium text-white hover:bg-green-500 max-sm:w-full" type="submit">
                                        Confirm
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </main>

    <script>
        // Flip Animation
        document.getElementById('sign-up').addEventListener('click', function() {
            document.querySelector('.flip-container').classList.add('flipped');
        });

        document.getElementById('sign-in-link').addEventListener('click', function() {
            document.querySelector('.flip-container').classList.remove('flipped');
        });

        // Log in Modal
        document.getElementById('log-in-as-guest').addEventListener('click', function() {
            const modal = document.getElementById("confirm-pop-up");
            modal.classList.remove("hidden");
        });

        // Cancellation
        document.getElementById('cancel').addEventListener('click', function() {
            const modal = document.getElementById("confirm-pop-up");
            modal.classList.add("hidden");
        });

        // Confirmation
        document.getElementById('confirm').addEventListener('click', function() {
            const modal = document.getElementById("confirm-pop-up");
            const pass = document.getElementById("admin-password");

            if (pass.value === "admin") {
                modal.classList.add("hidden");
            }
        });

        // Show Membership Type
        document.getElementById("account-type").addEventListener("change", function() {
            const membershipContainer = document.getElementById("membership-container");
            if (this.value === "student") {
                membershipContainer.classList.remove("hidden");
                document.getElementById("account-membership").classList.add("flex");
                document.getElementById("account-membership").classList.add("justify-between");
                document.getElementById("account-membership").classList.add("gap-3");
                document.getElementById("account-type-container").classList.add("w-1/2");
            } else {  
                membershipContainer.classList.add("hidden");
                document.getElementById("account-membership").classList.remove("flex");
                document.getElementById("account-membership").classList.remove("justify-between");
                document.getElementById("account-membership").classList.remove("gap-3");
                document.getElementById("account-type-container").classList.remove("w-1/2");
            }
        });
    </script>

    <!-- Admin Validation -->
    <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            echo '<div id="toast-danger" class="absolute right-5 top-24 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">';
            echo '<div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">';
            echo '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">';
            echo '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>';
            echo '</svg>';
            echo '<span class="sr-only">Error icon</span>';
            echo '</div>';
            echo '<div class="ms-3 text-sm font-normal">' . $error . '</div>';
            echo '<button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">';
            echo '<span class="sr-only">Close</span>';
            echo '<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">';
            echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>';
            echo '</svg>';
            echo '</button>';
            echo '</div>';
        } elseif (isset($_GET['success'])) {
            $success = $_GET['success'];
            
            echo '<div id="toast-success" class="absolute right-5 top-24 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">';
            echo '<div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">';
            echo '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">';
            echo '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>';
            echo '</svg>';
            echo '<span class="sr-only">Check icon</span>';
            echo '</div>';
            echo '<div class="ms-3 text-sm font-normal">' . $success . '</div>';
            echo '<button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">';
            echo '<span class="sr-only">Close</span>';
            echo '<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">';
            echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>';
            echo '</svg>';
            echo '</button>';
            echo '</div>';
        }
    ?>

    <!-- Vanilla Tilt JS -->
    <script src="../assets/script/vanilla-tilt.js"></script>

    <footer class=" fixed bottom-0 w-full text-center mx-auto backdrop-blur-md py-3">
        <p class=" text-normal font-semibold text-secondary_text">© 2024 John Paul Monter</p>
    </footer>
</body>
</html>