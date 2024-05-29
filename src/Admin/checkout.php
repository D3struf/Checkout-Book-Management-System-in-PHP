<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <link rel="icon" type="image/x-icon" href="../../assets/img/logo.png">

    <!-- js -->
    <script src="../../assets/script/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- css -->
    <style>
        .prevent-select {
            -webkit-user-select: none; /* Safari */
            -ms-user-select: none; /* IE 10 and IE 11 */
            user-select: none; /* Standard syntax */
        }
    </style>

    <!-- ChartJS -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

    <!-- Books Ajax -->
    <script type="text/javascript">
        function loadBooks() {
            $.ajax({
                url: "../Utils/book-list.php",
                success: function(data) {
                    $("#checkout-book").html(data);
                }
            });
        }

        $(document).ready(function() {
            loadBooks();
            setInterval(loadBooks, 10000); // Refresh every 10 seconds
        });
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
                    <ul id="navigation" class=" flex flex-row gap-6 px-8 text-gray-400 font-medium max-sm:hidden max-sm:flex-col max-sm:px-4 max-sm:absolute max-sm:top-14 max-sm:bg-slate-800 max-sm:w-full max-sm:left-0 max-sm:gap-1 max-sm:pb-3 max-sm:rounded-b-lg">
                        <a class="py-2 px-3 rounded-md hover:bg-hover hover:text-primary_text" href="./index.php"><li>Report</li></a>
                        <a class="py-2 px-3 rounded-md hover:bg-hover hover:text-primary_text" href="./book.php"><li>Books</li></a>
                        <a class="py-2 px-3 rounded-md hover:bg-hover hover:text-primary_text" href="./member.php"><li>Members</li></a>
                        <a class="py-2 px-3 bg-primary_blue rounded-md text-primary_text" href="./checkout.php"><li>Checkout</li></a>
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
                        <img class="h-10 w-10 rounded-full p-1" src="../../assets//img/icons8-github-64.png" alt="github-profile">
                    </a>
                </button>
            </div>
        </div>
    </header>

    <?php include('../../config/db.php'); ?>
    <main class=" mx-10 my-3">
        <h1 class=" text-primary_text font-bold text-2xl">Checkout Book</h1>

        <!-- Edit Row Modal -->
        <div id="edit" class=" hidden h-24 w-full mt-3 bg-card rounded-md">
            <!-- Modal body -->
            <form class=" p-4 md:p-3 flex flex-row justify-between" method="post" action="../Utils/update.php">
                <div class=" flex flex-row gap-3">
                    <div class="">
                        <label for="checkoutID" class="mb-2 text-sm font-medium text-primary_text">Checkout ID</label>
                        <input type="text" autocomplete="off" name="checkoutID" id="edit-checkoutID"
                            class=" border text-secondary_text text-sm rounded-lg p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Type checkout id" required="" readonly>
                    </div>
                    <div class="row-span-2 sm:row-span-1">
                        <label for="memberid" class="mb-2 text-sm font-medium text-primary_text">Member ID</label>
                        <input type="text" autocomplete="off" name="memberid" id="edit-memberID"
                            class=" border text-secondary_text text-sm rounded-lg p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Type member id" required="" readonly>
                    </div>
                    <div class="row-span-2 sm:row-span-1">
                        <label for="bookID" class=" mb-2 text-sm font-medium text-primary_text">Book ID</label>
                        <input type="text" autocomplete="off" name="bookID" id="edit-bookID"
                            class=" border text-secondary_text text-sm rounded-lg p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="John Doe" required="" readonly>
                    </div>
                    <div class="row-span-2 sm:row-span-1">
                        <label for="checkoutDate" class=" mb-2 text-sm font-medium text-primary_text">Checkout Date</label>
                        <input type="text" autocomplete="off" name="checkoutDate" id="edit-checkoutDate"
                            class=" border text-secondary_text text-sm rounded-lg p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="000000000-0" required="" readonly>
                    </div>
                    <div class="row-span-2 sm:row-span-1">
                        <label for="returnDate" class=" mb-2 text-sm font-medium text-primary_text">Return Date</label>
                        <input type="datetime-local" autocomplete="off" name="returnDate" id="edit-returnDate"
                            class=" border text-secondary_text text-sm rounded-lg p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="000000000-0" required="">
                    </div>
                </div>
                <button type="submit" name="submit-edit-checkout" onclick="hideEditModal()"
                    class=" text-white inline-flex items-center bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-blue-700 focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Submit Checkout
                </button>
            </form>
        </div>

        <div class="flex flex-row gap-4">
            <div class=" flex flex-col gap-4 h-[80%] w-1/2 ">
                <!-- Adding Checkouts -->
                <div class=" h-fit mt-4 p-4 bg-card shadow-lg shadow-shadow rounded-md">
                    <form class="max-w-sm mx-auto mb-4" method="post" action="../Utils/insert.php">
                        <label for="checkout-member" class="block mb-2 mt-4 text-sm font-medium text-primary_text">Select Member</label>
                        <select id="checkout-member" name="checkout-member" autocomplete="off" class="border text-secondary_text text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500">
                            <option selected="" class=" text-primary_text">Select Member</option>
                            <?php
                                $getQuery = "SELECT * FROM librarymember";
                                $result = mysqli_query($conn, $getQuery);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option class="text-primary_text" value="'. $row['MemberID']. '">'. $row['FirstName']. ' '. $row['LastName']. '</option>';
                                }
                            ?>
                        </select>
                        <label for="checkout-book" class="block mb-2 mt-4 text-sm font-medium text-primary_text">Select Book</label>
                        <select id="checkout-book" name="checkout-book" autocomplete="off" class=" border text-secondary_text text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500">
                            <option selected="" class=" text-primary_text">Select Book</option>
                            <!-- automatically insert the realtime list of available books -->
                        </select>
                        <button type="submit" name="submit-checkout" class=" mt-4 text-white inline-flex items-center bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-blue-700 focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            Checkout
                        </button>
                    </form>
                </div>
                <!-- Checkouts per Month Chart -->
                <div class=" p-4 bg-card shadow-lg shadow-shadow rounded-md">
                    <h2 class="text-secondary_text text-md  font-semibold">Checkouts per Month</h2>
                    <canvas id="myChart" class="mx-auto" height="275" width="450"></canvas>
                </div>
            </div>
            <!-- Searching and viewing Checkouts -->
            <div class=" h-[80vh] w-full mt-4 p-4 bg-card shadow-lg shadow-shadow rounded-md flex flex-col gap-4 hover:cursor:pointer">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-3">
                    <form method="post" class=" pb-4 pr-4 bg-gray-900 flex flex-row items-center" >
                        <label for="table-search" class="sr-only" >Search</label>
                        <div class="relative pt-4 px-4">
                            <input type="text" id="table-search" name="search" autocomplete="off" class="block h-10 ps-4 text-sm text-secondary_text align-center rounded-lg w-80 bg-gray-700 dark:border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Search for checkout id">
                        </div>
                        <button class=" h-10 mt-5 -ms-14 z-10 px-2 text-primary_text" name="submit">
                        <svg class="w-4 h-4  text-primary_text" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                        </button>
                    </form>
                    <table class="w-full text-sm text-left rtl:text-right text-primary_text">
                        <thead class="text-xs text-primary_text uppercase bg-blue-900">
                            <tr>
                                <th scope="col" class="ps-6 py-3">
                                    Checkout ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Book ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Member ID
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Checkout Date
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Return Date
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Status
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
                                    
                                    $getQuery = "SELECT `checkout`.*
                                    FROM `checkout`
                                    WHERE `checkout`.`CheckoutID` = '$search';";
                                    
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

                                            echo '<tr class="odd:bg-darkgray even:bg-shadow border-b border-gray-700"><th scope="row" class="px-5 py-4 font-medium text-primary_text whitespace-nowrap">' .$row['CheckoutID'].'</th><td class="px-5 py-4 text-secondary_text">' .$row['BookID'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['MemberID'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['CheckoutDates'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['ReturnDates'].'</td><td class="px-5 py-4 font-bold ' .$class. ' ">'.$text.'</td><td class="px-5 py-1 text-secondary_text"><div class=" flex flex-row gap-2"><a class=" py-1 px-3 text-primary_text bg-lightgreen rounded-md hover:cursor:pointer" href="" onclick="showEditModal(event, '.$row['CheckoutID'].', \''.$row['BookID'].'\', \''.$row['MemberID'].'\', \''.$row['CheckoutDates'].'\', \''.$row['ReturnDates'].'\')">Edit</a><a href="checkout.php?deleteid=' .$row['CheckoutID'].'" class=" py-1 px-3 text-primary_text bg-red-600 rounded-md hover:cursor:pointer">Delete</a></div></td></tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="5" class="px-5 py-4 text-secondary_text">No results found.</td></tr>';
                                    }
                                } else {
                                    $limit = 5;
                                    $getQuery = "SELECT `checkout`.*
                                    FROM `checkout`
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
                                    $getQuery = "SELECT `checkout`.*
                                    FROM `checkout`
                                    ORDER BY CheckoutID DESC
                                    LIMIT $initial_page, $limit;";
                                    getTableData($getQuery);
                                }
                            ?>
                        </tbody>
                    </table>
                    
                </div>
                <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
                    <?php
                        echo '<span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-gray-900 dark:text-white">1-5</span> of <span class="font-semibold text-gray-900 dark:text-white">'.$total_pages.'</span></span>';
                        
                        echo '<ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">';
                        for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
                            $class = ($page_number == $current_page) ? "bg-gray-700" : "bg-gray-800";
                            echo'<li>';
                            echo'    <a href="checkout.php?page=' .$page_number. '" class="flex items-center justify-center px-3 h-8 leading-tight text-secondary_text '.$class.' border border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">' .$page_number. '</a>
                            </li>';
                        }
                        echo '</ul>';
                    ?>
                </nav>
            </div>
        </div>
    </main>

    <!-- Fetch Data for Chart -->
    <?php
        $getQuery = "   
        SELECT
            DATE_FORMAT(checkoutDates, '%Y-%m') AS month,
            COUNT(*) AS checkout_count
        FROM
            checkout
        WHERE checkoutDates BETWEEN '2023-01-01' AND '2023-12-31'
        GROUP BY
            YEAR(checkoutDates),
            MONTH(checkoutDates)
        ORDER BY
            YEAR(checkoutDates) DESC,
            MONTH(checkoutDates) DESC;
        ";

        $result = mysqli_query($conn, $getQuery);
        $data = '';
        $labels = '';
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result) ) {
                $checkout_count = $row['checkout_count'];
                $data .= $checkout_count . ' ';
            }
        }
        ?><h2 id="data" class=" hidden" data-count="<?php echo $data?>"></h2><?
        ?><h2 id="labels" class=" hidden" data-count="<?php echo $labels?>"></h2><?
    ?>

    <!-- To delete a certain book -->
    <?php 
        include('../../config/db.php');
        if (isset($_GET['deleteid'])) {
            $id = $_GET['deleteid'];
            $delete = mysqli_query($conn, "DELETE FROM `checkout` WHERE `CheckoutID` = '$id'");
            if ($delete) {
                ?>
                    <script type="text/javascript">
                        alert("Checkout deleted successfully!");
                        window.location.href = "checkout.php";
                    </script>;
                <?php
            } else {
                ?>
                    <script type="text/javascript">
                        alert("Error deleting Checkout: ' . mysqli_error($conn) . '");
                        window.location.href = "checkout.php";
                    </script>;
                <?php
            }
    
        }
    ?>

    <!-- To generate Chart -->
    <script>
        var data = document.querySelector('#data').getAttribute('data-count');
        
        data = data.split(' ');
        const MONTHS = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        const chart = document.getElementById('myChart');
        new Chart(chart, {
            type: 'line',
            data: {
                labels: MONTHS,
                datasets: [{
                    label: '2023 Checkouts',
                    data: data,
                    fill: false,
                    borderColor: '#FB6017',
                    tension: 0.1,
                    pointStyle: 'circle',
                    pointRadius: 10,
                    pointHoverRadius: 15
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: (ctx) => 'Point Style: ' + ctx.chart.data.datasets[0].pointStyle
                    }
                }
            }
        });
    </script>

    <!-- Script to show editing form -->
    <script>
        function showEditModal(event, checkoutId, bookId, memberId, checkoutDate, returnDate) {
            event.preventDefault();
            document.getElementById('edit-checkoutID').value = checkoutId;
            document.getElementById('edit-bookID').value = bookId;
            document.getElementById('edit-memberID').value = memberId;
            document.getElementById('edit-checkoutDate').value = checkoutDate;
            if (returnDate != '') {
                document.getElementById('edit-returnDate').value = returnDate;
                document.getElementById('edit-returnDate').setAttribute('readonly', 'readonly');
            }
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
                $text = ($row['ReturnDates'] != NULL) ? "Returned" : "Checked Out";
                $class = ($text == "Returned") ? " text-lightgreen " : " text-red-600 ";

                echo '<tr class="odd:bg-darkgray even:bg-shadow border-b border-gray-700"><th scope="row" class="px-5 py-4 font-medium text-primary_text whitespace-nowrap">' .$row['CheckoutID'].'</th><td class="px-5 py-4 text-secondary_text">' .$row['BookID'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['MemberID'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['CheckoutDates'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['ReturnDates'].'</td><td class="px-5 py-4 font-bold ' .$class. ' ">'.$text.'</td><td class="px-5 py-1 text-secondary_text"><div class=" flex flex-row gap-2"><a class=" py-1 px-3 text-primary_text bg-lightgreen rounded-md hover:cursor:pointer" href="" onclick="showEditModal(event, '.$row['CheckoutID'].', \''.$row['BookID'].'\', \''.$row['MemberID'].'\', \''.$row['CheckoutDates'].'\', \''.$row['ReturnDates'].'\')">Edit</a><a href="checkout.php?deleteid=' .$row['CheckoutID'].'" class=" py-1 px-3 text-primary_text bg-red-600 rounded-md hover:cursor:pointer">Delete</a></div></td></tr>';
            }
        }
    }
?>