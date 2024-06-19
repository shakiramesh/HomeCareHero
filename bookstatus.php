<?php
include 'connection.php';

if (isset($_POST['val']) && isset($_POST['id'])) {
    $status = $_POST['val'];
    $bookid = $_POST['id'];

    $query = "UPDATE bookings SET status='$status' WHERE bookid='$bookid'";
    $updateResult = mysqli_query($conn, $query);

    if ($updateResult) {
        // Fetch the updated status
        $selectQuery = "SELECT status FROM bookings WHERE bookid='$bookid'";
        $result = mysqli_query($conn, $selectQuery);

        if ($result) {
            $data = mysqli_fetch_assoc($result);
            echo $data['status'];
        } else {
            // Handle the error if the SELECT query fails
            echo "Error fetching updated status";
        }

        // Optional: Redirect to the bookinglist.php page
        // header('location: bookinglist.php');
    } else {
        // Handle the error if the UPDATE query fails
        echo "Error updating status";
    }
} else {
    // Handle the case where val or id is not set
    echo "Invalid data";
}
?>
