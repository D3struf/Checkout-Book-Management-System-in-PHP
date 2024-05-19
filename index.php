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

    <!-- ChartJS -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                        lightgreen: '#4F653A',
                        darkgreen: '#2B3720'
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
                    <img src="./assets/img/logo.png" alt="tailwind-logo" class="h-10 w-10">
                </div>
                <div class=" flex items-center max-sm:flex-col-reverse max-sm:items-start">
                    <ul id="navigation" class=" flex flex-row gap-6 px-8 text-gray-400 font-medium max-sm:hidden max-sm:flex-col max-sm:px-4 max-sm:absolute max-sm:top-14 max-sm:bg-slate-800 max-sm:w-full max-sm:left-0 max-sm:gap-1 max-sm:pb-3 max-sm:rounded-b-lg">
                        <a class="py-2 px-3 bg-primary_blue rounded-md text-primary_text" href="index.php"><li>Report</li></a>
                        <a class="py-2 px-3 rounded-md hover:bg-hover hover:text-primary_text" href="book.php"><li>Books</li></a>
                        <a class="py-2 px-3 rounded-md hover:bg-hover hover:text-primary_text" href="member.php"><li>Members</li></a>
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
            </div>
        </div>
    </header>

    <?php include('config/db.php'); ?>
    <main class=" mx-10 my-5">
        <h1 class=" text-primary_text text-lg font-bold">Reports</h1>
        <div class="flex flex-row gap-4">
            <div class="flex flex-col gap-4 mt-2">
                <!-- Total Books and Total Members -->
                <div class="flex flex-row gap-4">
                    <?php
                        // Total Books
                        $books = "SELECT *
                        FROM book";
                        $result = mysqli_query($conn, $books) or die('error');

                        if ($result = mysqli_query($conn, $books)) {

                            // Return the number of rows in result set
                            $rowcount = mysqli_num_rows( $result );
                            
                            // Display
                            ?>
                            <div class=" h-32 w-48 p-2 bg-card shadow-lg shadow-shadow rounded-md flex flex-row items-center gap-1 hover:scale-105 hover:cursor:pointer">
                                <img class=" h-[50px] w-[50px]" src="./assets/img/totalbooks.png" alt="total books">
                                <div class=" flex flex-col">
                                    <h1 class=" font-medium text-secondary_text text-sm">Total Books</h1>
                                    <span class=" text-primary_text text-4xl font-bold "><?php echo $rowcount?></span>
                                </div>
                            </div>
                            <?php
                        }

                        // Total Members
                        $members = "SELECT *
                        FROM librarymember";
                        $result = mysqli_query($conn, $members) or die('error');

                        if ($result = mysqli_query($conn, $members)) {

                            // Return the number of rows in result set
                            $rowcount = mysqli_num_rows( $result );
                            
                            // Display
                            ?>
                            <div class=" h-32 w-48 p-2 bg-card shadow-lg shadow-shadow rounded-md flex flex-row items-center gap-1 hover:scale-105 hover:cursor:pointer">
                                <img class=" h-[50px] w-[50px]" src="./assets/img/totalmembers.png" alt="total books">
                                <div class=" flex flex-col">
                                    <h1 class=" font-medium text-secondary_text text-sm">Total Members</h1>
                                    <span class=" text-primary_text text-4xl font-bold "><?php echo $rowcount?></span>
                                </div>
                            </div>
                            <?php
                        }

                        // Return Books Total
                        $return = "SELECT *
                        FROM checkout";
                        $result = mysqli_query($conn, $return) or die('error');
                        $returnBooksCount = 0;
                        $booksCount = 0;

                        while($row = mysqli_fetch_assoc($result)) {
                            if (is_null($row['ReturnDates'])) {
                                $returnBooksCount += 1;
                            }
                            else {
                                $booksCount += 1;
                            }
                        }
                        ?><h2 id="notreturnbooks" class=" hidden" data-count="<?php echo $returnBooksCount?>"></h2><?
                        ?><h2 id="returnbooks" class=" hidden" data-count="<?php echo $booksCount?>"></h2><?

                    ?>
                </div>
                <!-- Total Checkouts -->
                <div id="chart-container" class="h-56 w-auto p-4 pb-0 bg-card shadow-lg shadow-shadow rounded-md items-center gap-1 hover:scale-105 hover:cursor:pointer">
                    <h2 class="text-secondary_text text-md  font-semibold">Total Checkouts</h2>
                    <canvas id="myChart" class="mx-auto -mt-2"></canvas>
                </div>
                <!-- New Books -->
                <div class="h-64 w-auto p-4 bg-card shadow-lg shadow-shadow rounded-md items-center gap-1 hover:cursor:pointer">
                    <h2 class="text-secondary_text text-md font-semibold">New Books</h2>
                    <?php
                        $getQuery = "SELECT *
                        FROM book
                        ORDER BY BookID DESC
                        LIMIT 3;";

                        $result = mysqli_query($conn, $getQuery) or die('error');
                        while($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class=" my-2 px-4 py-2 bg-blue-900 rounded-md flex flex-row gap-6 items-center text-ellipsis hover:scale-105 hover:cursor:pointer">
                                <img src="./assets/img/book-icon.png" alt="book-icon" class="h-8 w-8">
                                <h2 class=" text-primary_text text-base font-bold "><?php echo $row['Title']?> by <?php echo $row['Author']?></h2>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <!-- Recent Checkouts -->
            <div class="w-full mt-2 p-4 bg-card shadow-lg shadow-shadow rounded-md flex flex-col gap-4 hover:cursor:pointer">
                <h1 class=" text-secondary_text font-semibold text-md">Recent Checkouts</h1>
                
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-lightgray">
                        <thead class="text-xs text-primary_text uppercase bg-blue-900">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Checkout ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Last Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Book Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Checkout Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Return Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $getQuery = "SELECT `checkout`.`CheckoutID`, `librarymember`.`LastName`, `book`.`Title`, `checkout`.`CheckoutDates`, `checkout`.`ReturnDates`
                                FROM `checkout` 
                                    LEFT JOIN `librarymember` ON `checkout`.`MemberID` = `librarymember`.`MemberID` 
                                    LEFT JOIN `book` ON `checkout`.`BookID` = `book`.`BookID`
                                ORDER BY CheckoutID DESC;
                                ";
                                $result = mysqli_query($conn, $getQuery);
                                
                                getTableData($getQuery);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        var notreturnedBooksCount = document.querySelector('#notreturnbooks').getAttribute('data-count');
        var returnedBooksCount = document.querySelector('#returnbooks').getAttribute('data-count');
        console.log(notreturnedBooksCount)
        console.log(returnedBooksCount)

        const chart = document.getElementById('myChart');

        new Chart(chart, {
            type: 'pie',
            data: {
                labels: ['Returned', 'Not'],
                datasets: [{
                    label: '# Books',
                    data: [returnedBooksCount, notreturnedBooksCount],
                    backgroundColor: ['#7CC437', '#f44336'],
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'right', // Position the legend to the right side
                        labels: {
                            boxWidth: 20,
                            padding: 20
                        }
                    }
                },
                responsive: true
            }
        });
    </script>
    
    
</body>
</html>

<!-- get data -->
<?php 
    function getTableData($sql) {
        include('config/db.php');
        $limit = 7;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result) ) {
                if ($limit == 0) {
                    break;
                }
                $text = ($row['ReturnDates'] != NULL) ? "Returned" : "Checked Out";
                $class = ($text == "Returned") ? "text-lightgreen" : "text-red-600";

                echo '<tr class="odd:bg-darkgray even:bg-shadow border-b border-gray-700"><th scope="row" class="px-5 py-4 font-medium text-primary_text whitespace-nowrap">' .$row['CheckoutID'].'</th><td class="px-5 py-4 text-secondary_text">' .$row['LastName'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['Title'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['CheckoutDates'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['ReturnDates'].'</td><td class="px-5 py-4 font-bold '.$class. '">'.$text. '</td></tr>';
                $limit -= 1;
            }
        }
    }
?>