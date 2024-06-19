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
    </style>
</head>
<body>
<div class="div-ul-menus">
        <ul class="ul-menus">
            
        <li> <a class="act" href="addadmin.php">Add Admin</a> </li> <br><br>
            <li> <a class="act" href="emplist.php">Employee</a> </li> <br><br>
            <li> <a class="act" href="userlist.php">Users</a> </li> <br><br>
            <li> <a class="act" href="bookinglist.php">Bookings</a> </li> <br><br>
            <li> <a class="act" href="addservice.php">Add Service</a> </li> <br><br>
            <li> <a class="act" href="addcategory.php">Add Category </a> </li> <br><br>
            <li> <a class="act" href="quepage.php">Query</a> </li> <br><br>
            <li> <a class="act" href="logout.php">Logout</a> </li> <br><br>
    
        </ul>
    </div>

    <div class="ser-form">
    <center> 
        
        <h1>ADD SERVICE</h1><br><br>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
          

          <label for="name">Name:</label>
          <input type="text" name="name" required><br><br>
         
          <label for="serimg">Select a file:</label>
    <input type="file" id="serimg" name="serimg"><br><br>
   

           <center> <input type="submit" name="submit" value="SUBMIT"> </center>
</div>




</body>
</html>

   
<?php
include 'connection.php';

if(isset($_POST['submit'])) {
    $name = $_POST['name'];        

    $serimg= $_FILES['serimg'];
    

    $imagefilename=$serimg['name'];
    
    echo "<br>";

    $imagefileerror=$serimg['error'];
    
    echo "<br>";

    $tmpimage=$serimg['tmp_name'];
    
 echo "<br>";

 $filenamesep=explode('.',$imagefilename);
 
 echo "<br>";
 
 $filext=strtolower(end($filenamesep));
 

      $extension=array('jpeg','jpg','png');
      if(in_array($filext,$extension)){
        $uploadimg='imgser/'.$imagefilename;
        move_uploaded_file($tmpimage,$uploadimg);

         // Use prepared statement to prevent SQL injection
         $sql = "INSERT INTO addservice (name, serimg) 
         VALUES ( '$name', '$uploadimg')";
         $result=mysqli_query($conn,$sql);
         if($result){
            echo"succesfully ADDED";

         }
         else{
            die(mysqli_error($conn));
         }
      }
    // Close the database connection
    mysqli_close($conn);
}

  

?>