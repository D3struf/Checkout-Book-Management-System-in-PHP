<?php
    session_start();
    include('../../config/db.php');
    include('../Utils/deletion.php');

    // Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header('Location: sign-in.php'); // Redirect to login page if not logged in
        exit();
    }

    $email = $_SESSION['email'];

    // Fetch user data
    $query = "SELECT `account`.`EmailAddress`, `account`.`Password`, `account`.`AccountType`, `librarymember`.`FirstName`, `librarymember`.`LastName`, `librarymember`.`MembershipType`, `librarymember`.`ProfileImage`  
    FROM `account` 
    JOIN `librarymember` ON `account`.`AccountID` = `librarymember`.`AccountID` 
    WHERE `account`.`EmailAddress` = '$email'";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION["account_type"] = $user["AccountType"];
    } else {
        echo "User not found.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Ease</title>
    <link rel="icon" type="image/x-icon" href="../../assets/img/logo.png">

    <!-- js -->
    <script src="../../assets/script/script.js"></script>

    <!-- css -->
    <style>
    .prevent-select {
        -webkit-user-select: none;
        /* Safari */
        -ms-user-select: none;
        /* IE 10 and IE 11 */
        user-select: none;
        /* Standard syntax */
    }
    </style>

    <!-- Flowbite -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

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
</head>

<body class=" bg-background prevent-select">
    <header class=" bg-card shadow-lg shadow-shadow">
        <div class="flex items-center w-full px-6 py-2 justify-between ">
            <div class=" flex flex-row max-sm:flex-row-reverse m-0 max-sm:w-full max-sm:justify-end">
                <div class=" flex justify-center w-full">
                    <img src="../../assets/img/logo.png" alt="tailwind-logo" class="h-10 w-10">
                </div>
                <div class=" flex items-center max-sm:flex-col-reverse max-sm:items-start">
                    <ul id="navigation"
                        class=" flex flex-row gap-6 px-8 text-gray-400 font-medium max-sm:hidden max-sm:flex-col max-sm:px-4 max-sm:absolute max-sm:top-14 max-sm:bg-slate-800 max-sm:w-full max-sm:left-0 max-sm:gap-1 max-sm:pb-3 max-sm:rounded-b-lg">
                        <a class="py-2 px-3 rounded-md hover:bg-hover hover:text-primary_text" href="<?php if ($user['AccountType'] == 'admin') {echo './index.php';} else {echo '../Librarian/dashboard.php';}?>">
                            <li>Dashboard</li>
                        </a>
                        <a class="py-2 px-3 bg-primary_blue rounded-md text-primary_text" href="./book.php">
                            <li>Books</li>
                        </a>
                        <a class="py-2 px-3 rounded-md hover:bg-hover hover:text-primary_text" href="./member.php">
                            <li>Members</li>
                        </a>
                        <a class="py-2 px-3 rounded-md hover:bg-hover hover:text-primary_text" href="./checkout.php">
                            <li>Checkout</li>
                        </a>
                    </ul>
                    <div class=" max-sm:text-gray-400 max-sm:transition-all ">
                        <button onclick="activate()"
                            class=" max-sm:p-2 max-sm:rounded-md max-sm:hover:bg-slate-700 max-sm:hover:text-gray-100 max-sm:cursor-pointer max-sm:active:ring-offset-1 max-sm:active:ring-1 max-sm:active:ring-gray-200">
                            <svg id="cross" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <svg id="burger" class="h-6 w-6 hidden max-sm:block" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Account Settings & Sign Out -->
            <div class=" flex flex-row items-center gap-4 text-gray-400 max-sm:right-0 group ">
                <h4 class=" font-medium text-gray-400 group-hover:text-gray-100 group-hover:cursor:pointer"><?php if ($user['Password'] == 'admin') {echo 'Admin';} else {echo htmlspecialchars($user['FirstName']); echo ' '; echo htmlspecialchars($user['LastName']);}?></h4>
                <button id="toggle" onclick="buttonToggle()" type="button" class="h-10 w-10 rounded-full cursor-pointer active:ring-offset-1 active:ring-1 active:ring-gray-200">
                    <?php if ($user['ProfileImage']): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($user['ProfileImage']); ?>" alt="Profile Image" class="h-8 w-8 mx-1 rounded-full">
                    <?php else: ?>
                        <svg class="text-gray-300 h-8 w-8 mx-1" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                        </svg>
                    <?php endif; ?>
                </button>
                <div id="settings" class="absolute bg-card rounded-md py-1 border border-shadow top-12 right-9 text-primary_text font-normal text-base leading-6 shadow-md hidden z-10">
                    <ul class="flex flex-col">
                        <a href="../account-setting.php" class="relative inline-flex items-center py-2 pl-4 pr-20 hover:bg-hover">
                            <svg class="w-3 h-3 me-3"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="#ffffff" d="M0 416c0 17.7 14.3 32 32 32l54.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 448c17.7 0 32-14.3 32-32s-14.3-32-32-32l-246.7 0c-12.3-28.3-40.5-48-73.3-48s-61 19.7-73.3 48L32 384c-17.7 0-32 14.3-32 32zm128 0a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM320 256a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm32-80c-32.8 0-61 19.7-73.3 48L32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l246.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48l54.7 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-54.7 0c-12.3-28.3-40.5-48-73.3-48zM192 128a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm73.3-64C253 35.7 224.8 16 192 16s-61 19.7-73.3 48L32 64C14.3 64 0 78.3 0 96s14.3 32 32 32l86.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 128c17.7 0 32-14.3 32-32s-14.3-32-32-32L265.3 64z"/>
                            </svg>
                            <li>Account Settings</li></a>
                        <a href="../about.php" class="relative inline-flex items-center py-2 pl-4 pr-20 hover:bg-hover">
                            <svg class="w-3 h-3 me-3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="48px" height="48px">
                                <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M24,4c-11.02771,0 -20,8.97229 -20,20c0,3.27532 0.86271,6.33485 2.26172,9.06445l-2.16797,7.76367c-0.50495,1.8034 1.27818,3.58449 3.08203,3.08008l7.76758,-2.16797c2.72769,1.39712 5.7836,2.25977 9.05664,2.25977c11.02771,0 20,-8.97229 20,-20c0,-11.02771 -8.97229,-20 -20,-20zM24,7c9.40629,0 17,7.59371 17,17c0,9.40629 -7.59371,17 -17,17c-3.00297,0 -5.80774,-0.78172 -8.25586,-2.14648c-0.34566,-0.19287 -0.75354,-0.24131 -1.13477,-0.13477l-7.38672,2.0625l2.0625,-7.38281c0.10655,-0.38122 0.05811,-0.7891 -0.13477,-1.13477c-1.36674,-2.4502 -2.15039,-5.25915 -2.15039,-8.26367c0,-9.40629 7.59371,-17 17,-17zM23.97656,12.97852c-0.82766,0.01293 -1.48843,0.69381 -1.47656,1.52148v12c-0.00765,0.54095 0.27656,1.04412 0.74381,1.31683c0.46725,0.27271 1.04514,0.27271 1.51238,0c0.46725,-0.27271 0.75146,-0.77588 0.74381,-1.31683v-12c0.00582,-0.40562 -0.15288,-0.7963 -0.43991,-1.08296c-0.28703,-0.28666 -0.67792,-0.44486 -1.08353,-0.43852zM24,31c-1.10457,0 -2,0.89543 -2,2c0,1.10457 0.89543,2 2,2c1.10457,0 2,-0.89543 2,-2c0,-1.10457 -0.89543,-2 -2,-2z"></path></g></g>
                            </svg>
                            <li class="">About</li>
                        </a>
                        <a href="../sign-in.php" class="relative inline-flex items-center py-2 pl-4 pr-20 hover:bg-hover">
                            <svg class="w-4 h-4 me-2.5" data-name="Design Convert" id="Design_Convert" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" >
                                <defs><style>.cls-1{fill:#ffffff;}</style></defs><title/><path class="cls-1" d="M55,28H34a1,1,0,0,1,0-2H55a1,1,0,0,1,0,2Z"/><path class="cls-1" d="M28,57a1,1,0,0,1-.45-.11L8.66,47.45A3,3,0,0,1,7,44.76V10a3,3,0,0,1,3-3h9a1,1,0,0,1,0,2H11.34l17.09,8.1A1,1,0,0,1,29,18V56a1,1,0,0,1-.47.85A1,1,0,0,1,28,57ZM9,10.11V44.76a1,1,0,0,0,.55.9L27,54.38V18.63Z"/><path class="cls-1" d="M47,37a1,1,0,0,1-.71-.29,1,1,0,0,1,0-1.42L54.59,27l-8.3-8.29a1,1,0,0,1,1.42-1.42l9,9a1,1,0,0,1,0,1.42l-9,9A1,1,0,0,1,47,37Z"/><path class="cls-1" d="M37,47H28a1,1,0,0,1,0-2h9a1,1,0,0,0,1-1V36a1,1,0,0,1,2,0v8A3,3,0,0,1,37,47Z"/><path class="cls-1" d="M39,19a1,1,0,0,1-1-1V10a1,1,0,0,0-1-1H15a1,1,0,0,1,0-2H37a3,3,0,0,1,3,3v8A1,1,0,0,1,39,19Z"/>
                            </svg>
                            <li>Sign out</li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <?php include('../../config/db.php'); ?>
    <main class=" mx-10 my-3">
        <h1 class=" text-primary_text font-bold text-2xl">Books</h1>

        <!-- Edit Row Modal -->
        <div id="edit" class=" hidden h-16 w-full mt-3 bg-card">
            <!-- Modal body -->
            <form class=" p-4 md:p-3 flex flex-row justify-between" method="post" action="../Utils/update.php" enctype="multipart/form-data">
                <input type="hidden" name="bookID" id="bookID">
                <div class=" flex flex-row gap-10">
                    <div class="row-span-2">
                        <label for="title" class="mb-2 text-sm font-medium text-primary_text">Title</label>
                        <input type="text" autocomplete="off" name="title" id="edit-title"
                            class=" border text-secondary_text text-sm rounded-lg p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Type book title" required>
                    </div>
                    <div class="row-span-2">
                        <label for="author" class=" mb-2 text-sm font-medium text-primary_text">Author</label>
                        <input type="text" autocomplete="off" name="author" id="edit-author"
                            class=" border text-secondary_text text-sm rounded-lg p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="John Doe" required>
                    </div>
                    <div class="row-span-2">
                        <label for="isbn" class=" mb-2 text-sm font-medium text-primary_text">ISBN</label>
                        <input type="text" autocomplete="off" name="isbn" id="edit-isbn"
                            class=" border text-secondary_text text-sm rounded-lg p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="000000000-0" required>
                    </div>
                    <div class="col-span-3">
                        <label for="file-upload" class="mb-2 text-sm font-medium text-primary_text">Book Cover</label>
                        <input type="file" name="file-upload" id="file-upload" class=" text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-600 border-gray-600 placeholder-gray-400">
                    </div>
                </div>
                <button type="submit" name="submit-edit-book" onclick="hideEditModal()"
                    class=" text-white inline-flex items-center focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Submit book
                </button>
            </form>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-3">
            <!-- Search Book -->
            <form method="post" class=" pb-4 pr-4 bg-gray-900 flex flex-row items-center">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative pt-4 px-4">
                    <input type="text" id="table-search" name="search" autocomplete="off"
                        class="block h-10 ps-4 text-sm text-secondary_text align-center rounded-lg w-80 bg-gray-700 dark:border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search for book info">
                </div>
                <button class=" h-10 mt-5 -ms-14 z-10 px-2 text-primary_text" name="submit">
                    <svg class="w-4 h-4  text-primary_text" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </button>
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button"
                    class=" h-10 w-10 mt-5 ml-auto flex flex-row gap-2 items-center rounded-full group hover:cursor:pointer">
                    <h2
                        class=" text-secondary_text font-semibold text-lg -ml-10 group-hover:text-primary_text hover:cursor:pointer">
                        Add</h2>
                    <img class="hover:cursor:pointer" src="../../assets/img/icons8-add-50.png" alt="add-book">
                </button>
            </form>
            <table class="w-full text-sm text-left rtl:text-right text-primary_text">
                <thead class="text-xs text-primary_text uppercase bg-blue-900">
                    <tr>
                        <th scope="col" class="ps-6 py-3">
                            Book ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Author
                        </th>
                        <th scope="col" class="px-4 py-3">
                            ISBN
                        </th>
                        <?php
                            if ($user['AccountType'] == 'admin') {
                                echo '<th scope="col" class="px-6 py-3">Action</th>';
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <!-- insert Data -->
                    <?php
                        // If the User searches for book title
                        if (isset($_POST['submit'])) {
                            $limit = 9;
                            $search = $_POST['search'];
                            
                            $getQuery = "SELECT `book`.*, `checkout`.`ReturnDates`
                            FROM `book`
                            LEFT JOIN `checkout` ON `checkout`.`BookID` = `book`.`BookID`
                            WHERE `book`.`Title` = '$search'
                            OR `book`.`ISBN` = '$search'
                            OR `book`.`Author` = '$search';";
                            
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
                                    $text = ($row['ReturnDates'] != NULL) ? "Returned" : "Checked Out";
                                    $class = ($text == "Returned") ? " text-lightgreen " : " text-red-600 ";

                                    echo '<tr class="odd:bg-darkgray even:bg-shadow border-b border-gray-700"><th scope="row" class="px-5 py-4 font-medium text-primary_text ">' .$row['BookID'].'</th><td class="px-5 py-4 font-bold">'.$row['Title'].'</td><td class="px-5 py-4 text-primary_text">' .$row['Author'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['ISBN'].'</td>';
                                    
                                    if ($user['AccountType'] == 'admin') {
                                        echo '<td class="px-5 py-1 text-secondary_text"><div class=" flex flex-row gap-2"><a class=" py-1 px-3 text-primary_text bg-lightgreen rounded-md hover:cursor:pointer" href="" onclick="showEditModal(event, '.$row['BookID'].', \''.$row['Title'].'\', \''.$row['Author'].'\', \''.$row['ISBN'].'\')">Edit</a><a href="book.php?deleteid=' .$row['BookID'].'" class=" py-1 px-3 text-primary_text bg-red-600 rounded-md hover:cursor:pointer">Delete</a></div></td>';
                                    }
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5" class="px-5 py-4 text-secondary_text">No results found.</td></tr>';
                            }
                        } else {
                            $limit = 9;
                            $getQuery = "SELECT `book`.*, `checkout`.`ReturnDates`
                            FROM `book` 
                            LEFT JOIN `checkout` ON `checkout`.`BookID` = `book`.`BookID`
                            ORDER BY CheckoutID DESC;";

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
                            $getQuery = "SELECT `book`.*, `checkout`.`ReturnDates`
                            FROM `book` 
                            LEFT JOIN `checkout` ON `checkout`.`BookID` = `book`.`BookID`
                            ORDER BY BookID DESC
                            LIMIT $initial_page, $limit;";
                            getTableData($getQuery);
                        }
                    ?>
                </tbody>
            </table>

        </div>
        <!-- Bottom Pagination -->
        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4"
            aria-label="Table navigation">
            <?php
                echo '<span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-gray-900 dark:text-white">1-9</span> of <span class="font-semibold text-gray-900 dark:text-white">'.$total_pages.'</span></span>';
                
                echo '<ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">';
                for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
                    $class = ($page_number == $current_page) ? "bg-gray-700" : "bg-gray-800";
                    echo'<li>';
                    echo'    <a href="book.php?page=' .$page_number. '" class="flex items-center justify-center px-3 h-8 leading-tight text-secondary_text '.$class.' border border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">' .$page_number. '</a>
                    </li>';
                }
                echo '</ul>';
            ?>
        </nav>
    </main>

    <!-- Add Modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative rounded-lg shadow bg-card">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                    <h3 class="text-lg font-semibold text-primary_text">
                        Book Details
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-primary_text"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="post" action="../Utils/insert.php" enctype="multipart/form-data">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="title" class="block mb-2 text-sm font-medium text-primary_text">Title</label>
                            <input type="text" autocomplete="off" name="title" id="title" class=" border text-secondary_text text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500" placeholder="Type book title" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="author" class="block mb-2 text-sm font-medium text-primary_text">Author</label>
                            <input type="text" autocomplete="off" name="author" id="author" class=" border text-secondary_text text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500" placeholder="John Doe" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="isbn" class="block mb-2 text-sm font-medium text-primary_text">ISBN</label>
                            <input type="text" autocomplete="off" name="isbn" id="isbn" class=" border text-secondary_text text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500" placeholder="000000000-0" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="file-upload" class="block mb-2 text-sm font-medium text-primary_text">Book Cover</label>
                            <input type="file" name="file-upload" id="file-upload" class=" block w-full text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-600 border-gray-600 placeholder-gray-400">
                            <p class=" text-secondary_text text-sm mt-2 font-normal">PNG, JPG, JPEG, or GIF (MAX. 16 Mb)</p>
                        </div>
                    </div>
                    <button type="submit" name="submit-book" class="text-white inline-flex items-center focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Submit book
                    </button>
                </form>
            </div>
        </div>
    </div>
    
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

    <!-- Script to show editing form -->
    <script>
        function showEditModal(event, bookId, bookTitle, bookAuthor, bookISBN) {
            event.preventDefault();
            document.getElementById('bookID').value = bookId;
            document.getElementById('edit-title').value = bookTitle;
            document.getElementById('edit-author').value = bookAuthor;
            document.getElementById('edit-isbn').value = bookISBN;
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
        include('../../config/db.php');
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result) ) {
                echo '<tr class="odd:bg-darkgray even:bg-shadow border-b border-gray-700"><th scope="row" class="px-5 py-4 font-medium text-primary_text ">' .$row['BookID'].'</th><td class="px-5 py-4 font-bold">'.$row['Title'].'</td><td class="px-5 py-4 text-primary_text">' .$row['Author'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['ISBN'].'</td>';
                if ($_SESSION['account_type'] == 'admin') {
                    echo '<td class="px-5 py-1 text-secondary_text"><div class=" flex flex-row gap-2"><a class=" py-1 px-3 text-primary_text bg-lightgreen rounded-md hover:cursor:pointer" href="" onclick="showEditModal(event, '.$row['BookID'].', \''.$row['Title'].'\', \''.$row['Author'].'\', \''.$row['ISBN'].'\')">Edit</a><a href="book.php?deleteidB=' .$row['BookID'].'" class=" py-1 px-3 text-primary_text bg-red-600 rounded-md hover:cursor:pointer">Delete</a></div></td>';
                }
                echo '</tr>';
            }
        }
    }
?>