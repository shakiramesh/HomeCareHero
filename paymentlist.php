<!DOCTYPE html>
<html>
<head>
<title>HOME CARE HEROS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="navsc.js"></script>
<style>
    .one{
      margin-left: 250px;
    }
      table{
        border-collapse: separate;
        border-spacing: 0 15px;
        width: 80%;
        margin-top: -80px;
       text-align: center;
    overflow-y: auto; 
    display: block; 
}  

.center {
  margin-left: auto;
  margin-right: auto;
}

thead{
  background-color:violet;
  color:white;
  border: none;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
   margin-bottom: 20px; 
   padding: 5px;
   position: sticky;
    top: 0; /* Stick to the top of the container */
    z-index: 1; 
 }

 tbody{
  margin-top: 40px;
 }
   .inset{
       background: white;
       color: black;
       box-border: 1px solid purple;
       box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
       margin-top: 20px;
       margin-bottom: 20px; 
       padding: 5px;
    }
    th,td{
      width: 120px;
    }
        .button1
      {
          background-color: #50C878;
          border: none;
  color: white;
  text-decoration: none;
      }

      .button2 {
        background-color: #0BDA51;
        border: none;
  color: white;
  text-decoration: none;
    border-radius: 20px;
    cursor: pointer;
    height: 30px;
    width: 80px;
    margin-top: 5px;
    margin-bottom: 5px;
    margin-right: 8px;
    margin-left: 8px;
    font-size: 18px;
     font-weight: bold;

      }
      .button3 {
        background-color: crimson;
        border: none;
  color: white;
  text-decoration: none;
  border-radius: 20px;
    cursor: pointer;
    height: 30px;
    width: 80px;
    margin-top: 5px;
    margin-bottom: 5px;
    margin-right: 8px;
    margin-left: 8px;
    font-size: 18px;
    font-weight: bold;
      }

    .tdima{
      width:60%;
      height:40%;
      position:center;
    }
    .tdimg{
      width:160px;
    }
    a{
      text-decoration: none;
      color: white;
    }

    select{
      border: none;
      border-radius: 0;
      height: 20px;
      width: 80px;
      box-shadow: 1px black;
      background: pink;
      
      font-size: 15px;
      font-weight: bolder;
      margin: 20px;
    }
    option{
      border: none;
      border-radius: 0;
      height: 40px;
      width: 80px;
      box-shadow: 1px black;
      background: purple;
      
      font-size: 15px;
      
      margin: 20px;
    }
   option:hover{
    color: purple;
    background: white;
   }
    
    </style>
</head>
<body>
<?php include('sidebar.php'); ?> 
    <div class="one">
  
   <br>
   <br><br><br><br>

   <center> <h1> ONLINE PAYMENTS </h1> </center>
   <br><br><br>
<table class="center">
  <THEAD>
  <tr>
    <th>payID</TH>
    <th>user</th>
    <th>bookingid</th>
    <th>invoice</th>
    <th>category</th>
    <th>amount</th>
    <th>date</th>
    <th>action</th>
  </tr>
  </THEAD>
  <tbody>
               <?php
                 include'connection.php';
                $sql= "SELECT * FROM `paydetails`";
                $result=mysqli_query($conn,$sql);
                if($result){
                      while($row=mysqli_fetch_assoc($result)){
                        $id = $row['pay_id'];
                        $user = $row['user'];
                        $bookid = $row['bookid'];
                        $invoice = $row['invoice'];
                        $category = $row['category'];
                        $amount = $row['amount'];                   
                        $date = $row['date'];
                        //$myfile = $row['myfile'];
                        //$status = $row['status'];
                        echo'
                                   <tr class="inset">
                                   <td>'.$id.'</td>
                                <td>'.$user.'</td>
                                <td>'.$bookid.'</td>     
                                      <td>'.$invoice.'</td>                                                   
                                      <td>'.$category.'</td>
                                      <td>'.$amount.'</td>
                                      <td>'.$date.'</td>
                                           <td >
                                        <br>
                                           <button class="button3"> <a href=" delete.php?deid='.$id.'" > <i class="fa fa-trash"></i></a></button>
                                           </td>          
                      </tr>';
                      }  
                }
               ?>        
  </tbody>
</table>
</div>
</body>
</html>