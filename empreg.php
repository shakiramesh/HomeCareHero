  <?php
include 'connection.php';

if(isset($_POST['submit'])) {

    $name = $_POST['name'];        
    $gender = $_POST['gender'];
    $ph_num = $_POST['ph_num'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $message = $_POST['message'];
    $category = $_POST['category'];
    $service= $_POST['service'];
    $exp = $_POST['exp'];
    $status = 1;
    
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
        $uploadimg='imagereg/'.$imagefilename;
        move_uploaded_file($tmpimage,$uploadimg);

         // Use prepared statement to prevent SQL injection
         $sql = "INSERT INTO `empregi` (name, gender, ph_num, email, address, message, catid, serviceid, exp, myfile, status) 
         VALUES ( '$name', '$gender', '$ph_num', '$email', '$address', '$message', '$category', '$service', '$exp', '$uploadimg','$status')";
         
         $result = mysqli_query($conn,$sql);
         if($result){
            echo"succesfully registered";
         }
         else{
            die(mysqli_error($conn));
         }
      }
    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>HOME CARE HEROS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="carestyles.css">
</head>
<body>



<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<h1>Registration Form</h1>

    <label for="name">Name:</label>
    <input type="text" name="name" autocomplete="off" required="required"><br><br>

    <label for="gender">Gender:</label>
    <input type="radio" name="gender" value="male"  required> Male
    <input type="radio" name="gender" value="female" required> Female<br><br>

    <label for="ph_num">Phonenumber:</label>
    <input type="text" name="ph_num" autocomplete="off" required="required"><br><br>

    <label for="email">E-mail:</label>
    <input type="text" name="email" autocomplete="off" required="required"><br><br>

    <label for="address">Address:
         <textarea name="address" > </textarea> 
    </label> <br><br>
    

    <label for="message">Message:
        <textarea name="message" > </textarea> 
    </label>
    
    <br><br>

    <label for="myfile">Select a file:</label>
   <input type="file" id="myfile" name="myfile"><br><br>

           <label for="category">Category:</label>
           <select name="category" id="category">
               <option value="Electrical">Select category</option>
               <?php                
                 $selectcategory_sql = "SELECT * FROM addcategory";
                 $result = mysqli_query($conn, $selectcategory_sql);                
                  while ($row = mysqli_fetch_assoc($result)) {
                     $catname = $row['catname'];
                     $catid = $row['catid'];
                     echo "<option value='$catid'> $catname </option>";                  
               }
               ?> </select>   <br><br>

          <label for="service">Service:</label>
           <select name="service" id="service">
             <option value="">Select service</option>
             <?php                
                 $selectservice_sql = "SELECT * FROM addservice";
                 $result = mysqli_query($conn, $selectservice_sql);                
                  while ($row = mysqli_fetch_assoc($result)) {
                     $name = $row['name'];
                     $serviceid = $row['serviceid'];
                     echo "<option value='$serviceid'> $name </option>";                  
               }
               ?>     </select>  <br><br>

  
    <label for="exp">Experience:</label>
    <input type="text" name="exp" autocomplete="off" required="required"><br><br><br>

   <center> <input type="submit" name="submit" value="Register"> </center>

   
</form>
 

</body>
</html>