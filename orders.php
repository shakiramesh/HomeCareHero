<?php
include 'connection.php';

      $bid 

// Check if the payment_id and all necessary POST parameters are set
if(isset($_GET['payment_id']) && 
   isset($_POST['username']) && 
   isset($_POST['bookid']) && 
   isset($_POST['invoice']) && 
   isset($_POST['cat']) && 
   isset($_POST['amount'])) {

    $payment_id = $_GET['payment_id'];
    $username = $_POST['username'];  // Assuming this is the username associated with the payment
    $bookid = $_POST['bookid'];
    $invoice = $_POST['invoice'];
    $cat = $_POST['cat'];
    $amount = $_POST['amount'];
   
    // Insert payment details into paydetails table
    $sql = "INSERT INTO paydetails (pay_id, user, bookid, invoice, category, amount, date)
            VALUES ('$payment_id', '$username','$bookid', '$invoice','$cat', '$amount', NOW())";

    if(mysqli_query($conn, $sql)) {
        echo "Payment details stored successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
