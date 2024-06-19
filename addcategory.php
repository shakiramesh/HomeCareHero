
   
   <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 include 'connection.php';

  
if(isset($_POST['sub'])) {
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
   }
    ?>
