<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<style>
    body {
        width: 100%;
        height: 100vh;
        background: linear-gradient(
            to top,
            #fff6ff 0%,
            #fff6ff 80%,
            #9966cc 20%,
            #9966cc 100%
        );
    }

    .profile-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-top: 100px;
    }

    .profile-picture-container {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 20px 0;
        border-radius: 50%;
        overflow: hidden;
    }

    .profile-picture {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .profile-picture-border {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 2px solid #ddd;
        border-radius: 50%;
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.1);
        opacity: 0.8;
    }



    .profile-info {
        text-align: center;
        padding: 10px;
    }

    .profile-info h3 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .profile-info p {
        font-size: 14px;
        color: #666;
        margin-bottom: 10px;
    }

    .profile-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .profile-links li {
        display: inline-block;
        margin-right: 10px;
    }

    .profile-links a {
        text-decoration: none;
        
        color:purple;
        font-size: 24px;
    }
</style>
</head>
<body>

<div class="profile-card">

    <div class="profile-picture-container">
        <?php
        session_start(); 
        include 'connection.php';

        if (isset($_SESSION['userid'])) {
                      
             $user_id = $_SESSION['userid'];
             
        $sql = "SELECT * FROM users where userid='$user_id'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $username = $row['username'];
                $user_address = $row['user_address'];
                //$user_id = $row['userid'];

                echo '<label for="profile-picture-input">';
                echo '<img src="imgser/thc.jpeg" alt="User Profile Picture" class="profile-picture">';
                
                echo '</label>';
                echo '<input type="file" id="profile-picture-input" accept="image/*">';
                echo '<div class="profile-picture-border"></div>';
                echo '</div>';
                echo '<div class="profile-info">';
                echo '<h3>' . $username . '</h3>';
                echo '<p>' . $user_address . '</p>';
                echo '<hr>';
                echo '<ul class="profile-links">';

                echo "<li><a href='profileusers.php?user=$user_id'>MY PROFILE</a></li>";
                echo "<li><a href='profileupdate_users.php?user=$user_id'>EDIT PROFILE</a></li>";
                echo "<li><a href='user_bookings.php?user=$user_id'>MY BOOKINGS</a></li>";
                echo "<li><a href='first.php?user=$user_id'>HOME</a></li>";
                echo "<li><a href='users_delete_account.php?user=$user_id'>DELETE ACCOUNT</a></li>";
                echo "<li><a href='logout.php'>LOGOUT</a></li>";

                echo '</ul>';
                echo '<hr>';
                echo '</div>';
            }
        }
    }
        mysqli_close($conn);
        ?>
    </div>
</div>

</body>
</html>
