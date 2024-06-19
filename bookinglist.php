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
       
}  

.center {
  margin-left: auto;
  margin-right: auto;
}

.sticky-thead {
      
      top: 0;
      z-index: 1;
      background-color:violet;
color:white;
border: none;
 box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
 margin-bottom: 20px; 
 padding: 5px;
 position: sticky;
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
      width: 60px;
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
      }
      .button3 {
        background-color: crimson;
        border: none;
  color: white;
  text-decoration: none;
      }



    .tdima{
      width:60%;
      height:40%;
      position:center;
    }
    .tdimg{
      width:160px;
    }
    .table-wrapper {
        max-height: 500px; /* Set the maximum height for the table to become scrollable */
        overflow-y: auto; /* Enable vertical scrolling */
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
    <center> <h1> BOOKING LIST </h1> </center>
   <br>
   <br><br><br><br>
   <div class="table-wrapper">
   
   <br><br><br>
<table class="center">
  <THEAD>
  <tr class="sticky-thead">
    <th>Booking<br>Id</TH>
    <th>Invoice.no</th>
    <th>Username</th>   
    <th>User<br>ph</th>
    <th>User<br>Address</th>
    <th>User<br>ip</th> 
    <th>User<br>Message</th>
    <th>Emp<br>id</th>
    <th>Emp<br>name</th>       
    <th>Payment</th>  
    <th>status</th>
    <th>action</th>
  </tr>
  </THEAD>
  <tbody>
               <?php
                 include'connection.php';
                $sql= "SELECT * FROM `bookings`";
                $result=mysqli_query($conn,$sql);
                if($result){
                      while($row=mysqli_fetch_assoc($result)){
                        $id = $row['bookid'];
                        $invoice = $row['invoice_number'];
                        $username = $row['username'];                        
                        $user_ph_num = $row['user_num'];
                        $useraddress = $row['user_address']; 
                        $userip = $row['user_ip'];                                         
                        $usermessage = $row['user_message'];
                        $empid = $row['emp_id'];
                        $empname= $row['emp_name'];
                        $payment = $row['payment'];
                        $status = $row['status'];
                       
                        echo'
                                   <tr class="inset">
                                   <td>'.$id.'</td>
                                <td>'.$invoice.'</td>
                                <td>'.$username.'</td>     
                                      <td>'.$user_ph_num.'</td>   
                                      <td>'.$useraddress.'</td>                                                
                                      <td>'.$userip.'</td>                                      
                                      <td>'.$usermessage.'</td>
                                      <td>'.$empid.'</td>
                                      <td>'.$empname.'</td>
                                      <td>'.$payment.'</td>
                                           <td>';
                            
                                           if ($row['status'] == 'confirm') {
                                               echo '<p id="str'.$row['bookid'].'">confirm</p>';
                                           } elseif($row['status'] == 'done')  {
                                               echo '<p id="str'.$row['bookid'].'">done</p>';
                                           }else {
                                            echo '<p id="str'.$row['bookid'].'">cancel</p>';
                                           }

                                           
                                           echo '
                                                   </td> 
                                                   <td>
                                                       <select onchange="bookstatus(this.value, '.$row['bookid'].')">
                                                       <option value="cancel">cancel</option>
                                                           <option value="confirm">confirm</option>
                                                           <option value="done">done</option>
                                                       </select>
                                                   </td>
                      </tr>';
                      }                        
                }  

                $upadate_sql= "update `bookings` set payment='Paid'  where status='done' ";
          
                $update_result=mysqli_query($conn,$upadate_sql);
            ?>                         
  </tbody>
</table>
</div>
              </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    function bookstatus(val, id){
         $.ajax({
            type:'post',
            url:'bookstatus.php',
            data:{val:val,id:id},
            success: function(result){
                if(result== 'confirm'){
                    $('#str'+id).html('confirm');
                }else if(result== 'done'){
                    $('#str'+id).html('done');
                }else{
                  $('#str'+id).html('cancel');
                }

            }

         }

         )
    }
</script>
</html>