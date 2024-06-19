<!DOCTYPE html>
<html>
<head>
<title>HOME CARE HEROS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="navsc.js"></script>
<style>
    .ul-menus{
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 200px;
    height: 180%;
    background-color: #C3B1E1;
   }

   .act{
    display: block;
  text-decoration: none;
    font-size:25px;
    color:#602f6b;
    margin-top:0px;
    width:10%;  
    padding-top:30px; 
   }
    .actact{
        color: white;
        background-color: lavender;
        padding:10px;
        width:180px;/* Adjusted padding */     
    }

    .div-ul-menus{
      float:left;
    }

    body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .admin-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 50px auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: 80%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #9370db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 80%;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #7851a9;
        }
    </style>
</head>
<body>
<?php include('sidebar.php'); ?>

<div class="admin-form">
    <center>        
        <h1>ADD ADMIN</h1><br><br>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
          
          <input type="text" name="adname" placeholder="Admin Name" required><br><br>

          <input type="text" name="adpass" placeholder="Password" required><br><br>

           <center> <input type="submit" name="adsub" value="SUBMIT"> </center>
</div>

</body>
</html>
   
   <?php

 include 'connection.php';

  
if(isset($_POST['adsub'])) {
  $adname = $_POST['adname'];   
  $adpass = $_POST['adpass'];     

       // Use prepared statement to prevent SQL injection
       $sql = "INSERT INTO adlog (username, password) 
       VALUES ( '$adname', '$adpass')";
       $result=mysqli_query($conn,$sql);
       if($result){
          echo"succesfully ADDED";
       }
       else{
          die(mysqli_error($conn));
       }
    
  // Close the database connection
  mysqli_close($conn);
   }
    ?>
