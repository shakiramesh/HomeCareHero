<?php
include 'connection.php';
include 'common_function.php';
session_start();
error_reporting(E_ALL);


if (isset($_GET['bid'])) {
    $_SESSION['bid'] = $_GET['bid'];
}
if (isset($_SESSION['bid'])) {
    $beid = $_SESSION['bid'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rating = $_POST['rating'];
        $review = $_POST['review'];

        // Using prepared statements to avoid SQL injection
        $stmt = $conn->prepare("SELECT emp_name FROM bookings WHERE bookid=?");
        $stmt->bind_param("i", $beid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $emp_name = $row['emp_name'];

            $insertstmt = $conn->prepare("INSERT INTO `reviews` (booking_id, emp_name, rating, review, date) VALUES (?, ?, ?, ?, now())");
            if ($insertstmt) {
                $insertstmt->bind_param("isss", $beid, $emp_name, $rating, $review);
                if ($insertstmt->execute()) {
                    echo "Review inserted successfully!";
                } else {
                    die("Insert failed: " . $insertstmt->error);
                }
            } else {
                die("Prepare failed: " . $conn->error);
            }
        } else {
            die("No rows found for the given booking ID.");
        }
        $stmt->close();
    }
}

mysqli_close($conn);
?>

<!-- [Rest of your HTML remains unchanged] -->
<!-- [Rest of your HTML remains unchanged] -->
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="ratescript.js"></script>
    <title>Product Review Form</title>
  <style>
 body {
        
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

