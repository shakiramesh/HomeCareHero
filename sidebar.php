<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Responsive Sidebar Menu</title>
<style>

body{
margin: 0;
padding: 0;
font-family: Arial, sans-serif;
}

.sidebar {
position: fixed;
top: 0; 
height: 100%;
width: 250px;
background-color: #9966cc;
transition: all 0.3s ease;
overflow-y:auto;
overflow-x: hidden;
}
.sidebar.hide{
width: 70px;

}
.sidebar.hide .toggle i.rot {
transform: rotate(180deg);
}

.first {
  display: block;
  height:20px;      
 width: 100%;
 text-align:center;
 padding:16px;
 color: purple;
}
 .first ic{
  text-align:center;
  display:inline-block;
  min-width:70px;
 }

 .menu{
    margin-top: 16px;
    display: block;
    width: 100%;
    padding: 12px 0;
    text-wrap: nowrap;
 }

.sidebar .menu li{
list-style: none;
margin-top:10px;
width: 100%;

}

.menu .iconlink{
margin-left: 30px;
margin-bottom: 10px;
}
   .menu li a{
display: relative;
align-items: center;
width: 100%;
transition: all 0.3s ease;
color: #fff;
text-decoration: none;
font-size: 20px;
font-weight: 500;
justify-content: center;
text-align: justify;
margin-left: 30px;
margin-bottom: 10px;

     }

     .menu li a:hover{
        color: #800080;
        width: 100%;
        height: 100%;
     }

      .menu li a .icon{
      min-width: 70px; 
         font-size: 28px;
         text-align: justify;
         position: relative; 
         display: inline-block;
 }

 .menu li a .link_name{
    text-align: justify;
    margin-left: 10px;
 }
 
 .sidebar .menu li a.active,
.sidebar .menu li a.active:hover {
background: purple;
color: white;
border-top-left-radius: 20px;
border-top-right-radius: 20px;
border-bottom-right-radius: 20px;
border-bottom-left-radius: 20px;
max-width: 100%;
height: 40px;
padding-right: 120px;
padding-top: 10px;
padding-bottom: 8px;
padding-left:5px;
}

.navlist{
    max-height: 0;
    overflow-y: hidden;
    transition: .3s ease;
}
 .navlist.show{
    max-height: 300px;
    overflow-x: hidden;
 }

     .navlist li a{
        padding-left: 3px;
        padding-bottom: 4px;
     }

 .menu li a .ico{
    text-align: justify;
    width: 100%;
border-top-left-radius: 20px;
border-bottom-right-radius: 20px;
 }


.toggle{
background: white;
border: none;
font-size:30px;
color: black;
cursor: pointer;
display: flex;
  height: 10px;     
 width: 10px;
 justify-content: center;
 align-items:center;
 padding:16px;
 border-radius: 90px;
 margin: 0 auto;
 margin-top: 30px;
 transition: .3s ease;
}

.main-content {
margin-left: 250px; /* Adjust based on sidebar width */
transition: margin-left 0.3s ease;
padding: 20px;
/* ... other styles ... */
}


 @media screen and (max-width: 768px){
    #maincontent{
        position: relative;
        width: clac(100% - 280px);
        left: 280px;
        transition: .3s ease;
    }
 }

 .query-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Center containers horizontally */
    gap: 20px;
}

.container-query {
    width: 30%; /* Adjust the width based on your design preference */
    margin: 20px;
    padding: 20px;
    color:white;
    background-color: #967bb6;
    text-align: center;
    margin-top: 90px;
}

main-content{
    width: 270px;
    overflow-y: auto;
    transition: all .3s ease;
}

.topbar {
position: relative;
top: 20px;
left: 280px; /* Adjust based on sidebar width */
height: 60px;
margin-right: 10px;
background-color: #9966cc;
border-radius: 10px;
text-align: center;
width: calc(95% - 280px); /* Adjust this value based on sidebar width */
color: #fff;
padding: 15px;
z-index: 1000;
transition: left 0.3s ease; /* Smooth transition when sidebar is toggled */
}


@media screen and (max-width: 768px){
    .sidebar{
        width: 60px;
    }
    .sidebar:is(:active){
        width:250px;
    }
    #maincontent{
        position: relative;
        width: calc(100% - 280px);
        left: 280px;
        transition: .3s ease;
    }
 }
    </style>
</head>
<body>

       

        

<div class="sidebar">

  
    <div class="first">   
     
         
    </div>

    <ul class="menu">
 
    <li>     
    <a href="admin.php"> 
        <span class="icon">
            <i class="fa fa-home"></i>
    
        </span> 
        <span class="link_name"> Home </span>
    </a> 
</li>

    <li> 
    <a href="#" class="iconlink"> 
    <span class="icon">  <i class="fa fa-plus-square"></i> </span>
        <span class="link_name"> ADD </span>
        <i class="fa fa-sort-desc ico"></i>  
    </a>  
    <ul class="navlist"> 
        <li class="act"><a href="addadmin.php"> Add Admin </a></li>
        <li class="act"><a href="add_form.php">Category&Service</a></li>
    </ul>
   
</li>


   <li> 
    <a href="#" class="iconlink"> 
    <span class="icon"> <i class="fa fa-plus-square"></i> </span>
        <span class="link_name"> Details </span>
        <i class="fa fa-sort-desc ico"></i>  
    </a>  
    <ul class="navlist"> 
        <li><a href="userlist.php"> User List</a></li>
        <li><a href="emplist.php"> Employee List</a></li>
    </ul>
    
</li>


          <li> 

        <a href="bookinglist.php">  <span class="icon">  <i class="fa fa-shopping-cart"></i>  </span>
        <span class="link_name"> Bookings </span> </a> 
    </li>

    <li> 
   <a href="paymentlist.php"> <span class="icon">   <i class="fa fa-credit-card"></i> </span>
         <span class="link_name"> Payments </span> </a> 
    </li>

    <li> 
   <a href="quepage.php"> <span class="icon">   <i class="fa fa-sticky-note"></i> </span>
         <span class="link_name"> Query </span> </a> 
    </li>

    <li> 
   <a href="rateandreview.php"> <span class="icon">   <i class="fa fa-comments-o"></i> </span>
         <span class="link_name"> Reviews </span> </a> 
    </li>

    <li> 
        <a href="logout.php">  <span class="icon">  <i class="fa fa-sign-out"></i> </span>
        <span class="link_name"> Logout </span> </a> 
    </li>
</ul>
   <span class="toggle">
 <i class="fa fa-angle-left rot"></i>  </span>
</div>

<div class=" topbar">
     <h1>  ADMIN DASHBOARD</h1>

</div>
<script>

const togbtn = document.querySelector('.toggle');
const sidebar = document.querySelector('.sidebar');

document.querySelectorAll('.iconlink').forEach(function(dropdwn) {
    dropdwn.addEventListener('click', function(e) {
        e.preventDefault();
        this.nextElementSibling.classList.toggle('show');
    });
});

togbtn.addEventListener('click', function() {
    console.log("Toggle button clicked!"); 
    sidebar.classList.toggle('hide');
});

   
document.addEventListener("DOMContentLoaded", function () {
           var currentPath = window.location.pathname.split('/').pop();
           var links = document.querySelectorAll('.menu li a');

           links.forEach(function (link) {
               if (link.getAttribute('href') === currentPath) {
                   link.classList.add('active');
               }
           });
       });
</script>
</body>
</html>
