<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME CARE HEROS</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="lrstyle.css">
</head>
<body>

<?php include('headerpage.php'); ?>


<?php
         include 'connection.php';
         include 'common_function.php';
      @session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        // Handle login
        // Redirect or display appropriate messages after handling
        if(isset($_POST['username'])){
            $uname=$_POST['username'];
            //$pass=$_POST['password'];
            $user_pass = $_POST['user_pass']; 
    
            $sql="select * from users where username='".$uname."'AND user_pass='".$user_pass."' limit 1";          
        
            
            $result = mysqli_query($conn, $sql);
    
            if(mysqli_num_rows($result) > 0){
                $_SESSION['user_name'] = $uname;
                
                // Fetch the results into $row
                $row1 = mysqli_fetch_assoc($result);
            
                $userid = $row1['userid'];

                $_SESSION['userid'] = $userid;

            echo ".$userid.";
                echo"<script>window.open('try.php?user=$userid')</script>";
                exit();
            }
            
            else {
                echo "Invalid username or password";
                exit();
            }
       
        } 

    } elseif (isset($_POST['register'])) {
        // Redirect or display appropriate messages after handling
        
    $username = $_POST['username'];        
    $usergender = $_POST['usergender'];
    $user_ph_num = $_POST['user_ph_num'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_pass = $_POST['user_pass'];
    $user_ip = getIPAddress();

      //cheacking if username is already existing or not

       $check_query="SELECT * FROM users WHERE username = '$username' or user_pass ='$user_pass'";
       $result = mysqli_query($conn,$check_query);
        $rows_count = mysqli_num_rows($result);
        if($rows_count>0){
            echo"USERNAME OR PASSWORD ALREADY EXISTED";
        }
        else{
              // Use prepared statement to prevent SQL injection
         $sql = "INSERT INTO `users` (username, usergender, user_ph_num, user_email, user_address ,user_ip, user_pass) 
         VALUES ( '$username', '$usergender', '$user_ph_num', '$user_email', '$user_address', '$user_ip','$user_pass')";        
         $result_query = mysqli_query($conn,$sql);
        if($result_query){
           echo"succesfully registered";
        }
        // else{
          //  die(mysqli_error($conn));
        // }

        } 
          //$_SESSION['user_name']=$username;
      }
    // Close the database connection
    mysqli_close($conn);
    
}
?>

            
<div class="space">
       <div class="log_reg">    
                    <div class="btn_tog">
                        <div id="act_btn"></div>
             <button class="togglebtn" onclick="toggleForm('login')">Login</button>
              <button class="togglebtn" onclick="toggleForm('register')">Register</button>
                      </div>
             
                      <div id="loginForm">
  <center>  <h3>Login Form</h3> </center>
    <form action="" method="post" class="input_grp">
        <!-- Login form fields here -->
                
    <input type="text" name="username" class="input_field" autocomplete="off" required="required" placeholder="Username"><br><br>


    <input type="text" name="user_pass" class="input_field"autocomplete="off" required="required" placeholder="Password"><br><br>
       
    <input type="submit" class="sub_btn" name="login" value="Login">
    </form>
</div>

<div id="registerForm" style="display:none;">
   <center> <h3>Registration Form</h3> </center>
    <form action="" method="post" class="input_grp">
        <!-- Registration form fields here -->
    
    <input type="text" name="username" class="input_field" autocomplete="off" required="required" placeholder="Username" ><br><br>

    <label for="usergender">Gender:</label>
    <input type="radio" name="usergender" value="male"  required> Male
    <input type="radio" name="usergender" value="female" required> Female<br><br>


    <input type="text" name="user_ph_num" class="input_field" autocomplete="off" required="required" placeholder="Phone Number"><br><br>

    
    <input type="text" name="user_email" class="input_field"  autocomplete="off" required="required" placeholder="Email"><br><br>

    
         <textarea id="w3review" name="user_address" class="input_field" placeholder="Address"  placeholder="type your query here" rows="4" cols="50"></textarea><br><br>
    </label> <br><br>   


    <input type="text" name="user_pass" class="input_field" autocomplete="off" required="required" placeholder="Password"><br><br>
    <br><br>
       
        <input type="submit" class="sub_btn" name="register" value="Register">
    </form>
</div>

    </div>
</div>
    <hr>
<?php include('footer.php'); ?>

<script>
let activePosition = 'login'; // Initially set to 'login'

function toggleForm(formType) {
    if (formType === 'login' && activePosition !== 'login') {
        document.getElementById('loginForm').style.display = 'block';
        document.getElementById('registerForm').style.display = 'none';
        document.getElementById('act_btn').style.left = '0';
        activePosition = 'login';
    } else if (formType === 'register' && activePosition !== 'register') {
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('registerForm').style.display = 'block';
        document.getElementById('act_btn').style.left = '110px';
        activePosition = 'register';
    }
}

</script>

</body>
</html>
