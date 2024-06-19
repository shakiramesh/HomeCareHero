<!DOCTYPE html>
<html>
<head>
<title>HOME CARE HEROS</title>

<meta
 
name="viewport"
 
content="width=device-width, initial-scale=1">


<link
 
rel="stylesheet"
 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link
 
rel="stylesheet"
 
href="carestyles.css">
<style>
    a{
        text-decoration: none;
    }
    </style>
</head>

<body>
<?php include('headerpage.php'); ?>



<div class="name">OUR SERVICES</div>

<hr>

<div class="service-list">
<div class="pro">

<?php
include 'connection.php';

$sql = "SELECT * FROM addservice";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $imageSource = $row['serimg'];
        $serviceid = $row['serviceid'];
        $service_name = $row['name'];
        
        echo "<a href='category_list.php?service=$service_name'>";
        $_SESSION['service'] = $service_name;
        echo '<div class="card">';
echo '<img src="' . $imageSource . '" alt="Avatar" style="width:100%"/>';
        echo '<div class="container">';
        echo '<h4>' . $row['name'] . '</h4>';
       
        echo '</div>';
        echo '</div>';

        echo '</a>';
       
    }
} else {
    echo "NO DATA FOUND";
}

mysqli_close($conn);
?>
</div>
</div>

<hr>
<?php include('footer.php'); ?>
</body>
</html>