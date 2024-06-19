<?php
// Include database connection
include 'connection.php';

// Check if the empid parameter is set in the URL
if (isset($_GET['deid'])) {
    $empid = $_GET['deid'];

    // Prepare a DELETE statement
    $sql = "DELETE FROM empregi WHERE empid = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("i", $empid);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the employee details page after deletion
        header("Location: emplist.php");
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
