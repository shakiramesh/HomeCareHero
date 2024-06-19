<?php
// Include your database connection file or write the connection code here
include 'connection.php';
include 'common_function.php';
session_start();

// Assuming you have a database connection object named $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];

    // Check if the username exists in the user's table
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $username = $_POST['username'];
        $user_num = $_POST['user_num'];
        $user_message = $_POST['user_message'];
        $user_address = $_POST['user_address'];
        $user_ip = getIPAddress();
        $invoice_number = mt_rand();
        $status = 'confirm';
        $payment = 'Not Paid';

        if (isset($_GET['emp'])) {
            $emp_id = $_GET['emp'];
            $sql = "SELECT empid, name, service, cat FROM empregi WHERE empid=$emp_id";
            $result = $conn->query($sql);

            // Display data in a containers
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $emp_name = $row['name'];
                    $ser_id = $row['service'];
                    $cat_id = $row['cat'];

                    $sql = "INSERT INTO `bookings` (username, user_num, user_address, user_message, user_ip, emp_id, emp_name, invoice_number, status, cat_id,ser_id, payment,date ) 
                            VALUES ('$username', '$user_num', '$user_address', '$user_message', '$user_ip', $emp_id, '$emp_name', '$invoice_number', '$status', '$cat_id', '$ser_id', '$payment',now())";
                    $result_query = mysqli_query($conn, $sql);

                    // Additional processing if needed

                    echo "<p style='color: green;'>Form submitted successfully!</p>";
                }
            } else {
                echo 'No data for the specified employee ID.';
            }
        } else {
            // Continue with the form submission or other processing
            // For example, you can insert the data into the database
            echo "<p style='color: green;'>Form submitted successfully!</p>";
        }
    } else {
        echo "<p style='color: red;'>Username does not exist. Please choose a different username.</p>";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>HOME CARE HEROS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    form{
        border:1px solid black;
        width:600px;
        height:350px;
    }
    .bookdi{
        margin-top:20px;
    }
    </style>
</head>
<body>
    <?php include('header.php'); ?>

    <hr>
    <div class="name">BOOK A SERVICE</div>
    <hr>

    <div>
        <center>
            <form class="booking" method="post" action="">
                <div class="bookdi">
                <!-- Other form fields -->
                <label for="username">Name:</label>
                <input type="text" name="username" autocomplete="off" required="required"><br><br>

                <label for="user_num">Phonenumber:</label>
                <input type="text" name="user_num" autocomplete="off" required="required"><br><br>

                <label for="user_address">Address:
                    <textarea name="user_address"></textarea>
                </label> <br><br>

                <label for="user_message">Describe Your Problem:
                    <textarea name="user_message"></textarea>
                </label>

                <label for="paymode">Choose Paymode:
                      <input type="radio" id="mode" name="mode" value="offline">
                        <label for="paymode">offline</label> 
                            <input type="radio" id="mode" name="mode" value="online">
                              <label for="paymode">online</label>
                              </label>
                           <br><br>

                <input type="submit" name="bookservice" value="Book Now">
                </div>
            </form>
        </center>
        <br><br>
    </div>

    <hr>
    <?php include('footer.php'); ?>
</body>
</html>
