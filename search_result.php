<?php
include 'connection.php';


if (isset($_POST['input'])) {
    $input = $_POST['input'];

            $sql_employees = "SELECT empid, name, ph_num, service, cat, myfile FROM empregi WHERE cat LIKE '{$input}%'";
            $result_employees = $conn->query($sql_employees);

            if ($result_employees && $result_employees->num_rows > 0) {
                while ($row = $result_employees->fetch_assoc()) {
                    $cat = $row['cat'];
                    $_SESSION['cat'] = $cat;
                    $empid = $row['empid'];
                    $imageSource = $row['myfile'];
                    $name = $row['name'];


                            // Separate PHP and HTML for better readability
                            echo "<div class='con-data'>";
                            echo '<img src="' . $imageSource . '" alt="Avatar" style="width:100px"/>';
                            echo "<p>NAME: " . $row["name"] . "</p>";
                            echo "<p>CONTACT: " . $row["ph_num"] . "</p>";
                            echo "<p>EXPERT IN: " . $cat . "</p>";
                            $_SESSION['emp'] = $empid;
                            echo "<button><a href='fakebook.php?emp=$empid'>BOOK NOW</a></button>";
                            echo "</div>";
                            
                        }
                    } else {
                        echo "No data found.";
                    }
                }
          
?>
