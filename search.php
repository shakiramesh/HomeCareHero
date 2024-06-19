<!DOCTYPE html>
<html>

<head>
    <title>HOME CARE HEROES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="searchjs.js"></script>
    <style>
       body{
        align-items: center;
        justify-content:center;
       }
          .searchbox{
              display: flex;
              cursor:pointer;
              background:pink;
              border-radius:30px;
              height: 30px;
              padding:10px 20px;
              align-items: center;
              box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
              width:40px;
              position:absolute;
          }
           
          .searchbox:hover {
               width:200px;
               display: flex;
          }
         
          .searchbox:hover input{
            width:150px;
            display: flex;
          }
              
          .searchbox input{
            width: 0;
            outline:none;
            border: none;
            font-weight: 500px;
            transition: 0.5s;
            background:transparent;
            font-color:black;
            position:absolute;
            margin-top:-20px;
            margin-left:20px;
          }

              .searchbox .fa{
                color: blue;
                font-size:18px;
                
              }
              
             #searchresult{
            margin-top:40px;
             }

             .space{
              margin-top:40px;
              height:30px;
             
             }
          
        </style>
</head>

<body>


    <div class="searchbox">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

         
            <i class="fa fa-search" style=""></i> 
           <input type="text" name="search" id="livesearch" class="searchtext" placeholder="search here...." autocomplete="off" required="required">

        </form>

    </div>  <br><br>
    <div class="space"></div>
    <div id="searchresult"></div>

            </div>
</body>

</html>
