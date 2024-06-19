<!DOCTYPE html>
<html>
<head>

<title>HOME CARE HEROS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
     <style>
          h2{
 text-align:center;
color:  #702963;
}
  .log-img{
 border-radius:50%;
 box-shadow:0 0 0px black;
        position: sticky;
left: 50px;
margin-top:30px;
   }

 .style1{
  background-color: white;
  height: 150px ;
  width : 100%;
  position : sticky;
  display: flex;
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 0;
}

.logo{
 font-size: 30px;
 font-family: Freestyle Script;
   position: relative;
  top: -38px;
  color: #32174d ;
  
}

.center-search{
    top: -40px;
   position:center;
left:100px;
margin-left: -200px;
}

.sea{
 font-size: 39px;
 background-color: #9966cc;
 top: -40px;
 border-radius: 0px 30px 30px 0px;
color: white;
border:none;
padding: 6px 10px;
  margin-top: 8px;
  margin-right: 6px;
margin-left: 30px;
height:45px;
text-align:center;

      }

       .sea:hover {
  background: #b19cd9;
      }


     .ss{
  width: 400px;
  box-sizing: border-box;
  border: 3px solid  #b19cd9;
  border-radius: 30px 30px 30px 30px;
  font-size: 30px;
  background-color: transparent;
 padding: 6px;
  margin-top: 8px;
background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E"); /* Replace with your search icon image path */

  background-repeat: no-repeat; /* Prevent icon repetition */
  padding-right: 50px; /* Adjust the padding to create space for the icon */
   background-size: 22px 22px;
        background-position: 95% center;
       }


       .topnav {
  overflow: hidden;
  background-color: white;
       height:100px;
          }

        .topnav a {
  
  color: #602f6b;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 30px;
      }

       .topnav a:hover {
  background-color:  #b19cd9;
  color: white;
      }

         #searchresult{
            margin-top:40px;
             }

             .nav{
                position:absolute;
             }

             .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
            z-index: 1000; /* Ensure it's above other content */
        }

     
        .loim{
            margin-left:40px;
        }
        .fa-user{
            margin-right: 70px;  
            padding:16px;         
        }

        .div-log{
            position: relative;
             display: inline-block;
            
        }
      .user-details{
        display: none;
  position: absolute;
  background-color: #f1f1f1;
  max-width: 560px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
      }
      .user-details a {
  color: black;
  padding: 12px 46px;
  text-decoration: none;
  display: block;
}

.user-details a:hover {background-color: #ddd;}

.div-log:hover .user-details {display: block;}

.div-log:hover .fa-user {color: #3e8e41;}
        </style>
</head>
<body>


        
 <div class="style1">

          <div class="loim">
         <img src="img\logo.jpeg" width="90" height="90" class="log-img">
         <p class="logo">  HOME CARE HERO  </p> 
      </div>

     <div class="search-container">
          <form class="center-search">
                <center>
            <input type="text" placeholder="Search.." name="search2" class="ss" id="livesearch" autocomplete="off" required="required">
               </center>
           </form>
       </div>

       <div class="popup" id="searchPopup">
        <div id="searchresult"></div>
        <button id="closePopup">Close</button>
            </div>
   
            <div class="div-log">

            <i class="fa fa-user" style="font-size:48px;color:#9966cc"></i>

            <div class="user-details">
                <?php
            if (!isset($_SESSION['userid'])) {
               echo" <p><a href='#'>WELCOME GUEST</a></p>";
             } else {
                echo"<p><a href='#'>WELCOME USER</a></p>";
             }
            ?>
                <p><a href="user_profile.php">MY ACCOUNT</a></p>
               
               <?php
                if (!isset($_SESSION['userid'])) {
                    echo "<p><a href='user_login.php'> LOGIN</a> </p>";
                } else {
                    echo "<p><a href='logout.php'>LOGOUT</a></p>";
                }
                ?>
            </div>
        </div>

 </div>

<hr>
<div class="topnav">
<center>
<b>
<br> <br>
  <a class="active" href="first.php">Home</a>
  <a class="active" href="dumservice.php">Service</a> 
  <a class="active" href="about.php">About Us</a>
  <a class="active" href="workwithus.php">Work With Us</a> 
  <a class="active" href="alogin.php">Admin</a>
</b>
</center>
</div>
<hr>

<script>
        $(document).ready(function () {
            $("#livesearch").keyup(function () {
                var input = $(this).val();
                if (input != "") {
                    $.ajax({
                        url: "search_result.php",
                        method: "POST",
                        data: {
                            input: input
                        },
                        success: function (data) {
                            $("#searchresult").html(data);
                            $(".popup").show();
                        }
                    });
                } else {
                    $(".popup").hide();
                }
            });

            $("#closePopup").on("click", function () {
                $(".popup").hide();
            });
        });
    </script>

</body>
</html>