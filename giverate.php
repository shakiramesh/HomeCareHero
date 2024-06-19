<?php
session_start();
include 'connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {  
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    if (isset($_GET['book']) && is_numeric($_GET['book'])){
        $bookingid_from_url = $_GET['book'];
        
            $sql = "SELECT bookid, emp_name FROM bookings WHERE bookid=$bookingid_from_url";
            $result = $conn->query($sql);

            // Display data in a containers
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            $emp_name = $row['emp_name'];
            $bookid = $row['bookid'];

            $insertsql = "INSERT INTO `reviews` (booking_id, emp_name, rating, review, date) VALUES ('$bookid', '$emp_name', '$rating', '$review', now())";
            $result_query = mysqli_query($conn, $insertsql);
            echo "<p style='color: green;'>Form submitted successfully!</p>";
            echo "<p>EXPERT IN: " . $bookingid_from_url . "</p>";
        } 
    }else {
        echo "Booking ID not found.";
    }
}
$conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="ratescript.js"></script>
    <title>Product Review Form</title>

    <style>
        /* ... (Your existing CSS styles remain unchanged) ... */
        body {
            background-image: url('your-background-image-url.jpg');
            background-size: cover;
            margin: 0;
            font-family: 'Arial', sans-serif;
            color: #ffffff; /* Set text color to white */
        }

        .rating {
            text-align: center;
            margin-top: 50px;
            background-color: rgba(0, 0, 0, 0.8); /* Semi-transparent black background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .star {
            font-size: 18px;
            color: #b19cd9;
            cursor: pointer;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #b19cd9;
            border-radius: 5px;
            color: #000000; /* Set text color to black */
        }

        button {
            background-color: #b19cd9;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="rating">

        <!-- ... (Your existing form elements remain unchanged) ... -->
        <h2>Submit a Review</h2>
    <form id="reviewForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <label class="star fa fa-star-o" for="1"></label>
        <label class="star fa fa-star-o" for="2"></label>
        <label class="star fa fa-star-o" for="3"></label>
        <label class="star fa fa-star-o" for="4"></label>
        <label class="star fa fa-star-o" for="5"></label>

        <input type="hidden" id="rating" name="rating">
        <br><br>
        <!-- Hidden input to store the selected rating -->
        <textarea id="review" name="review" placeholder="Write your review here..." required></textarea>
        <br><br>
        <button type="submit" name="sub">Submit Review</button>
    </form>
</div>
</body>
</html>
