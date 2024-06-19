<!DOCTYPE html>
<html>
<head>
<title>HOME CARE HEROS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="carestyles.css">

   
  
</head>
<body>
<?php include('header.php'); ?>

<hr>

<div class="name">  OUR SERVICES </div>

<hr>

<div class="servive-list">

<div class="pro">
<?php
                 include'connection.php';
                $sql= "SELECT * FROM addservice order by rand()";
                $result=mysqli_query($conn,$sql);
                $check_result=mysqli_num_rows($result) > 0;

                if($check_result){
                  while($row=mysqli_fetch_assoc($result))
                  {
                    
                    echo '<div class="card">
                     
                <img src='.$myfile.'  alt="Avatar" style="width:100%"/>
                <div class="container">
                  <h4><b>  echo $row['name']; </b></h4> 
                         
                  </div>"
                  </div>"
                      
                  ';
                }
                else
                {
                  echo"NO DATA FOUND";
                }
              }
                ?>





</div>

</div>

<hr>
<?php include('footer.php'); ?>
</body>
</html>