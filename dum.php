<?php
include 'connection.php';
include 'common_function.php';
session_start();

function isRegistered($username) {
  global $conn; // Assuming $conn is established in db_connect.php
  $sql = "SELECT * FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $count = $result->num_rows;
  return ($count > 0);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];

  // Validate username
  if (empty($username) || strlen($username) < 3 || strlen($username) > 20) {
    echo "<p style='color: red;'>Username must be between 3 and 20 characters.</p>";
    exit;
  }

  if (!isRegistered($username)) {
    echo "<p style='color: red;'>User is not registered. Please <a href='user_registration.php'>register </a>before booking a service.</p>";
    exit;
  }

  $user_num = $_POST['user_num'];
  // Validate phone number
  if (empty($user_num) || !preg_match('/^[0-9]+$/', $user_num)) {
    echo "<p style='color: red;'>Invalid phone number format.</p>";
    exit;
  }

  $user_message = strip_tags($_POST['user_message']); // Sanitize message
  $user_address = strip_tags($_POST['user_address']); // Sanitize address

  $user_ip = getIPAddress();

  if (isset($_GET['emp'])) { // Use 'emp' instead of 'empname' for consistency
    $emp_id = $_GET['emp'];

    // Fetch empname from empregi table
    $sql_emp = "SELECT empid, name FROM empregi WHERE empid = ?";
    $stmt_emp = $conn->prepare($sql_emp);
    $stmt_emp->bind_param("s", $emp_id);
    $stmt_emp->execute();
    $result_emp = $stmt_emp->get_result();

    if ($result_emp->num_rows > 0) {
      $row_emp = $result_emp->fetch_assoc();
      $empname = $row_emp['name'];

      // Insert booking
      $sql_booking = "INSERT INTO `bookings` (username, user_num, user_address, user_message, user_ip, emp_id, emp_name) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
      $stmt_booking = $conn->prepare($sql_booking);
      $stmt_booking->bind_param("sssssss", $username, $user_num, $user_address, $user_message, $user_ip, $emp_id, $empname);
      $stmt_booking->execute();

      if ($stmt_booking->affected_rows > 0) { // Check if booking inserted successfully
        echo "Booking successfully stored.";
      } else {
        echo "Booking failed. Please try again.";
      }
    } else {
      die(mysqli_error($conn)); // Display MySQL error message
    }
  }
}

$conn->close(); // Close database connection
?>

<!DOCTYPE html>
<html>
<head>
    <title>HOME CARE HEROS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="carestyles.css">
</head>
<body>
    <?php include('header.php'); ?>

    <hr>
    <div class="name">BOOK A SERVICE</div>
    <hr>

    <div>
        <center>
            <form method="post" action="dum.php">
                <label for="username">Name:</label>
                <input type="text" name="username" autocomplete="off" required="required"><br><br>

                <label for="user_num">Phonenumber:</label>
                <input type="text" name="user_num" autocomplete="off" required="required"><br><br>

                <label for="user_address">Address:
                    <textarea name="user_address"></textarea>
                </label> <br><br>

                <label for="user_message">Message:
                    <textarea name="user_message"></textarea>
                </label>
                <br><br>

               

                <input type="submit" name="bookservice" value="Book Now">
            </form>
        </center>
        <br><br>
    </div>

    <hr>
    <?php include('footer.php'); ?>
</body>
</html>
