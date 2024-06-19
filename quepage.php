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
    </style>
</head>
<body>
<?php include('sidebar.php'); ?>
<div id="mainContent" class="main-content">
<center><h1> QUERY LIST</h1></center>
    <div class="query-list">
        <?php
        include 'connection.php';
        // Fetch data from the database
        $sql = "SELECT id, name, email, message FROM query";
        $result = $conn->query($sql);
        // Display data in a container
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='container-query'>";
                echo "<p>ID: " . $row["id"] . "</p>";
                echo "<p>NAME: " . $row["name"] . "</p>";
                echo "<p>EMAIL: " . $row["email"] . "</p>";
                echo "<p>MESSAGE: " . $row["message"] . "</p>";
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
