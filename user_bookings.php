<?php
session_start(); 
include 'common_function.php';
include 'connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <style>
        body{
            display: flex;
            background-color:#fff;
        }
        .ubook {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-left: 500px;
            width: 900px;
            height: calc(100vh - 40px);
            overflow-y: scroll;
        
        }

        .ubook::-webkit-scrollbar {
  display: none; /* for Chrome, Safari, and Opera */
}
        .con-data {
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: row; 
    justify-content: space-between;
    border: 2px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    
        }

        .con-data p {
            margin: 5px 0;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #e0e0e0;
        }

        .profile-card {
            position: fixed;
        
        
            height: 100%; /* Take full height */
    
            border-right: 1px solid #ddd; /* Border to separate from the main content */
        } 


        .details-left {
    
    flex: 1; 
}

.details-right {
    flex: 1; 
    padding-left: 20px; 
}

   button{
    height: 40px;
    margin: 10px;
   }

   .order {
    background-color: white;
    padding: 10px 20px;
    margin-bottom: 20px;
    font-size: 24px;
    position: sticky; /* Make it sticky */
    top: 0; /* Stick to the top */
    z-index: 1000; /* Ensure it stays above other elements */
    border-bottom: 2px solid #ccc; /* Optional: Add a border below the title */
}

    </style>
</head>
<body>

<div class="profile-card">
<?php include('try.php'); ?>
</div>

<div class="ubook">
    <p class="order"> MY ORDERS</P> 
    <?php
    if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
        $sql_book = "SELECT * FROM bookings WHERE users_id='$userid' ORDER BY date DESC";
        $result_book = mysqli_query($conn, $sql_book);

        if ($result_book) {
            while ($row2 = mysqli_fetch_assoc($result_book)) {
                // ... (your existing code)

                $user_name = $row2['username'];
                $user_address = $row2['user_address'];
                $invoice = $row2['invoice_number'];
                $user_ph_num = $row2['user_num'];
                $usermessage = $row2['user_message'];
                $empname = $row2['emp_name'];
                $payment = $row2['payment'];
                $status = $row2['status'];
                $ser_id = $row2['ser_id'];
                $cat_id = $row2['cat_id'];
                $bookid = $row2['bookid'];
                 $_SESSION['bookid'] = $bookid ;
                $paymode = $row2['paymode'];
                $hour = $row2['hour'];
                $amount = $row2['amount'];
                


                echo "<div class='con-data'>";
                // ... (rest of your echo statements)

                echo "<div class='details-left'>";

                echo "<p>INVOICE NUMBER: " . $row2['invoice_number'] . "</p>";
                echo "<p>PROBLEM: " . $row2['user_message'] . "</p>";
                echo "<p>NAME: " . $row2['username'] . "</p>";
                echo "<p>ADDRESS: " . $row2['user_address'] . "</p>";
                echo "<p>SERVICE PROVIDER: " . $row2['emp_name'] . "</p>";
                echo "<p>EXPERT IN: " . $row2['cat_id'] . "</p>";

                echo "</div>";

                echo "<div class='details-right'>";
                echo "<p>PAYMENT: " . $row2['payment'] . "</p>";

                echo "<p>PAYMENT MODE: " . $row2['paymode'] . "</p>";
                echo "<p>HOURS: " . $row2['hour'] . "</p>";
                echo "<p>AMOUNT: " . $row2['amount'] . "</p>";

                echo "</div>";

                echo "<div class='details-right'>";
               //echo "<p>STATUS: " . $row2['status'] . "</p>";
                if ($row2['status'] == 'done') {
                    echo "<p style='background-color: green; padding: 5px; color:white; height: 20px;  width: 120px; border-radius: 30px;'>STATUS: " . $row2['status'] . "</p>";
                } elseif ($row2['status'] == 'confirm') {
                    echo "<p style='background-color: yellow; padding: 5px; color:black; height: 20px; width: 130px; border-radius: 30px;'>STATUS: " . $row2['status'] . "</p>";
                } elseif ($row2['status'] == 'cancel') {
                    echo "<p style='background-color: red; padding: 5px; color:white; height: 20px; width: 120px; border-radius: 30px;'>STATUS: " . $row2['status'] . "</p>";
                }
                

                if ($row2['payment'] == 'Paid') {
                echo "<button><a href='ratereview.php?bid=$bookid'> GIVE US RATING </a></button>";
                }
                
                echo "<button><a href='bookpay.php?bid=$bookid'> PAYNOW </a></button>";
                
                if ($row2['payment'] == 'Not Paid') {
                echo "<button><a href='cancel.php?bid=$bookid'> CANCEL </a></button>";
                }
                $_SESSION['bid'] = $bookid;  
                echo "</div>";
                echo "</div>";
            
            }
            
            // Close the result set after fetching
            mysqli_free_result($result_book);
        } else {
            echo "Error executing query: " . mysqli_error($conn);
        }
    } else {
        echo "Session variable 'user_name' not set.";
    }
    
    // Close the connection after all operations
    mysqli_close($conn);
    ?>
</div>

</body>
</html>
