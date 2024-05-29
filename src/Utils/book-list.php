<?php
    require('../../config/db.php');

    function loadBooks() {
        global $conn;
        $getQuery = "SELECT DISTINCT `book`.`Title`, `book`.`BookID`
        FROM `book`
        LEFT JOIN `checkout` ON `book`.`BookID` = `checkout`.`BookID`
        WHERE `book`.`BookID` NOT IN (
            SELECT `BookID`
            FROM `checkout`
            WHERE `ReturnDates` IS NULL
            AND `CheckoutID` IN (
                SELECT MAX(`CheckoutID`)
                FROM `checkout`
                GROUP BY `BookID`
            )
        );";
        $availableBooks = mysqli_query($conn, $getQuery);
        $books = [];

        while ($book = mysqli_fetch_array($availableBooks)) {
            $books[] = $book;
        }
        return $books;
    }
    
    $AvailableBooks = loadBooks();
    echo '<option class="text-primary_text" value="">Select a book</option>';
    foreach ($AvailableBooks as $book) {
        echo '<option class="text-primary_text" value="'. $book['BookID']. '">'. $book['Title']. '</option>'; 
    }
?>
