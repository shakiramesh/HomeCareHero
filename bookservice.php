<!DOCTYPE html>
<html>
<head>
<title>HOME CARE HEROS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="navsc.js"></script>
   <style>
      table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}  

.center {
  margin-left: auto;
  margin-right: auto;
}

 thead{
  background-color:violet;
  color:white;
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

    .tdima{
      width:60%;
      height:40%;
      position:center;
    }
    .tdimg{
      width:160px;
    }
    
    </style>
</head>
<body>
<div class="div-ul-menus">
        <ul class="ul-menus">
            
        <li> <a class="act" href="addadmin.php">Add Admin</a> </li> <br><br>
            <li> <a class="act" href="emplist.php">Employee</a> </li> <br><br>
            <li> <a class="act" href="userlist.php">Users</a> </li> <br><br>
            <li> <a class="act" href="bookinglist">Bookings</a> </li> <br><br>
            <li> <a class="act" href="addservice.php">Add Service</a> </li> <br><br>
            <li> <a class="act" href="addcategory.php">Add Category </a> </li> <br><br>
            <li> <a class="act" href="quepage.php">Query</a> </li> <br><br>
            <li> <a class="act" href="logout.php">Logout</a> </li> <br><br>
    
        </ul>
    </div>
    
    <div class="one">
  
   <br>
   <br><br><br><br>

   <center> <h1> EMPLOYEE DETAILS </h1> </center>
   <br><br><br>
<table class="center">
  <THEAD>
  <tr>
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
                $sql= "SELECT * FROM `empregi`";
                $result=mysqli_query($conn,$sql);
                if($result){
                      while($row=mysqli_fetch_assoc($result)){
                        $id = $row['bookid'];
                        $invoice = $row['invoice_number'];
                        $username = $row['username'];                        
                        $user_ph_num = $row['user_ph_num'];
                        $useraddress = $row['user_address']; 
                        $userip = $row['user_ip'];                                         
                        $usermessage = $row['user_message'];
                        $empid = $row['emp_id'];
                        $empname= $row['emp_name'];
                        $payment = $row['payment'];
                        $status = $row['status'];
                       
                        echo'
                                   <tr>
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
                            
                                           if ($row['status'] == 1) {
                                               echo '<p id="str'.$row['bookid'].'">confirm</p>';
                                           } elseif($row['status'] == 2)  {
                                               echo '<p id="str'.$row['bookid'].'">done</p>';
                                           }else {
                                            echo '<p id="str'.$row['bookid'].'">cancel</p>';
                                           }

                                           
                                           echo '
                                                   </td> 
                                                   <td>
                                                       <select onchange="active_inactive(this.value, '.$row['bookid'].')">
                                                       <option value="0">cancel</option>
                                                           <option value="1">confirm</option>
                                                           <option value="2">done</option>
                                                       </select>
                                                   </td>
                      </tr>';
                      }                        
                }
               ?>                       
  </tbody>
</table>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    function active_inactive(val, id){
         $.ajax({
            type:'post',
            url:'bookstatus.php',
            data:{val:val,id:id},
            success: function(result){
                if(result==1){
                    $('#str'+id).html('confirm');
                }elseif(result==2){
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