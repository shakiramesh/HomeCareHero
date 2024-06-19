<?php
   include 'connection.php';
   include 'common_function.php';
session_start(); // Start the session (if not started already)

if(isset($_POST['userreg'])) {

    $username = $_POST['username'];        
    $usergender = $_POST['usergender'];
    $user_ph_num = $_POST['user_ph_num'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_pass = $_POST['user_pass'];
    $user_ip = getIPAddress();

    $myfile= $_FILES['myfile'];
    $imagefilename=$myfile['name'];    
    echo "<br>";
    $imagefileerror=$myfile['error'];   
    echo "<br>";
    $tmpimage=$myfile['tmp_name'];   
     echo "<br>";
     $filenamesep=explode('.',$imagefilename);
    echo "<br>";
   $filext=strtolower(end($filenamesep));
      $extension=array('jpeg','jpg','png');
      if(in_array($filext,$extension)){
        $uploadimg='userimg/'.$imagefilename;
        move_uploaded_file($tmpimage,$uploadimg);

      //cheacking if username is already existing or not

       $check_query="SELECT * FROM users WHERE username = '$username' or user_pass ='$user_pass'";
       $result = mysqli_query($conn,$check_query);
        $rows_count = mysqli_num_rows($result);
        if($rows_count>0){
            echo"USERNAME OR PASSWORD ALREADY EXISTED";
        }
        else{
              // Use prepared statement to prevent SQL injection
         $sql = "INSERT INTO `users` (username, usergender, user_ph_num, user_email, user_address ,user_ip, user_pass, image) 
         VALUES ( '$username', '$usergender', '$user_ph_num', '$user_email', '$user_address', '$user_ip','$user_pass', '$uploadimg')";        
         $result_query = mysqli_query($conn,$sql);
        // if($result_query){
          // echo"succesfully registered";
        // }
        // else{
          //  die(mysqli_error($conn));
        // }

        } 
          //$_SESSION['user_name']=$username;
      } }
    // Close the database connection
    mysqli_close($conn);
    ?>
<!DOCTYPE html>
<html>
<head>
<title>HOME CARE HEROS</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="carestyles.css">
<style>
  .mor {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.put {
    width: 90%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

textarea.put {
    width: 90%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical; /* Allow vertical resizing of textarea */
}

.sub {
    width: 60%;
    padding: 10px;
    margin-top: 10px;
    background-color: #9370db;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.sub:hover {
    background-color: #7851a9;
}

.line {
    margin-top: 20px;
    text-align: center;
}

.line a {
    color: #007bff;
    text-decoration: none;
}

.line a:hover {
    text-decoration: underline;
}

.modal {
  display: none; /* Hidden by default */
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.7); /* Black background with opacity */
}

.modal-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
}

.close {
  position: absolute;
  top: 10px;
  right: 20px;
  color: #aaa;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


</style>
</head>

<body>
<?php include('headerpage.php'); ?>

<div class="name">REGISTER AS A USER</div>
<hr>
<div class="">
    <center>
<form class="mor" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<center> <h1> Register Form</h1></center>
    <input class="put" type="text" name="username" placeholder="username"autocomplete="off" required="required"><br><br>

    <label for="usergender">Gender:</label>
    <input type="radio" name="usergender" value="male"  required> Male
    <input type="radio" name="usergender" value="female" required> Female<br><br>

    <input class="put" type="text" name="user_ph_num" placeholder="Phonenumber" autocomplete="off" required="required"><br><br>

    <input class="put" type="text" name="user_email" placeholder="E-mail" autocomplete="off" required="required"><br><br>

    <label for="myfile">Select a file:</label>
   <input type="file" id="image" name="image"><br><br>

   <textarea class="put" name="user_address" placeholder="Address"></textarea> <br><br>

    <input class="put" type="text" name="user_pass" placeholder="Password"autocomplete="off" required="required"><br><br>
    <br><br>
        <input class="sub" type="submit" name="userreg" value="REGISTER">

        <p class="line">Already have an account? <a href="user_login.php">Login here</a></p>
    </form>
   
    </center>
    <br><br>
</div>
<div id="successModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Successfully registered! Redirecting you...</p>
  </div>
</div>

<hr>
<?php include('footer.php'); ?>
</body>
<script>
    $(document).ready(function() {
  <?php if(isset($_POST['userreg']) && $result_query) { ?>
    // Display the modal
    $("#successModal").show();

    // Close the modal when close button is clicked
    $(".close").click(function() {
      $("#successModal").hide();
    });

    // Redirect to user_bookings.php after 3 seconds
    setTimeout(function() {
      window.location.href = 'user_bookings.php';
    }, 3000);
  <?php } ?>
});

    </script>
</html>


