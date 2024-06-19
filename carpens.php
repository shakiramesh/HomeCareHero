<!DOCTYPE html>
<html>

<head>
    <title>HOME CARE HEROS</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="carestyles.css">

    <style>
        .ser-list {
            display: flex;
            justify-content: center;
            /* Center containers horizontally */
            gap: 20px;
            margin-left: -40px;
        }

        .con-data {
            width: 210%;
            /* Adjust the width based on your design preference */
            margin: 20px;
            padding: 20px;
            background-color: #f2f2f2;
            text-align: center;
            border-radius: 20px;
            border: 1px solid black;
        }

        img {
            height: 100px;
            border-radius: 50px;
            float: left;
        }

        .ser-list {
            height: auto;
        }

        button {
            float: right;
            margin-top: -70px;
        }

        p {
            margin-left: -20px;
        }

        .ts-container {
            padding-left: -30px;
        }
    </style>

</head>

<body>
    <?php include('header.php'); ?>
    <div class="ser-list">

        <br>
        <br>
        <div class="ts-container">

            <center>
            <h1>BOOK SERVICE</h1>
            </center>

            <?php
            session_start();
            include 'connection.php';

            // condition to check isset or not
            if (isset($_GET['service'])) {
                $serviceid  = $_GET['service'];
                 $_SESSION['serviceid']  = $serviceid;

                $name = isset($_GET['name']) ? $_GET['name'] : '';
                $empid  = isset($_GET['empid']) ? $_GET['empid'] : '';

                $sql = "SELECT empid, name, ph_num, serviceid, catid, myfile FROM empregi WHERE serviceid=$serviceid";
                $result = $conn->query($sql);

                // Display data in containers
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $catid  = $row['catid'];
                        $_SESSION['catid']  = $catid;
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
            ?>
        </div>
    </div>

    <hr>
    <?php include('footer.php'); ?>
</body>

</html>
