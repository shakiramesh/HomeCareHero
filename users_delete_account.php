<?php
   session_start(); // Start the session
 include 'common_function.php';
 include 'connection.php';

 if (isset($_SESSION['userid'])) {
    $user_id = $_SESSION['userid'];

         //$u_name = $_SESSION['user_name'];
 if (isset($_POST['yes'])) {
    $deletesql=" delete from `users` where userid='$user_id'";
    $result=mysqli_query($conn,$deletesql); 
    if($result){
        session_destroy();
        echo"<script>alert('ACCOUNT DELETED')</script>";
        echo"<script>window.open('first.php','self')</script>";
       }
      
 }

 if (isset($_POST['no'])) {
    echo"<script>window.open('profileusers.php','self')</script>";
 }

}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<style>
body {
  
    display: flex;
    background-color:#fff;
    space-between: 30px;
}



    .dele_acc{
    height: 400px;
    width: 500px;
    border: 1px solid purple;
    margin-left: 700px;
    background-color: #fff6ff;
    margin-top: 20px;
    align-items: center;

    }

    #yes{
        background-color: pink;
        color:white;
         height:50px;
         width:230px;
        margin:30px;
        font-size:20px;
    }

    #no{
        background-color: pink;
        color:white;
         height:50px;
         width:290px;
        margin:30px;
        font-size:20px;
    }

    .profile-card {
            position: fixed;
            height: 100%; /* Take full height */
            border-right: 1px solid #ddd; /* Border to separate from the main content */
        } 

</style>
</head>
<body>


<div class="profile-card">
<?php include('try.php'); ?>
</div>
        
        
            <div class="dele_acc">
    <center>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        
    
    <input type="submit" id="yes" name="yes" value="DELETE ACCOUNT"><br><br>
   
    <input type="submit" id="no" name="no" value="DON'T DELETE ACCOUNT"><br><br>
       
    </form>
    </center>
    
</div>

</body>
</html>
