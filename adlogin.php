<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    $_SESSION["aid"]=$row["id"];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM adlog WHERE username=? AND password=? LIMIT 1");
    $stmt->bind_param("ss", $uname, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        echo "Logged in successfully";
        header("Location: admin.php");
        exit();
    } else {
        echo "Invalid username or password";
        exit();
    }

    // Close the prepared statement
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
     
              
              .h2{        
        color:#602f6b; 
        font-size:25px;
    }

         div{
            position:center;
              height:300px;
              width:350px;
             margin-top:230px;
            background-color: rgba(221,160,221 0.2);
           border: 3px solid #9966cc;
          border-radius:50px;
    }
     .subm{
        height:40px;
width:150px;
border-radius:10px;
color:black;
border:none;
background-color:#9966cc;
     }


    .txt{
        height:40px;
width:200px;
border-radius:10px;
color:black;
border:none;

background-color:#e6e6fa;

    }


        </style>
 
</head>
<body>

        <center>
           <div>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <center><h2>Login</h2></center>
        
        <input class="txt" type="text" id="username" name="username" placeholder="USERNAME" required><br><br><br>

        <input class="txt" type="password" id="password" name="password"  placeholder="PASSWORD" required><br><br><br>

        <input type="submit" class="subm" value="Login">
    </form>

    </div>
</center>
</body>
</html>
