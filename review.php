<?php
session_start();
include 'connection.php';

if(isset($_POST['sub'])) {  
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    if(isset($_GET['book'])) {
        $bookingid_from_url = $_GET['book'];

        $select_query = "SELECT bookid, emp_name FROM bookings WHERE bookid = ?";
        $stmt = mysqli_prepare($conn, $select_query);
        mysqli_stmt_bind_param($stmt, "i", $bookingid_from_url);
        mysqli_stmt_execute($stmt);
        $result_query = mysqli_stmt_get_result($stmt);
        
        if($row_fetch = mysqli_fetch_assoc($result_query)) {
            $emp_name = $row_fetch['emp_name'];
            $bookid = $row_fetch['bookid'];

            $insertsql = "INSERT INTO `reviews` (booking_id, emp_name, rating, review, date) VALUES (?, ?, ?, ?, now())";
            $stmt = mysqli_prepare($conn, $insertsql);
            mysqli_stmt_bind_param($stmt, "isss", $bookid, $emp_name, $rating, $review);

            if(mysqli_stmt_execute($stmt)) {
                echo "Successfully registered.";
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
            }
            
            mysqli_stmt_close($stmt);
        } else {
            echo "Booking ID not found.";
        }
    }
}

?>