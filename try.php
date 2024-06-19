<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="userstyle.css">
    <style>
        /* Add your CSS styles here if needed */
    </style>
</head>
<body>
    <div class="side">
        <div class="card">

            <?php
                @session_start(); 
                include 'connection.php';

                if (isset($_SESSION['userid'])) {
                    $user_id = $_SESSION['userid'];
                    $sql = "SELECT * FROM users where userid='$user_id'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $username = $row['username'];
                            $user_address = $row['user_address'];
                            $img = $row['image'];

                            // Count bookings for the user
                            $sql_count = "SELECT COUNT(*) as total_bookings FROM bookings WHERE username = '$username'";
                            $result_count = mysqli_query($conn, $sql_count);
                            $row_count = mysqli_fetch_assoc($result_count);
                            $total_bookings = $row_count['total_bookings'];

                             // Count reviews for the user
                    $sql_count_reviews = "SELECT COUNT(*) as total_reviews FROM reviews WHERE user = '$username'";
                    $result_count_reviews = mysqli_query($conn, $sql_count_reviews);
                    $row_count_reviews = mysqli_fetch_assoc($result_count_reviews);
                    $total_reviews = $row_count_reviews['total_reviews'];

                            echo ' <div class="banner">';
                            echo '<img src="' . $img . '" alt="User Profile Picture" class="profile-picture">';
                            echo ' </div>';

                            echo '<h4 class="name"> ' . $username . ' </h4>';
                            echo '<div class="title"> ' . $user_address . ' </div>';            
                            echo ' <div class="actions">';
                            echo ' <div class="follow-info">';
                            echo '<h5><span> ' . $total_bookings . ' </span> <small>bookings</small></h5>';
                            echo ' <h5><span>' . $total_reviews . ' </span> <small> Reviews</small></h5>';
                            echo ' </div>';
                            echo '<div class="desc">Our ' . $username . ', a passionate homeowner eager to enhance their living space. They value quality service and strive for a comfortable, well-maintained home environment.</div>';

                            echo ' </div>';
        }
    }
}
//mysqli_close($conn);
?>
        </div>

        <div class="box-container">
            <ul class="link-list">
                <li><a href="first.php?user=$user_id"><i class="fa fa-home" style="font-size:18px"></i> HOME </a></li>
                <li><a href="user_bookings.php?user=$user_id"><i class="fa fa-shopping-cart" style="font-size:18px"></i>  MY ORDERS</a></li>
                <li><a href="profileupdate_users.php?user=$user_id"><i class="fa fa-edit" style="font-size:18px"></i> EDIT ACCOUNT</a></li>              
                <li><a href="user_reviws.php?user=$user_id"> <i class="fa fa-commenting-o" style="font-size:18px"></i> MY REVIEWS</a></li>
                <li><a href="users_delete_account.php?user=<?php echo $user_id; ?>"> <i class="fa fa-trash" style="font-size:18px"></i> DELETE ACCOUNT</a></li>
                <li><a href="logout.php?user=$user_id"> <i class="fa fa-sign-out" style="font-size:18px"></i> LOGOUT</a></li>
            </ul>
        </div>

    </div>
</body>
</html>
