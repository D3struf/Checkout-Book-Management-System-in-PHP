<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/logo.png">

    <!-- js -->
    <script src="./assets/script/script.js"></script>

    <!-- css -->
    <style>
        .prevent-select {
            -webkit-user-select: none; /* Safari */
            -ms-user-select: none; /* IE 10 and IE 11 */
            user-select: none; /* Standard syntax */
        }
    </style>

    <!-- Tailwind config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

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
</head>
<body class=" bg-background">
    
    <header class=" bg-card shadow-lg shadow-shadow">
        <div class="flex items-center w-full px-6 py-2 justify-between ">
            <div class=" flex flex-row max-sm:flex-row-reverse m-0 max-sm:w-full max-sm:justify-end">
                <div class=" flex justify-center w-full">
                    <img src="./assets/img/logo.png" alt="tailwind-logo" class="h-10 w-10">
                </div>
                <div class=" flex items-center max-sm:flex-col-reverse max-sm:items-start">
                    <ul id="navigation" class=" flex flex-row gap-6 px-8 text-gray-400 font-medium max-sm:hidden max-sm:flex-col max-sm:px-4 max-sm:absolute max-sm:top-14 max-sm:bg-slate-800 max-sm:w-full max-sm:left-0 max-sm:gap-1 max-sm:pb-3 max-sm:rounded-b-lg">
                        <a class="py-2 px-3 rounded-md hover:bg-hover hover:text-primary_text" href="index.php"><li>Report</li></a>
                        <a class="py-2 px-3 rounded-md hover:bg-hover hover:text-primary_text" href="book.php"><li>Books</li></a>
                        <a class="py-2 px-3 bg-primary_blue rounded-md text-primary_text" href="member.php"><li>Members</li></a>
                        <a class="py-2 px-3 rounded-md hover:bg-hover hover:text-primary_text" href="checkout.php"><li>Checkout</li></a>
                    </ul>
                    <div class=" max-sm:text-gray-400 max-sm:transition-all ">
                        <button onclick="activate()" class=" max-sm:p-2 max-sm:rounded-md max-sm:hover:bg-slate-700 max-sm:hover:text-gray-100 max-sm:cursor-pointer max-sm:active:ring-offset-1 max-sm:active:ring-1 max-sm:active:ring-gray-200">
                            <svg id="cross" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <svg id="burger" class="h-6 w-6 hidden max-sm:block" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class=" flex flex-row items-center gap-4 text-gray-400 max-sm:right-0 group">
                <h4 class=" font-medium text-gray-400 group-hover:text-gray-100 group-hover:cursor:pointer">John Paul Monter</h4>
                <button id="toggle" onclick="buttonToggle()" type="button" class="h-10 w-10 rounded-full cursor-pointer active:ring-offset-1 active:ring-1 active:ring-gray-200 group-hover:bg-hover">
                    <a href="https://github.com/D3struf" target="_blank" rel="noopener noreferrer">
                        <img class="h-10 w-10 rounded-full p-1" src="./assets/img/icons8-github-64.png" alt="github-profile">
                    </a>
                </button>
            </div></div>
        </div>
    </header>
    
    <?php include('config/db.php'); ?>
    <main class=" mx-10 my-3">
        <h1 class=" text-primary_text font-bold text-2xl">Members</h1>

        <!-- Edit Row Modal -->
        <div id="edit" class=" hidden h-16 w-full mt-3 bg-card">
            <!-- Modal body -->
            <form class=" p-4 md:p-3 flex flex-row justify-between" method="post" action="update.php">
                <input type="hidden" name="memberID" id="memberID">
                <div class=" flex flex-row gap-10">
                    <div class="row-span-2 sm:row-span-1">
                        <label for="title" class="mb-2 text-sm font-medium text-primary_text">First Name</label>
                        <input type="text" autocomplete="off" name="first-name" id="edit-first-name" class=" border text-secondary_text text-sm rounded-lg p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500" placeholder="John" required="">
                    </div>
                    <div class="row-span-2 sm:row-span-1">
                        <label for="author" class="mb-2 text-sm font-medium text-primary_text">Last Name</label>
                        <input type="text" autocomplete="off" name="last-name" id="edit-last-name" class=" border text-secondary_text text-sm rounded-lg p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500" placeholder="Doe" required="">
                    </div>
                    <div class="row-span-2">
                        <label for="category" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Membership Type</label>
                        <select id="edit-membership-type" name="membership-type" class=" border text-sm rounded-lg p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-primary_text focus:ring-primary-500 focus:border-primary-500">
                            <option selected="">Select category</option>
                            <option value="student">student</option>
                            <option value="basic">basic</option>
                            <option value="premium">premium</option>
                        </select>
                    </div>
                </div>
                <button type="submit" name="submit-edit-member" onclick="hideEditModal()"
                    class=" text-white inline-flex items-center bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Submit membership
                </button>
            </form>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-3">
            <!-- Search Last Name -->
            <form method="post" class=" pb-4 pr-4 bg-gray-900 flex flex-row items-center" >
                <label for="table-search" class="sr-only" >Search</label>
                <div class="relative pt-4 px-4">
                    <input type="text" id="table-search" name="search" autocomplete="off" class="block h-10 ps-4 text-sm text-secondary_text align-center rounded-lg w-80 bg-gray-700 dark:border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Search for member's last name">
                </div>
                <button class=" h-10 mt-5 -ms-14 z-10 px-2 text-primary_text" name="submit">
                    <svg class="w-4 h-4  text-primary_text" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                </button>
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button" class=" h-10 w-10 mt-5 ml-auto flex flex-row gap-2 items-center rounded-full group hover:cursor:pointer">
                    <h2 class=" text-secondary_text font-semibold text-lg -ml-10 group-hover:text-primary_text hover:cursor:pointer">Add</h2>
                    <img class="hover:cursor:pointer" src="./assets/img/icons8-add-50.png" alt="add-book">
                </button>
            </form>
            <!-- Show Members -->
            <table class="w-full text-sm text-left rtl:text-right text-primary_text">
                <thead class="text-xs text-primary_text uppercase bg-blue-900">
                    <tr>
                        <th scope="col" class="ps-6 py-3">
                            Member ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Last Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            First Name
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Membership Type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- insert Data -->
                    <?php
                        // If the User searches for book title
                        if (isset($_POST['submit'])) {
                            $limit = 9;
                            $search = $_POST['search'];
                            
                            $getQuery = "SELECT `librarymember`.*, `checkout`.`ReturnDates`
                            FROM `librarymember`
                            LEFT JOIN `checkout` ON `checkout`.`MemberID` = `librarymember`.`MemberID`
                            WHERE `librarymember`.`LastName` = '$search';";
                            
                            $result = mysqli_query($conn, $getQuery);
                            $total_rows = mysqli_num_rows($result);
                            $total_pages = ceil($total_rows/$limit);
                            if (!isset($_GET['page'])) {
                                $page_number = 1;
                            } else {
                                $page_number = $_GET['page'];
                            }
                            $current_page = $page_number;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result) ) {
                                    echo '<tr class="odd:bg-darkgray even:bg-shadow border-b border-gray-700"><th scope="row" class="px-5 py-4 font-medium text-primary_text whitespace-nowrap">' .$row['MemberID'].'</th><td class="px-5 py-4 font-bold text-primary_text">' .$row['LastName'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['FirstName'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['MembershipType'].'</td><td class="px-5 py-1 text-primary_text"><div class=" flex flex-row gap-2"><a href="member.php?deleteid=' .$row['MemberID'].'" class=" py-1 px-3 text-primary_text bg-red-600 rounded-md hover:cursor:pointer">Delete</a></div></td></tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5" class="px-5 py-4 text-secondary_text">No results found.</td></tr>';
                            }
                        } else {
                            $limit = 9;
                            $getQuery ="SELECT `librarymember`.*, `checkout`.`ReturnDates`
                            FROM `librarymember`
                            LEFT JOIN `checkout` ON `checkout`.`MemberID` = `librarymember`.`MemberID`
                            ORDER BY MemberID DESC;";

                            $result = mysqli_query($conn, $getQuery);
                            $total_rows = mysqli_num_rows($result);
                            $total_pages = ceil($total_rows/$limit);
                            if (!isset($_GET['page'])) {
                                $page_number = 1;
                            } else {
                                $page_number = $_GET['page'];
                            }
                            $current_page = $page_number;
                            $initial_page = ($page_number-1) * $limit;
                            $getQuery ="SELECT `librarymember`.*, `checkout`.`ReturnDates`
                            FROM `librarymember`
                            LEFT JOIN `checkout` ON `checkout`.`MemberID` = `librarymember`.`MemberID`
                            ORDER BY MemberID DESC
                            LIMIT $initial_page, $limit;";
                            getTableData($getQuery);
                        }
                    ?>
                </tbody>
            </table>
            
        </div>
        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
            <?php
                echo '<span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-gray-900 dark:text-white">1-9</span> of <span class="font-semibold text-gray-900 dark:text-white">'.$total_pages.'</span></span>';
                
                echo '<ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">';
                for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
                    $class = ($page_number == $current_page) ? "bg-gray-700" : "bg-gray-800";
                    echo'<li>';
                    echo'    <a href="member.php?page=' .$page_number. '" class="flex items-center justify-center px-3 h-8 leading-tight text-secondary_text '.$class.' border border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">' .$page_number. '</a>
                    </li>';
                }
                echo '</ul>';
            ?>
        </nav>
    </main>
    <!-- To delete a certain book -->
    <?php 
        include('config/db.php');
        if (isset($_GET['deleteid'])) {
            $id = $_GET['deleteid'];
            $delete = mysqli_query($conn, "DELETE FROM `librarymember` WHERE `MemberID` = '$id'");
        }
    ?>

    <!-- Add Modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative rounded-lg shadow bg-card">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                    <h3 class="text-lg font-semibold text-primary_text">
                        Member Details
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-primary_text" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="post">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2 sm:col-span-1">
                            <label for="title" class="block mb-2 text-sm font-medium text-primary_text">First Name</label>
                            <input type="text" autocomplete="off" name="first-name" id="title" class=" border text-secondary_text text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500" placeholder="John" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="author" class="block mb-2 text-sm font-medium text-primary_text">Last Name</label>
                            <input type="text" autocomplete="off" name="last-name" id="author" class=" border text-secondary_text text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500" placeholder="Doe" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Membership Type</label>
                            <select id="category" name="membership-type" class=" border text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-primary_text focus:ring-primary-500 focus:border-primary-500">
                                <option selected="">Select category</option>
                                <option value="student">student</option>
                                <option value="basic">basic</option>
                                <option value="premium">premium</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="submit-member" class="text-white inline-flex items-center bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Submit membership
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- to add book -->
    <?php
        include('config/db.php');
        if (isset($_POST['submit-member'])) {
            // Get form data
            $firstName = $_POST['first-name'];
            $lastName = $_POST['last-name'];
            $membershipType = $_POST['membership-type'];
            print($firstName);
            print($lastName);
            print($membershipType);
            $setQuery = "INSERT INTO `librarymember` (`MemberID`, `FirstName`, `LastName`, `MembershipType`) VALUES (NULL, '$firstName', '$lastName', '$membershipType');";
            if (mysqli_query($conn, $setQuery)) {
                echo '<script>alert("Membership added successfully!");</script>';
            } else {
                echo '<script>alert("Error: ' . $setQuery . '<br>' . mysqli_error($conn) . '");</script>';
            }
        }
    ?>

    <!-- Script to show editing form -->
    <script>
        function showEditModal(event, memberId, firstname, lastname, membershipType) {
            event.preventDefault();
            document.getElementById('memberID').value = memberId;
            document.getElementById('edit-last-name').value = lastname;
            document.getElementById('edit-first-name').value = firstname;
            document.getElementById('edit-membership-type').value = membershipType;
            document.getElementById('edit').classList.remove('hidden');
        }

        function hideEditModal() {
            document.getElementById('edit').classList.add('hidden');
        }
    </script>
</body>
</html>

<!-- get data -->
<?php 
    function getTableData($sql) {
        include('config/db.php');
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result) ) {
                echo '<tr class="odd:bg-darkgray even:bg-shadow border-b border-gray-700"><th scope="row" class="px-5 py-4 font-medium text-primary_text ">' .$row['MemberID'].'</th><td class="px-5 py-4 font-bold">'.$row['LastName'].'</td><td class="px-5 py-4 text-secondary_text">' .$row['FirstName'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['MembershipType'].'</td><td class="px-5 py-1 text-secondary_text"><div class=" flex flex-row gap-2"><a class=" py-1 px-3 text-primary_text bg-lightgreen rounded-md hover:cursor:pointer" href="" onclick="showEditModal(event, '.$row['MemberID'].', \''.$row['FirstName'].'\', \''.$row['LastName'].'\', \''.$row['MembershipType'].'\')">Edit</a><a href="member.php?deleteid=' .$row['MemberID'].'" class=" py-1 px-3 text-primary_text bg-red-600 rounded-md hover:cursor:pointer">Delete</a></div></td></tr>';
            }
        }
    }
?>