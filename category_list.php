<!DOCTYPE html>
<html>

<head>
    <title>HOME CARE HEROS</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="carestyles.css">
    <style>
        .ser-list {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-left: -40px;
            margin-right: 80px;
        }

        .con-data {
            width: 210%;
            margin: 20px;
            padding: 20px;
            background-color: #e6e8fa;
            text-align: center;
            border-radius: 20px;
            border: 1px solid black;                   
        }

        .emp-img {
            height: 100px;
            border-radius: 50px;
            float: left;
        }

        .ser-list {
            height: auto;
        }

      a{
        text-decoration: none;
      }

        p {
            margin-left: -20px;
        }

       button {
    float: right;
     margin-top: -70px;
    background-color: white; 
    color: purple; 
    padding: 10px 20px; 
    border: 1px solid purple; 
    border-radius: 5px; 
    cursor: pointer; 
    transition: background-color 0.3s; 
    font-weight: bold;
    }

      button:hover {
    background-color: #9678b6; 
    color: white;
    }

   .rate {
    margin-top: 10px; 
    text-align: center;    }

         .rate a{
    color: #6a0dad;
    transition: color 0.3s; 
    background-color: white;
    border-radius: 20px;
    border: 1px solid black;
    cursor: pointer; 
    transition: background-color 0.3s; 
    font-weight: bold;
    padding: 8px 6px; 
         }
          .rate a:hover {
    color: white;
    background-color: #9678b6;
       }

      .ts-container {
   margin-left: -350px;
   
    }

    h1{
        text-align: center;
    }
    .star{
        color: gold;
    }
    </style>
</head>

<body>
    <?php include('headerpage.php'); ?>

    <div>
        <h1> BOOK SERVICE</h1>
</div>
  
    <div class="ser-list">      
      <div class="ts-container">
            <div class="move">
            <?php
            include 'connection.php';
               // ... [previous code remains unchanged]
        

         if (isset($_GET['service'])) {
    $service = $_GET['service'];
    $_SESSION['service'] = $service;

    $name = isset($_GET['name']) ? $_GET['name'] : '';
    $empid  = isset($_GET['empid']) ? $_GET['empid'] : '';

    // Use a prepared statement
    $stmt = $conn->prepare("SELECT empid, name, ph_num, service, cat, myfile FROM empregi WHERE service=?");
    $stmt->bind_param("s", $service);  // Assuming 'service' is a string. Use "i" if it's an integer.
    $stmt->execute();
    $result = $stmt->get_result();

    // Display data in containers
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cat = $row['cat'];
            $_SESSION['cat'] = $cat;
            $empid = $row['empid'];
            $imageSource = $row['myfile'];
            $name = $row['name'];

                   // Fetch average rating for the employee
$stmt = $conn->prepare("SELECT AVG(rating) as avg_rating FROM reviews WHERE emp_name=?");
$stmt->bind_param("s", $name);
$stmt->execute();
$resultRating = $stmt->get_result();

$avgRating = 0;
if ($resultRating->num_rows > 0) {
    $rowRating = $resultRating->fetch_assoc();
    $avgRating = $rowRating['avg_rating'];
}

$stars = str_repeat('<i class="fa fa-star"></i>', round($avgRating));

            echo "<div class='con-data'>";
            echo '<img src="' . $imageSource . '" alt="Avatar" class="emp-img" style="width:100px"/>';
            echo "<p>NAME: " . $row["name"] . "</p>";
            echo "<p>CONTACT: " . $row["ph_num"] . "</p>";
            echo "<p>EXPERT IN: " . $cat . "</p>";
            $_SESSION['emp'] = $empid;
            echo "<button><a href='booking_form.php?emp=$empid'>BOOK NOW</a></button>";
            echo "<p class='rate'><a href='charges.php'>View price charges<i class='fa fa-arrow-right'></i></a></p>";
            echo "<p class='star'>RATINGS:$stars</p>"; 
            echo "</div>";
        }
    } else {
        echo "No data found.";
    }

    $stmt->close();  // Close the prepared statement
    $conn->close();
        } else {
    echo "No data found.";
        }
            ?>
        </div>
    
    </div>
    </div>

    <hr>
    <?php include('footer.php'); ?>
</body>

</html>
