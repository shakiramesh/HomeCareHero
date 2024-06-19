<?php
include 'connection.php';

//$sid = $_GET['id'];
//$status = $_GET['ACTIVE'];

// Use single quotes around the string value and fix the SQL syntax
//$q = "UPDATE query SET ACTIVE='$status' WHERE id=$sid";

//mysqli_query($conn, $q);
      
       $query=mysqli_query($conn, "update empregi set status='".$_POST['val']."' 
       where empid='".$_POST['pid']."' ");
          if($query){
            $q=mysqli_query($conn, "Select * from empregi 
            WHERE empid='".$_POST['id']."'  ");
            $data=$mysqli_fetch_assoc($query);
            echo $data['$status'];
            header('location: empreg.php');
          }

?>
