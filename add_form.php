<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME CARE HEROS</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="add.css">
</head>
<body>
<?php include('sidebar.php'); ?>

<?php
         include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
    } elseif(isset($_POST['sub'])) {
        $catname = $_POST['catname'];        
      
             // Use prepared statement to prevent SQL injection
             $sql = "INSERT INTO addcategory (catname) 
             VALUES ( '$catname')";
             $result=mysqli_query($conn,$sql);
             if($result){
                echo"succesfully ADDED";
             }
             else{
                die(mysqli_error($conn));
             }
    // Close the database connection
    mysqli_close($conn);
    
} }
?>

            
<div class="space">

       <div class="log_reg">    
                    <div class="btn_tog">
                        <div id="act_btn"></div>
             <button class="togglebtn" onclick="toggleForm('ser-form')">service</button>
              <button class="togglebtn" onclick="toggleForm('cat-form')">category</button>
                      </div>
             
 
<div class="cat-form" id="catform">
    <center> 
        
        <h1>ADD CATEGORY</h1><br><br>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
          
          <input type="text" name="catname" placeholder="Category Name"required><br><br>
           <center> <input type="submit" name="sub" value="SUBMIT"> </center>

  </form>
</div>

<div class="ser-form" id="serform" style="display:none;">
    <center> 
        
        <h1>ADD SERVICE</h1><br><br>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
          
          <input type="text" name="name" required placeholder="Service Name"><br><br>
         
    

    <label for="serimg" class="file-input-wrapper">
                    <span class="file-upload-icon"><i class="fa fa-upload"></i></span>Select a file
                    <input type="file" id="serimg" name="serimg">
                </label><br><br>
   

           <center> <input type="submit" name="submit" value="SUBMIT"> </center>
</div>

</div>



<script>
let activePosition = 'ser-form'; // Initially set to 'login'

function toggleForm(formType) {
    if (formType === 'ser-form' && activePosition !== 'ser-form') {
        document.getElementById('serform').style.display = 'block';
        document.getElementById('catform').style.display = 'none';
        document.getElementById('act_btn').style.left = '0';
        activePosition = 'ser-form';
    } else if (formType === 'cat-form' && activePosition !== 'cat-form') {
        document.getElementById('serform').style.display = 'none';
        document.getElementById('catform').style.display = 'block';
        document.getElementById('act_btn').style.left = '110px';
        activePosition = 'cat-form';
    }
}


</script>

</body>
</html>
