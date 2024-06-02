<?php
    session_start();
    include('../../config/db.php');

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
                    <img src="../../assets/img/logo.png" alt="tailwind-logo" class="h-10 w-10">
                </div>
                <div class=" flex items-center max-sm:flex-col-reverse max-sm:items-start">
                    <ul id="navigation" class=" flex flex-row gap-6 px-8 text-gray-400 font-medium max-sm:hidden max-sm:flex-col max-sm:px-4 max-sm:absolute max-sm:top-14 max-sm:bg-slate-800 max-sm:w-full max-sm:left-0 max-sm:gap-1 max-sm:pb-3 max-sm:rounded-b-lg">
                        <a class="py-2 px-3 bg-primary_blue rounded-md text-primary_text" href="./dashboard.php">
                            <li>Dashboard</li>
                        </a>
                        <a class="py-2 px-3 rounded-md hover:bg-hover hover:text-primary_text" href="../Admin/book.php">
                            <li>Books</li>
                        </a>
                        <a class="py-2 px-3 rounded-md hover:bg-hover hover:text-primary_text" href="../Admin/member.php">
                            <li>Members</li>
                        </a>
                        <a class="py-2 px-3 rounded-md hover:bg-hover hover:text-primary_text" href="../Admin/checkout.php">
                            <li>Checkout</li>
                        </a>
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

            <!-- <h4 class=" font-medium text-gray-400 group-hover:text-gray-100 group-hover:cursor:pointer">Admin</h4> -->
            <!-- <button id="toggle" onclick="buttonToggle()" type="button" class="h-10 w-10 rounded-full cursor-pointer active:ring-offset-1 active:ring-1 active:ring-gray-200 group-hover:bg-hover">
                <a href="https://github.com/D3struf" target="_blank" rel="noopener noreferrer">
                    <img class="h-10 w-10 rounded-full p-1" src="../../assets/img/icons8-github-64.png" alt="github-profile">
                </a>
            </button> -->
        </div>
    </header>

    <?php include('../../config/db.php'); ?>
    <main class=" mx-10 my-5">
        <h1 class=" text-primary_text text-lg font-bold">Reports</h1>
        <div class="flex flex-col gap-4">
            <div class="flex flex-row gap-4 mt-2">
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
                                    <img class=" h-[50px] w-[50px]" src="../../assets/img/totalbooks.png" alt="total books">
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
                                    <img class=" h-[50px] w-[50px]" src="../../assets/img/totalmembers.png" alt="total books">
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
                    <!-- New Books -->
                    <div class=" h-64 w-auto p-4 bg-card shadow-lg shadow-shadow rounded-md items-center gap-1 hover:cursor:pointer">
                        <h2 class="mb-4 text-secondary_text text-md font-semibold">New Books</h2>
                        <?php
                            $getQuery = "SELECT *
                            FROM book
                            ORDER BY BookID DESC
                            LIMIT 3;";

                            $result = mysqli_query($conn, $getQuery) or die('error');
                            while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class=" my-2 px-4 py-2 bg-blue-900 rounded-md flex flex-row gap-6 items-center text-ellipsis hover:scale-105 hover:cursor:pointer">
                                    <img src="../../assets/img/book-icon.png" alt="book-icon" class="h-8 w-8">
                                    <h2 class=" text-primary_text text-base font-bold "><?php echo $row['Title']?> by <?php echo $row['Author']?></h2>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="flex flex-row gap-4 mt-2">
                    <!-- Total Checkouts -->
                    <div id="chart-container" class="h-[400px] w-[450px] p-4 pb-4 bg-card shadow-lg shadow-shadow rounded-md flex flex-col gap-4 justify-stretch hover:scale-105 hover:cursor:pointer">
                        <h2 class="text-secondary_text text-lg  font-semibold">Total Checkouts</h2>
                        <canvas id="myChart" class="mx-auto"></canvas>
                    </div>
                    <!-- Total Student Membership Types -->
                    <div id="bar-chart-container" class="h-auto w-[558px] p-4 pb-0 bg-card shadow-lg shadow-shadow rounded-md flex flex-col justify-stretch gap-4 hover:scale-105 hover:cursor:pointer">
                        <h2 class="text-secondary_text text-lg font-semibold">Student Membership Types</h2>
                        <canvas id="barChart" class="my-auto"></canvas>
                    </div>
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
    
    <!-- Books Returned Chart -->
    <script>
        var notreturnedBooksCount = document.querySelector('#notreturnbooks').getAttribute('data-count');
        var returnedBooksCount = document.querySelector('#returnbooks').getAttribute('data-count');
        console.log(notreturnedBooksCount)
        console.log(returnedBooksCount)

        const chart = document.getElementById('myChart');
        let delayed;
        new Chart(chart, {
            type: 'pie',
            data: {
                labels: ['Returned', 'Not'],
                datasets: [{
                    label: '# Books',
                    data: [returnedBooksCount, notreturnedBooksCount],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', 
                        'rgba(255, 205, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 205, 86)'
                    ],
                    borderWidth: 1,
                    hoverOffset: 4
                }]
            },
            options: {
                animation: {
                    onComplete: () => {
                        delayed = true;
                    },
                    delay: (context) => {
                        let delay = 0;
                        if (context.type === 'data' && context.mode === 'default' && !delayed) {
                        delay = context.dataIndex * 300 + context.datasetIndex * 100;
                        }
                        return delay;
                    },
                },
                plugins: {
                    legend: {
                        position: 'top', // Position the legend to the right side
                        labels: {
                            boxWidth: 30,
                            padding: 30
                        }
                    }
                },
                responsive: true
            }
        });
    </script>
    
    <!-- Total Membership Types -->
    <script>
        <?php
            $getQuery = "SELECT `MembershipType`, COUNT(*) AS `Count`
                        FROM `librarymember`
                        GROUP BY `MembershipType`;";
            
            $result = mysqli_query($conn, $getQuery) or die("error");

            $membershipCounts = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $membershipCounts[] = $row;
            }

            $jsonMembershipCounts = json_encode($membershipCounts);
            echo "const membershipCounts = $jsonMembershipCounts;";
        ?>
        console.log("Membership Counts: ", membershipCounts);
        const labels = membershipCounts.map(item => item.MembershipType);
        const data = membershipCounts.map(item => item.Count);

        const barchart = document.getElementById('barChart');
        let delayed2;
        new Chart(barchart, {
            type: 'bar',
            data: {
                labels: [labels[1], labels[2], labels[3]],
                datasets: [{
                    axis: 'y',
                    label: '# of Members',
                    data: [data[1], data[2], data[3]],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)'
                    ],
                    borderWidth: 1,
                    hoverOffset: 4
                }]
            },
            options: {
                indexAxis: 'y',
                plugins: {
                    legend: false
                },
                animation: {
                    onComplete: () => {
                        delayed2 = true;
                    },
                    delay: (context) => {
                        let delay = 0;
                        if (context.type === 'data' && context.mode === 'default' && !delayed2) {
                        delay = context.dataIndex * 300 + context.datasetIndex * 100;
                        }
                        return delay;
                    },
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
        include('../../config/db.php');
        $limit = 5;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result) ) {
                if ($limit == 0) {
                    break;
                }
                $text = ($row['ReturnDates'] != NULL) ? "Returned" : "Checked Out";
                $class = ($text == "Returned") ? "text-lightgreen" : "text-red-600";

                echo '<tr class="odd:bg-darkgray even:bg-shadow border-b border-gray-700"><th scope="row" class="px-5 py-4 font-medium text-primary_text whitespace-nowrap">' .$row['CheckoutID'].'</th><td class="px-5 py-4 text-secondary_text">'.$row['CheckoutDates'].'</td><td class="px-5 py-4 text-secondary_text">'.$row['ReturnDates'].'</td><td class="px-5 py-4 font-bold '.$class. '">'.$text. '</td></tr>';
                $limit -= 1;
            }
        }
    }
?>

