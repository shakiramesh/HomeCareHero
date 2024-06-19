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
$sql = "INSERT INTO `empregi` (name, gender, ph_num, email, address, message, cat, service, exp, myfile, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssssssssssi", $name, $gender, $ph_num, $email, $address, $message, $category, $service, $exp, $uploadimg, $status);

    if (mysqli_stmt_execute($stmt)) {
        echo "successfully registered";
    } else {
        die(mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
} else {
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
 <style>
 body {

    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    margin-top: 30px;
    color: #333;
}

form.emp {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 500px;
    margin: 30px auto;
    height: 690px;
    text-align: left; 
}

label.lab {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    text-align: left;
}

input.put[type="text"],
select.sele,
textarea.put {
    width: 90%;
    padding: 7px;
    margin-bottom: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 16px;
    margin-left: 0; 
}

input.put[type="radio"],
input.put[type="checkbox"] {
    margin-right: 10px;  /* Spacing between radio/checkbox and its label */
}

input.sub[type="submit"] {
    
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 30%;
    transition: background-color 0.3s ease;
    padding: 10px;
    text-align: center;
    font-weight: bold;
    background-color: #9370db;
}

input.sub[type="submit"]:hover {
    background-color: #7851a9;
}

textarea.put {
    height: 60px;  /* Fixed height for consistency */
    resize: vertical;  /* Allow vertical resizing */
}
input[type="file"] {
    display: none;
}

/* Style the custom button */
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    background-color: #fff;
    border-radius: 4px;
    transition: background-color 0.3s ease;
    width: 88%;
}

.custom-file-upload:hover {
    background-color: #e9e9e9;
}

    </style>
</head>
<body>



<form class="emp" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<h1>Registration Form</h1>
<div class="form-container">
    <input class="put" type="text" name="name" autocomplete="off" required="required" placeholder="Name"><br>

    <input class="put"  type="radio" name="gender" value="male"  required> Male
    <input class="put" type="radio" name="gender" value="female" required> Female<br>

    <input class="put"  type="text" name="ph_num" autocomplete="off" required="required" placeholder="Phonenumber"><br>

    <input class="put"  type="text" name="email" autocomplete="off" required="required" placeholder="E-mail" ><br>

  
    <input class="put" type="text" name="exp" autocomplete="off" required="required" placeholder="Experience"><br>

    <select  class="sele" name="category" id="category">
               <option class="opt" value="Electrical">Select category</option>
               <?php                
                 $selectcategory_sql = "SELECT * FROM addcategory";
                 $result_cat = mysqli_query($conn, $selectcategory_sql);                
                  while ($row1 = mysqli_fetch_assoc($result_cat)) {
                     $catname = $row1['catname'];
                     $catid = $row1['catid'];
                     echo "<option value='$catname'> $catname </option>";                  
               }
               ?> </select>   <br>

           <select class="sele" name="service" id="service">
             <option class="opt" value="">Select service</option>
             <?php                
                 $selectservice_sql = "SELECT * FROM addservice";
                 $result = mysqli_query($conn, $selectservice_sql);                
                  while ($row = mysqli_fetch_assoc($result)) {
                     $name = $row['name'];
                     $serviceid = $row['serviceid'];
                     echo "<option value='$name'> $name </option>";                  
               }
               ?>     </select>  <br>

   <label for="myfile" class="custom-file-upload">
    <i class="fa fa-cloud-upload"></i> Choose File
</label>
<input class="put" type="file" id="myfile" name="myfile">  <br><br>

    <textarea class="put" id="w3review" name="message" placeholder="Address"></textarea><br><br>
        <textarea class="put" id="w3review" name="message" placeholder="Message" ></textarea><br><br>
          
    </div>
   <center> <input class="sub" type="submit" name="submit" value="Register"> </center> 
</form>
</body>
</html>