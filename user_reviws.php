<?php
include 'connection.php';
session_start();

// Assuming $username is already set
if (isset($_SESSION['userid'])) {
    $user_id = $_SESSION['userid'];
    $sql_username = "SELECT username FROM users WHERE userid='$user_id'";
    $result_username = mysqli_query($conn, $sql_username);
    $row_username = mysqli_fetch_assoc($result_username);
    $username = $row_username['username'];
}

$sql = "SELECT * FROM reviews WHERE user = '$username'";
$result_review = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 500px;
            padding: 20px;
            border: 1px solid #ccc;
            height: 300px;
            margin-left:800px;
        }

        .review-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .review-item:last-child {
            border-bottom: none;
        }

        .profile-card {
            position: fixed;
            height: 100%; /* Take full height */
            border-right: 1px solid #ddd; /* Border to separate from the main content */
        } 
    </style>
</head>
<body>
<div class="profile-card">
<?php include('try.php'); ?>
</div>

    <div class="container">
        <h2>User Reviews</h2>
        <?php
        if (mysqli_num_rows($result_review) > 0) {
            while ($row2 = mysqli_fetch_assoc($result_review)) {
                echo '<div class="review-item">';
                echo '<strong>Review ID:</strong> ' . $row2['review_id'] . '<br>';
                echo '<strong>Booking ID:</strong> ' . $row2['booking_id'] . '<br>';
                echo '<strong>Employee Name:</strong> ' . $row2['emp_name'] . '<br>';
                echo '<strong>Rating:</strong> ' . $row2['rating'] . '<br>';
                echo '<strong>Review:</strong> ' . $row2['review'] . '<br>';
                echo '<strong>Date:</strong> ' . $row2['date'] . '<br>';
                echo '</div>';
            }
        } else {
            echo "<p>No reviews found.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>