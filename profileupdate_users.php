
<?php 
          session_start(); 
            include'connection.php';
            if (isset($_SESSION['userid'])) {
            $id=$_SESSION['userid'];
            if(isset($_POST['update']))
            {
           $username = $_POST['username'];
           $usergender = $_POST['usergender'];
           $user_ph_num = $_POST['user_ph_num'];
           $user_email = $_POST['user_email'];
            $user_address = $_POST['user_address'];
            $user_pass = $_POST['user_pass'];
                         
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

          $sql= "update `users` set userid ='$id', username='$username', user_ph_num='$user_ph_num' , user_email='$user_email' , user_address='$user_address' , 	user_pass='$user_pass' ,image='$uploadimg' where userid=$id ";
         
          
             $result=mysqli_query($conn,$sql);
             if($result)
             {
                header('location:profileusers.php');

             }
             else
             {
                die(mysqli_error($conn));
             }
          }
        }
            }

            // Fetch the existing data for the employee
$sql1 = "SELECT * FROM `users` WHERE `userid`='$id'";
$result2 = mysqli_query($conn, $sql1);
$row2 = mysqli_fetch_assoc($result2);
            mysqli_close($conn);
         ?>

<!DOCTYPE html>
<html>

<head>
    <title>REGISTER FORM</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
  display: flex;
  space-between: 30px;
}
           .profile-card {
            position: fixed;        
            height: 100%; /* Take full height */   
            border-right: 1px solid #ddd; /* Border to separate from the main content */
        } 

        .cla {
            border: 2px solid #ddd;
            width: 400px;
            margin: 90px auto;
            padding: 20px;
            border-radius: 25px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .cla h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            margin-top: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        textarea,
        input[type="radio"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="radio"] {
            width: auto;
            margin-right: 10px;
        }

        #upd {
            background-color: #ff69b4;
            color: white;
            height: 40px;
            width: 100px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #upd:hover {
            background-color: #ff4f94;
        }

    </style>
</head>

<body>

<div class="profile-card">
<?php include('try.php'); ?>
</div> 

    <div class="cla">
        <h2>Update Profile</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

            <label for="username">Name:</label>
            <input type="text" name="username"  value="<?php echo $row2['username']; ?>" autocomplete="off" required="required">

            <label for="usergender">Gender:</label>
            <input type="radio" name="usergender" value="male" required> Male
            <input type="radio" name="usergender" value="female" required> Female

            <label for="user_ph_num">Phonenumber:</label>
            <input type="text" name="user_ph_num" autocomplete="off" value="<?php echo $row2['user_ph_num']; ?>"  required="required">

            <label for="user_email">E-mail:</label>
            <input type="text" name="user_email" autocomplete="off" value="<?php echo $row2['user_email']; ?>"  required="required">

            <label for="myfile">Select a file:</label>
      <input type="file" id="myfile" name="myfile"><br><br>

            <label for="user_address">Address:</label>
            <textarea name="user_address" rows="4" value="<?php echo $row2['user_address']; ?>"  required></textarea>

            <label for="user_pass">Password:</label>
            <input type="password" name="user_pass" value="<?php echo $row2['user_pass']; ?>" autocomplete="off" required="required">

            <center><input type="submit" id="upd" name="update" value="Update"></center>

        </form>
    </div>
</body>

</html>
