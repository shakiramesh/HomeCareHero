<?php
  header('content-type: application/json');

include 'connection.php'; // Ensure this file connects to your database

$query = "SELECT date, emp_name FROM bookings ORDER BY date ASC";
$result = mysqli_query($conn, $query);

$data = [];
    foreach ($result as $row){
        $data[] = $row;
    }
  


 $result->close();
  print json_encode($data);
?>
