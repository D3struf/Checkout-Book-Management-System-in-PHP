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
                    <form action="#" method="post">
                        <!-- Email Address -->
                        <div>
                            <label for="email" id="email" class="leading-5 text-primary_text font-normal text-base">Email Address</label>
                            <div class="mt-1">
                                <input type="email" name="email" id="email" placeholder="example@gmail.com" class="border text-gray-800 text-sm rounded-lg w-full p-2.5 bg-gray-300 border-gray-500 placeholder-gray-800 focus:ring-primary-500 focus:border-primary-500" required>
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="mt-5">
                            <label for="password-signup" id="password-signup" class="leading-5 text-primary_text font-normal text-base">Password</label>
                            <div class="mt-1">
                                <input type="password" name="password-signup" id="password-signup" class="border text-gray-800 text-sm rounded-lg w-full p-2.5 bg-gray-300 border-gray-500 placeholder-gray-800 focus:ring-primary-500 focus:border-primary-500" required>
                            </div>
                        </div>
                        <!-- Log In as Admin -->
                        <button type="submit" name="subit-log-in" id="log-in" class="mt-5 w-full border border-indigo-600 bg-indigo-600 text-white text-normal font-semibold rounded-md px-2 py-1.5 hover:border-indigo-500 hover:bg-indigo-500 appearance-none block">Log in</button>
                        <div class=" flex flex-row gap-2 items-center py-5">
                            <span class=" h-1 w-44 border-b-2 border-gray-500"></span>
                            <p class=" text-gray-200 text-sm">OR</p>
                            <span class=" h-1 w-44 border-b-2 border-gray-500"></span>
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
                    <form action="#" method="post">
                        <div class="mt-5 flex flex-row justify-between gap-3">
                            <!-- First Name -->
                            <div>
                                <label for="first-name-signup" class="leading-5 text-primary_text font-normal text-base">First Name*</label>
                                <input type="text" name="first-name-signup" id="first-name-signup" placeholder="John" class="border text-gray-800 text-sm rounded-lg w-full p-2.5 bg-gray-300 border-gray-500 placeholder-gray-800 focus:ring-primary-500 focus:border-primary-500" required>
                            </div>
                            <!-- Last Name -->
                            <div>
                                <label for="last-name-signup" class="leading-5 text-primary_text font-normal text-base">Last Name*</label>
                                <input type="text" name="last-name-signup" id="last-name-signup" placeholder="Doe" class="border text-gray-800 text-sm rounded-lg w-full p-2.5 bg-gray-300 border-gray-500 placeholder-gray-800 focus:ring-primary-500 focus:border-primary-500" required>
                            </div>
                        </div>
                        <!-- Email Address -->
                        <div class="mt-5">
                            <label for="email-signup" id="email-signup" class="leading-5 text-primary_text font-normal text-base">Email Address*</label>
                            <div class="mt-1">
                                <input type="email" name="email-signup" id="email-signup" placeholder="example@gmail.com" class="border text-gray-800 text-sm rounded-lg w-full p-2.5 bg-gray-300 border-gray-500 placeholder-gray-800 focus:ring-primary-500 focus:border-primary-500" required>
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="mt-5">
                            <label for="password-signup" id="password-signup" class="leading-5 text-primary_text font-normal text-base">Password*</label>
                            <div class="mt-1">
                                <input type="password" name="password-signup" id="password-signup" class="border text-gray-800 text-sm rounded-lg w-full p-2.5 bg-gray-300 border-gray-500 placeholder-gray-800 focus:ring-primary-500 focus:border-primary-500" required>
                            </div>
                        </div>
                        <!-- Account and Membership Type -->
                        <div id="account-membership" class="mt-5 ">
                            <div>
                                <label for="account-type"class="leading-5 text-primary_text font-normal text-base">Account Type*</label>
                                <select name="account-type" id="account-type" class="border text-gray-800 text-sm rounded-lg w-full p-2.5 bg-gray-300 border-gray-500 placeholder-gray-800 focus:ring-primary-500 focus:border-primary-500" required>
                                    <option selected value="" class=" text-gray-800">Select Account Type</option>
                                    <option value="librarian" class=" text-gray-800">Librarian</option>
                                    <option value="student" class=" text-gray-800">Student</option>
                                </select>
                            </div>
                            <div id="membership-container" class="hidden">
                                <label for="membership-type" class="leading-5 text-primary_text font-normal text-base">Membership Type*</label>
                                <select id="membership-type" name="membership-type" class="border text-gray-800 text-sm rounded-lg w-full p-2.5 bg-gray-300 border-gray-500 placeholder-gray-800 focus:ring-primary-500 focus:border-primary-500">
                                    <option selected value="">Select category</option>
                                    <option value="student">student</option>
                                    <option value="basic">basic</option>
                                    <option value="premium">premium</option>
                                </select>
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
                        <div class=" mt-1.5 max-sm:text-center">
                            <form action="" method="post">
                                <label for="admin-password" class="font-semibold text-lg leading-7 mb-1">Admin Confirmation</label>
                                <div class="mt-3">
                                    <input type="password" name="admin-password" id="admin-password" placeholder="Enter password" class="border text-gray-800 text-sm rounded-lg w-full p-2.5 pr-20 bg-gray-300 border-gray-500 placeholder-gray-800 focus:ring-primary-500 focus:border-primary-500" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class=" bg-slate-50 rounded-b-lg flex justify-end gap-4 pr-5 items-center py-2 max-sm:flex-col-reverse max-sm:justify-center max-sm:px-4 max-sm:gap-1">
                        <button 
                            id="cancel" 
                            class=" border border-gray-300 rounded-md py-1.5 px-3 bg-white shadow-sm my-1 text-base font-medium text-black hover:bg-gray-50  max-sm:w-full" type="button">
                            Cancel
                        </button>
                        <button 
                            id="confirm"
                            onclick="adminConfirmation()"
                            class=" border border-green-400 rounded-md py-1.5 px-3 bg-green-600 shadow-sm my-1 text-base font-medium text-white hover:bg-green-500 max-sm:w-full" type="button">
                            Confirm
                        </button>
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
                window.location.href = "./Admin/index.php";
            } else {
                alert("Incorrect Password");
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
            } else {  
                membershipContainer.classList.add("hidden");
                document.getElementById("account-membership").classList.remove("flex");
                document.getElementById("account-membership").classList.remove("justify-between");
                document.getElementById("account-membership").classList.remove("gap-3");
            }
        });
    </script>

    <!-- Vanilla Tilt JS -->
    <script src="../assets/script/vanilla-tilt.js"></script>

    <footer class=" fixed bottom-0 w-full text-center mx-auto backdrop-blur-md py-3">
        <p class=" text-normal font-semibold text-secondary_text">© 2024 John Paul Monter</p>
    </footer>
</body>
</html>