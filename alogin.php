<?php
session_start();  // Make sure to start the session

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id FROM adlog WHERE username=? AND password=? LIMIT 1");
    $stmt->bind_param("ss", $uname, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch the user ID from the result set
        $row = $result->fetch_assoc();

        // Store user ID in the session
        $_SESSION["aid"] = $row["id"];

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>
    <style>

body{
            background-image: url('img/homeservices.png');
         background-repeat: no-repeat;
         background-attachment: fixed;
              background-size: cover;

        }

        
              
              h2{        
        color: white; 
        font-size:25px;
        text-shadow: 3px 3px 6px #9966cc;
    }

         .full{
            position:center;
              height:450px;
              width:450px;
             margin-top:230px;
            background-color: rgba(221,160,221 0.2);
           border: 1px solid #9966cc;
          border-radius:20px;
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
          backdrop-filter: blur(20px);
    }
     .subm{
        height:40px;
        width:150px;
          border-radius: 30px;
        color:black;
        font-size: 20px;
         border:none;
         background-color: white;
         
         cursor: pointer;
     }

     .subm:hover{
        border-radius: 30px;
        box-shadow : 0 0 2px 2px  #9966cc;
        border: 1px solid white;
        background: transparent;
        color: black;
     }

    .input_box{
        height:50px;
        width:90%;
       margin: 30px 0;  
       position: relative;  

    }
       
    .input_box input{
           width: 90%;
           height: 100%;
           background: transparent;
           border:none;
           border: 2px solid #9966cc;          
           outline: none;
           border-radius:30px; 
           margin-right:10px;
           color: white;
           
        }
   
        .input_box input:hover{
            width: 90%;
           height: 100%;
           background: transparent;
           border:none;
           border-bottom: 3px solid #9966cc;          
           outline: none;
           border-left:0;
           border-right:0;
           border-top:0;
           margin-right:10px;
           color: white;
           font-size:28px;
        }

        .input_box input::placeholder{
        color: black;
        font-weight:bold;
        
    }

    .input_box i{
        color: black;
        font-size:28px;
        padding-top: -70px;
        padding-left:70%;
        transform: translateY(-140%);
        cursor: pointer;
    
    }

        </style>
 
</head>
<body>

        <center>
           <div class="full">
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <center><h2>Login</h2></center>
        
  

<div class="input_box">
    <input class="txt" type="text" id="username" name="username" placeholder="USERNAME" required> 
    <i class="fa fa-user-circle icon-inside"></i>
</div>
<br><br><br>

<div class="input_box">
    <input class="txt" type="password" id="password" name="password" placeholder="PASSWORD" required> 
    <i class="fa fa-eye icon-inside" id="togglePassword"></i>
    <i class="fa fa-eye-slash icon-inside" id="togglePassword" style="display:none;"></i>
    <br><br><br>
</div>

        <input type="submit" class="subm" value="Login">
        
        
    </form>

    </div>
</center>

<script>
document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const eye = document.getElementById('togglePassword');
    const slash = document.querySelector('#togglePassword.fa-eye-slash');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eye.style.display = 'none';
        slash.style.display = 'block';
    } else {
        passwordInput.type = 'password';
        eye.style.display = 'block';
        slash.style.display = 'none';
    }
});
</script>

</body>
</html>