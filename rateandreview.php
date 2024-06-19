<!DOCTYPE html>
<html>
<head>
    <title>HOME CARE HEROES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .query-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Center containers horizontally */
    gap: 20px;
}
.container-query {
    width: 30%; /* Adjust the width based on your design preference */
    margin: 20px;
    padding: 20px;
    color:white;
    background-color: #dda0dd;
    text-align: center;
    margin-top: 90px;
}
.star-rating {
        color: gold; /* Star color */
    }
    </style>
</head>
<body>
<?php include('sidebar.php'); ?>
<div id="mainContent" class="main-content">
<center><h1> RATINGS & REVIEW LIST</h1> </center>
    <div class="query-list">
        <?php
        include 'connection.php';
        // Fetch data from the database
        $sql = "SELECT booking_id, emp_name, rating, review, user, date FROM reviews";
        $result = $conn->query($sql);
        // Display data in a container
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='container-query'>";
                echo "<p> BOOKING ID: " . $row["booking_id"] . "</p>";
                echo "<p>EMPLOYEE NAME: " . $row["emp_name"] . "</p>";
                echo "<p>USER NAME: " . $row["user"] . "</p>";
                
                echo "<p>REVIEW: " . $row["review"] . "</p>";
                echo "<p>DATE: " . $row["date"] . "</p>";
                 // Generate stars based on rating
                 echo "<p class='star-rating'>";
                 for ($i = 0; $i < $row["rating"]; $i++) {
                     echo '<i class="fa fa-star"></i>';
                 }
                 echo "</p>";
                echo "</div>";
            }
        } else {
            echo "No data found.";
        }
        // Close the database connection
        $conn->close();
        ?>
    </div>
    </div>
</body>
</script>
</html>
