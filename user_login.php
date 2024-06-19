<?php
   include 'connection.php';
   include 'common_function.php';
session_start(); // Start the session (if not started alrea

    if(isset($_POST['username'])){
        $uname=$_POST['username'];
        //$pass=$_POST['password'];
        $user_pass = $_POST['user_pass']; 

        $sql="select * from users where username='".$uname."'AND user_pass='".$user_pass."' limit 1";      
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            $_SESSION['user_name'] = $uname;
            
            // Fetch the results into $row
            $row = mysqli_fetch_assoc($result);
        
            $userid = $row['userid'];
            $_SESSION['userid'] = $userid;
            //echo "loginned succesfully";
            echo"<script>window.open('user_bookings.php')</script>";
            exit();
        }
        
        else {
            echo "Invalid username or password";
            exit();
        }
    } 
    $conn->close();

?>

<!DOCTYPE html>
<html>
<head>
<title>HOME CARE HEROS</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="carestyles.css">
<style>
      form.mor {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            margin: 0 auto;
        }

        .put {
            width: 90%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .sub {
            background-color: #9370db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .sub:hover {
            background-color: #7851a9;
        }

        p.line {
            margin-top: 20px;
            text-align: center;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }


    </style>
</head>

<body>
<?php include('headerpage.php'); ?>

<div class="name">LOGIN</div>
<hr>
<div class="">
    <center>
<form class="mor" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <center> <h1> Login Form</h1></center>
    <input class="put" type="text" name="username" autocomplete="off" placeholder="Name" required="required"><br><br>


    
    <input class="put" type="text" name="user_pass" autocomplete="off" placeholder="Password" required="required"><br><br>

        <input class="sub" type="submit" name="userlog" value="LOGIN">

        <p class="line">Don't have an account? <a href="user_registration.php">Register here</a></p>
    </form>
 
    </center>
    <br><br>
</div>

<hr>
<?php include('footer.php'); ?>
</body>

</html>


