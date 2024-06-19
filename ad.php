<?php
// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = ""; // Replace with your DB password
$dbname = "homecare";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT emp_name, COUNT(*) as booking_count FROM bookings GROUP BY emp_name";
$result = $conn->query($sql);

$data = [];
while($row = $result->fetch_assoc()) {
    $data[$row['emp_name']] = $row['booking_count'];
}

// SQL query to count monthly bookings
$sql_monthly = "SELECT COUNT(*) as monthly_count, MONTH(date) as month FROM bookings WHERE YEAR(date) = YEAR(CURDATE()) GROUP BY MONTH(date)";
$result_monthly = $conn->query($sql_monthly);

$monthly_data = [];
while($row = $result_monthly->fetch_assoc()) {
    $monthly_data[$row['month']] = $row['monthly_count'];
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Chart</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <style>
 
    </style>
</head>
<body>

<canvas id="bookingChart" ></canvas>

<script>
var ctx = document.getElementById('bookingChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode(array_keys($data)); ?>,
        datasets: [{
            label: 'Bookings',
            data: <?php echo json_encode(array_values($data)); ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

<canvas id="monthlyBookingsChart" width="400" height="400"></canvas>

<script>
var ctx = document.getElementById('monthlyBookingsChart').getContext('2d');
var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Monthly Bookings',
            data: [
                <?php echo implode(',', $monthly_data); ?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)',
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)'
            ],
            borderWidth: 1
        }]
    }
});
</script>

</body>
</html>
