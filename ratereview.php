<?php
session_start();
include 'connection.php';


if (isset($_SESSION['bid'])) {
    $beid = $_SESSION['bid'];
    $sql = "SELECT bookid, emp_name, username FROM bookings WHERE bookid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $beid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $emp_name = $row['emp_name'];
        $user_name = $row['username'];
    } else {
        die("Booking ID not found.");
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    
    $insertsql = "INSERT INTO `reviews` (booking_id, emp_name, rating, review, user, date) VALUES (?, ?, ?, ?, ?, now())";
    $stmt = $conn->prepare($insertsql);
    $stmt->bind_param("issss", $beid, $emp_name, $rating, $review, $user_name); // Assuming 'booking_id' is of type integer. Adjust if not.
    
    if ($stmt->execute()) {
        echo "<p style='color: green;'>Form submitted successfully!</p>";
        echo "<p>EXPERT IN: " . $beid . "</p>";
    } else {
        die("Prepare failed: " . $stmt->error);
    }
    $stmt->close();
}

mysqli_close($conn);
?>

<!-- ... [rest of your HTML code] ... -->

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
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .rating {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .star {
            font-size: 24px;
            color: #b19cd9;
            cursor: pointer;
            transition: color 0.3s;
        }

        .star:hover,
        .star.active {
            color: #6a0dad;
        }

        textarea {
            width: 90%;
            padding: 15px;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            resize: vertical;
        }

        button {
            display: block;
            margin: 30px auto 0;
            background-color: #6a0dad;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #4b086d;
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