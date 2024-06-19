<?php 



    function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
  //$ip = getIPAddress();  
  //echo 'User Real IP Address - '.$ip;  
 

  function getuserinfo() {
    include 'connection.php';
    // Check if the 'user_name' is set in the session
    if (isset($_SESSION['userid'])) {
        //$user_name = $_SESSION['user_name'];
        $userid = $_SESSION['userid'];
    
        $sql = "SELECT * FROM users WHERE userid='$userid'";
        $result = mysqli_query($conn, $sql);
    
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $username = $row['username'];
                $user_address = $row['user_address'];
                $user_id = $row['userid'];
    
                //echo '<label for="profile-picture-input">';
                //echo '<img src="imgser/thc.jpeg" alt="User Profile Picture" class="profile-picture">';
                
               // echo '</label>';
                //echo '<input type="file" id="profile-picture-input" accept="image/*">';
                //echo '<div class="profile-picture-border"></div>';
                //echo '</div>';
                echo '<div class="profile-info">';
               // echo '<h3>' . $username . '</h3>';
                //echo '<p>' . $user_address . '</p>';
                echo '<hr>';
                echo '<ul class="profile-links">';

                echo "<li><a href='profileusers.php?user=$user_id'>MY PROFILE</a></li>";
            echo "<li><a href='profileupdate_users.php?user=$user_id'>EDIT PROFILE</a></li>";
            echo "<li><a href='user_bookings.php?user=$user_id'>MY BOOKINGS</a></li>";
            echo "<li><a href='users_delete_account.php?user=$user_id'>DELETE ACCOUNT</a></li>";
            echo "<li><a href='logout.php'>LOGOUT</a></li>";

                echo '</ul>';
                echo '<hr>';
                echo '</div>';
            }
        } else {
            echo "No user found with the provided username.";
        }
    
        mysqli_close($conn);
    } else {
        echo "Session variable 'user_name' not set.";
    }
    
  }

  function getbookingid(){
    
  }

?>


