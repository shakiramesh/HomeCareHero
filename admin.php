<?php
session_start();
include 'connection.php';

if(!isset($_SESSION["aid"]))
{
  header("location:alogin.php");
}

$sql = "SELECT COUNT(*) as paid_count FROM bookings WHERE payment = 'Paid'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$paid_count = $row['paid_count'];

///////////////////////////////////////

$sql_male = "SELECT COUNT(*) as male_count FROM empregi WHERE gender = 'male'";
$sql_female = "SELECT COUNT(*) as female_count FROM empregi WHERE gender = 'female'";
$sql_total = "SELECT COUNT(*) as total_count FROM empregi";

$result_male = $conn->query($sql_male);
$result_female = $conn->query($sql_female);
$result_total = $conn->query($sql_total);

$row_male = $result_male->fetch_assoc();
$row_female = $result_female->fetch_assoc();
$row_total = $result_total->fetch_assoc();

$male_count = $row_male['male_count'];
$female_count = $row_female['female_count'];
$total_count = $row_total['total_count'];

//////////////////////////////////

$sql_daily = "SELECT COUNT(*) as daily_count FROM bookings WHERE DATE(date) = CURDATE()";
$sql_monthly = "SELECT COUNT(*) as monthly_count FROM bookings WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";

$result_daily = $conn->query($sql_daily);
$result_monthly = $conn->query($sql_monthly);

$row_daily = $result_daily->fetch_assoc();
$row_monthly = $result_monthly->fetch_assoc();

$daily_count = $row_daily['daily_count'];
$monthly_count = $row_monthly['monthly_count'];

// Query to count total number of users
$sql_total_users = "SELECT COUNT(*) as total_users FROM users";
$result_total_users = $conn->query($sql_total_users);
$row_total_users = $result_total_users->fetch_assoc();
$total_users = $row_total_users['total_users'];

// Query to count number of male and female users
$sql_gender_users = "SELECT usergender, COUNT(*) as gender_count FROM users GROUP BY usergender";
$result_gender_users = $conn->query($sql_gender_users);

$gender_data = [];
while($row = $result_gender_users->fetch_assoc()) {
    $gender_data[$row['usergender']] = $row['gender_count'];
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<title>HOME CARE HEROS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  

    .one{
      margin-left: 250px;
   
    }

    .count{
           height: 150px;
          
           width: 75%;
           margin-left: 150px;
           margin-top: 50px;
           display: flex;          /* This makes it a flex container */
    flex-direction: row; /* Stack children vertically */
    align-items: center;
    gap: 70px;              /* Spacing between flex items */
    padding: 20px; 
    }

    .graph{
      height: 300px;
           background-color: white;
           width: 75%;
           margin-left: 150px;
           margin-top: 50px;
           display: flex;  
    }

    #paidCountContainer{
      background-color: #6082b6;
      height: 190px;
        text-align: center;
           width: 350px;
           color: white;
           border: 1px solid black;
           border-radius: 10px;
           display: inline-block;
    }

    #employeeCountContainer{
      background-color: #00fa9a;
      height: 190px;
        text-align: center;
           width: 350px;
           color: white;
           border: 1px solid black;
        
           display: grid;
  place-items: center;
    }

    #bookingCountContainer{
      
      background-color: #0072bb;
      
      height: 190px;
        text-align: center;
           width: 350px;
          color: white;
           border: 1px solid black;
           border-radius: 10px;
           display: grid;
  place-items: center;
    }

    #userCountContainer{
      background-color: #ea3c53 ;
      height: 190px;
        text-align: center;
           width: 350px;
          
           border: 1px solid black;
           border-radius: 10px;
           display: grid;
  place-items: center;
  color: white;
    }
    h3{
       
    }
  p{
  width: 22ch;
  animation: typing 2s steps(22), blink .5s step-end infinite alternate;
  white-space: nowrap;
  overflow: hidden;
  font-size: 20px;
  font-family: monospace;

}

@keyframes typing {
  from {
    width: 0
  }
}
    


    </style>
</head>
<body>
<?php include('sidebar.php'); ?>
  <div class="one">

  <div class="count">
  <div id="paidCountContainer">
    <h3>Total Payments: <?php echo $paid_count; ?></h3>
</div>

<div id="employeeCountContainer">
    <h3>Employee Counts</h3>
    <p>Total Employees: <?php echo $total_count; ?></p>
    <p>Male Employees: <?php echo $male_count; ?></p>
    <p>Female Employees: <?php echo $female_count; ?></p>
</div>

  </div>
<div class="count">
<div id="bookingCountContainer">
    <h3>Booking Counts</h3>
    <p>Bookings Today: <?php echo $daily_count; ?></p>
    <p>Bookings This Month: <?php echo $monthly_count; ?></p>
</div>

<div id="userCountContainer">
    <h3>User Counts</h3>
    <p>Total Users: <?php echo $total_users; ?></p>
    <p>Male Users: <?php echo isset($gender_data['male']) ? $gender_data['male'] : 0; ?></p>
    <p>Female Users: <?php echo isset($gender_data['female']) ? $gender_data['female'] : 0; ?></p>
</div>
  </div>
  
  <hr>
    <div class=" graph">
    <?php include('ad.php'); ?>
  </div>
  </div>

</body>
</html>


