   
<?php
include 'connection.php';

if(isset($_POST['submit'])) {
    $name = $_POST['name'];        
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Check for a successful database connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO query (name, email, message) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Your query has been saved.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

