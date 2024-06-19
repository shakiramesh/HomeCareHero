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
        while ($row2 = $result->fetch_assoc()) {
            $users_id = $row2['userid'];
        $username = $_POST['username'];
        $user_num = $_POST['user_num'];
        $user_message = $_POST['user_message'];
        $user_address = $_POST['user_address'];
        $paymode = $_POST['paymode'];
        $user_ip = getIPAddress();
        $invoice_number = mt_rand();
        $status = 'confirm';
        $payment = 'Not Paid';
        $hour = $_POST['hour'];
        $rate = 250; // Rate per hour

        // Calculate the amount
        $amount = $hour * $rate;
        

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

                    $sql = "INSERT INTO `bookings` (username, user_num, user_address, user_message, user_ip, emp_id, emp_name, invoice_number, status, cat_id,ser_id, payment, date, users_id,paymode, hour, amount ) 
                            VALUES ('$username', '$user_num', '$user_address', '$user_message', '$user_ip', $emp_id, '$emp_name', '$invoice_number', '$status', '$cat_id', '$ser_id', '$payment',now(), '$users_id', '$paymode', '$hour', '$amount')";
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
    } }else {
        echo "<p style='color: red;'>Username does not exist. Please choose a different username.</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME CARE HEROS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
  

        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .bookdi input[type="text"],
        .bookdi textarea,
        .bookdi select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .bookdi input[type="radio"] {
            margin-right: 5px;
            margin-bottom: 15px;
        }

        .bookdi input[type="submit"] {
            background-color: #9370db;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .bookdi input[type="submit"]:hover {
            background-color: #7851a9;
        }


        .name {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .put {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

    </style>
</head>

<body>
    <?php include('headerpage.php'); ?>
    
        <div class="name">BOOK A SERVICE</div>
        
<hr>
    <div class="container">
        <center><h1> BOOKING FORM</h1></center>

        <center>
            <form class="booking" method="post" action="">
                <div class="bookdi">
                    <input type="text" name="username" autocomplete="off" required="required" placeholder="Name">

                    <input type="text" name="user_num" autocomplete="off" required="required" placeholder="Phonenumber">

                    <textarea class="put" name="user_address" placeholder="Address"></textarea>

                    <textarea class="put" name="user_message" placeholder="Describe Your Problem"></textarea>

                    <label for="paymode">Choose Payment Mode:</label>
                    <input type="radio" id="offline" name="paymode" value="offline">
                    <label for="offline">Offline</label>
                    <input type="radio" id="online" name="paymode" value="online">
                    <label for="online">Online</label> 
                <br>
                    
                    <select name="hour" id="hour">
                    <option value="">Choose Hours</option>
                        <option value="1">1 HOUR</option>
                        <option value="2">2 hours</option>
                        <option value="3">3 hours</option>
                        <option value="4">4 hours</option>
                    </select>

                    <input type="submit" name="bookservice" value="Book Now">
                </div>
            </form>
        </center>
    </div>

    <hr>
    <?php include('footer.php'); ?>
</body>

</html>
