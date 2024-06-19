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
       
} 
.center {
  margin-left: auto;
  margin-right: auto;
}

thead{

  
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
        height: 80px;
    }

    th,td{
      width: 80px;
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
    .table-wrapper {
        max-height: 500px; /* Set the maximum height for the table to become scrollable */
        overflow-y: auto; /* Enable vertical scrolling */
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
    <center> <h1> EMPLOYEE DETAILS </h1> </center>
   <br>
   <br><br><br><br>
   <div class="table-wrapper">

  
   <br><br><br>
<table class="center">
  <th >
  <tr class="sticky-thead">
    <th>USERID</TH>
    <th>NAME</th>
    <th>GENDER</th>
    <th>PHONE</th>
    <th>EMAIL</th>
    <th>ADDRESS</th>
  
    <th>CATEGORY</th>
    <th>SERVICE</th>  
    <th>EXPERIENCE</th>
    <th>IMAGE</th>
    <th>OPERATION</th>
    <th>status</th>
    <th>action</th>
  </tr>
  </th>
  <tbody>
               <?php
                 include'connection.php';
                $sql= "SELECT * FROM `empregi`";
                $result=mysqli_query($conn,$sql);
                if($result){
                      while($row=mysqli_fetch_assoc($result)){
                        $id = $row['empid'];
                        $name = $row['name'];
                        $gender = $row['gender'];
                        $ph_num = $row['ph_num'];
                        $email = $row['email'];
                        $address = $row['address'];                   
                        $message = $row['message'];
                        $category = $row['cat'];
                        $service= $row['service'];
                        $exp = $row['exp'];
                        $myfile = $row['myfile'];
                        $status = $row['status'];
                       
                        echo'
                                   <tr class="inset">
                                   <td>'.$id.'</td>
                                <td>'.$name.'</td>
                                <td>'.$gender.'</td>     
                                      <td>'.$ph_num.'</td>                                                   
                                      <td>'.$email.'</td>
                                      <td>'.$address.'</td>
                                      
                                      <td>'.$category.'</td>
                                      <td>'.$service.'</td>
                                      <td>'.$exp.'</td>
                                      <td class="tdimg"><center><img src='.$myfile.' class="tdima"/></center></td>
                                           
                                           <td >
                                           <button class="button2"> <a href=" update.php?upid='.$id.'" > <i class="fa fa-edit"></i></a></button> <br>
                                           <button class="button3"> <a href=" delete.php?deid='.$id.'" > <i class="fa fa-trash"></i></a></button>
                                           </td>
                                           <td>';
                            
                                           if ($row['status'] == 1) {
                                               echo '<p id="str'.$row['empid'].'">active</p>';
                                           } else {
                                               echo '<p id="str'.$row['empid'].'">inactive</p>';
                                           }
                                           
                                           echo '
                                                   </td> 
                                                   <td>
                                                       <select onchange="active_inactive(this.value, '.$row['empid'].')">
                                                           <option value="1">active</option>
                                                           <option value="2">inactive</option>
                                                       </select>
                                                   </td>
                      </tr>';
                      }
                        
                }

               ?>
                        
  </tbody>
</table>
</div>
              </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    function active_inactive(val, id){
         $.ajax({
            type:'post',
            url:'status.php',
            data:{val:val,id:id},
            success: function(result){
                if(result==1){
                    $('#str'+id).html('active');
                }else{
                    $('#str'+id).html('inactive');
                }
            }
         }

         )
    }
</script>
</html>