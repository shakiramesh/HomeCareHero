<?php
// Include your database connection file or write the connection code here
include 'connection.php';

session_start();


    if(isset($_POST['input'])){
            $input = $_POST['input'];
    
             $sql= "SELECT * FROM `addcategory` WHERE catname LIKE'{$INPUT}%' ";
             $result=mysqli_query($conn,$sql);
             if($result){
                     // condition to check isset or not
    if (isset($_GET['service'])) {
        $serviceid  = $_GET['service'];
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $empid  = isset($_GET['empid']) ? $_GET['empid'] : '';

        $sql = "SELECT empid, name, ph_num, serviceid, catid, myfile FROM empregi WHERE serviceid=$serviceid";
        $result = $conn->query($sql);

        // Display data in containers
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $catid  = $row['catid'];
                $empid  = $row['empid'];
                $imageSource = $row['myfile'];
                $name = $row['name'];

                $sql_select = "SELECT catname FROM addcategory WHERE catid=$catid";
                $result_select = $conn->query($sql_select);
                if ($result_select->num_rows > 0) {
                    while ($row2 = $result_select->fetch_assoc()) {
                        $catname = $row2['catname'];

                        echo "<div class='con-data'>";
                        echo '<img src="' . $imageSource . '" alt="Avatar" style="width:100px"/>';
                        echo "<p>NAME: " . $row["name"] . "</p>";
                        echo "<p>CONTACT: " . $row["ph_num"] . "</p>";
                        echo "<p>EXPERT IN: " . $catname . "</p>";
                        $_SESSION['emp'] = $empid;
                        echo "<button><a href='fakebook.php?emp=$empid'>BOOK NOW</a></button>";
                        echo "</div>";
                    }
                } else {
                    echo "No data found.";
                }
            }
        } else {
            echo "No data found.";
        }
        $conn->close();
    } else {
        echo "No data found.";
    }
            }
    }else {
        echo "No data found.";
    }

    
?>

