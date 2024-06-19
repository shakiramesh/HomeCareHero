<?php
// Include necessary files and initialize session
include 'connection.php';
session_start();

// Include Twilio PHP SDK
require_once 'your folder path of twilio auoload.php';

use Twilio\Rest\Client;

// Your Twilio credentials
$accountSid = 'our account id'
$authToken  = 'your auth token'
$twilioNumber = 'your twilio number'

// Initialize Twilio client
$client = new Client($accountSid, $authToken);

$response = ['success' => false];

if (isset($_GET['bid'])) {
    $bookid = $_GET['bid'];
    $_SESSION['bookid'] = $bookid;

        // Fetch booking details
        $sql1 = "SELECT * FROM bookings WHERE bookid=?";
        $stmt = $conn->prepare($sql1);
        $stmt->bind_param("i", $bookid);
        $stmt->execute();
        $result_pay = $stmt->get_result();
        $row2 = $result_pay->fetch_assoc();
        $username = $row2['username'];
        $invoice = $row2['invoice_number'];
        $payment = $row2['payment'];
        $cat = $row2['cat_id'];
        $amount = $row2['amount'];
    
        // Fetch user email
        $sql2 = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->prepare($sql2);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result_cancel = $stmt->get_result();
        $row3 = $result_cancel->fetch_assoc();
        $email = $row3['user_email'];
        $phnum = $row3['user_ph_num'];

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = $_POST['bookid'];
    $user = $_POST['user'];
    $reason = $_POST['reason'];

    // Insert into cancel order table (as per your requirement)
    $sqlcancel = "INSERT INTO `cancelorder` (user, bookid, reason) 
    VALUES ('$user', '$bookid', '$reason')";
    $cancel_query = mysqli_query($conn, $sqlcancel);

        // Update the booking status to "Cancel" in the database
        $sql = "UPDATE bookings SET status='Cancel' WHERE bookid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $bookId);

    // Send SMS using Twilio
    //LQ86YB1YP7C2RL6H93UD9ZB3
    //Auth Token-592deefde26a5b864d1e28f166c9bdbd  ; Account SID -ACf2c9233119493d1bf96906d9a46701c3;
    try {
        $message = $client->messages->create(
            $phnum,
            [
                'from' => $twilioNumber,
                'body' => 'Your booking has been cancelled. Reason: ' . $reason
            ]
        );
        $response['success'] = true;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- ... (rest of your HTML code for form) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        textarea {
            width: 90%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .put {
            width: 90%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

    </style>
</head>
<body>
    <!-- Cancel Order Form -->
    <form method="post" action="">
        <input type="hidden" name="bookid" value="<?php echo $bookid ?>">
        <label>User: </label><input type="text" name="user" value="<?php echo $username ?>"><br>
        <label>Amount: </label><input type="text" name="amount" value="<?php echo $amount ?>"><br>
        <label>Reason: </label><textarea class="put" name="reason" placeholder="Describe why you are cancelling"></textarea><br>
        <input type="submit" name="cancel_order" value="Cancel Order">
    </form>

    <script>
        document.querySelector("form").addEventListener("submit", function(e) {
            e.preventDefault();
            if (confirm("Are you sure you want to cancel this booking?")) {
                this.submit();
            }
        });
    </script>
</body>
</html>


