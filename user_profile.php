<?php
include 'connection.php';
session_start();

function isUserLoggedIn() {
    return isset($_SESSION['user_name']);
}

function getUserProfile() {
    global $conn;
    $user_name = $_SESSION['user_name'];
    $sql = "SELECT * FROM users where username='$user_name'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}

function displayContent() {
    if (isUserLoggedIn()) {
        $userProfile = getUserProfile();
        
        if ($userProfile) {
            $username = $userProfile['username'];
            $user_address = $userProfile['user_address'];
            $user_id = $userProfile['userid'];
            
            echo '<!DOCTYPE html>
            <html>
            <head>
            <title>Page Title</title>
            <style>
                /* Your CSS styles here */
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
                <div class="profile-picture-container">';
                
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
            echo "<li><a href='users_delete_account.php?user=$user_id'>DELETE ACCOUNT</a></li>";
            echo "<li><a href='logout.php'>LOGOUT</a></li>";

            echo '</ul>';
            echo '<hr>';
            echo '</div>';
            
            echo '</div></body></html>';
        } else {
            echo "Error fetching user profile.";
        }
    } else {
        echo "You are not logged in. Please login to view your profile.";
        echo '<br><a href="user_login.php">Login</a>';
    }
}

// Example usage
displayContent();
?>
