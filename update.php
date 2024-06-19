<?php
include 'connection.php';

if(isset($_GET['upid'])) {
    $id = $_GET['upid'];

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $ph_num = $_POST['ph_num'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $category = $_POST['category'];
        $service = $_POST['service'];
        $exp = $_POST['exp'];

        // Update the database
        $sql = "UPDATE `empregi` SET `name`='$name', `gender`='$gender', `ph_num`='$ph_num', `email`='$email', `address`='$address', `cat`='$category', `service`='$service', `exp`='$exp' WHERE `empid`='$id'";
        $result = mysqli_query($conn, $sql);

        if($result) {
            header("Location: emplist.php"); // Assuming index.php is the main page
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}

// Fetch the existing data for the employee
$sql = "SELECT * FROM `empregi` WHERE `empid`='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
           
        }

        form {
            background-color: #ffffff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 500px;
            width: 600px;
        }

        label {
            text-align: left;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 80%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: justify;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

    </style>
</head>

<body>
<center>
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">

        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" value="<?php echo $row['gender']; ?>">

        <label for="ph_num">Phone:</label>
        <input type="text" id="ph_num" name="ph_num" value="<?php echo $row['ph_num']; ?>">

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>">

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>">

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo $row['cat']; ?>">

        <label for="service">Service:</label>
        <input type="text" id="service" name="service" value="<?php echo $row['service']; ?>">

        <label for="exp">Experience:</label>
        <input type="text" id="exp" name="exp" value="<?php echo $row['exp']; ?>">

        <input type="submit" value="Update">
    </form>
    </center>
</body>

</html>

