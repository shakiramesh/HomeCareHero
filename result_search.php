<?php
include 'connection.php';
session_start();

if (isset($_POST['input'])) {
    $input = $_POST['input'];

    // Using prepared statements for category search
    $sql_categories = "SELECT * FROM `addcategory` WHERE catname LIKE ?";
    $stmt_categories = mysqli_prepare($conn, $sql_categories);
    if ($stmt_categories) {
        mysqli_stmt_bind_param($stmt_categories, "s", $input);
        mysqli_stmt_execute($stmt_categories);
        $result_categories = mysqli_stmt_get_result($stmt_categories);

        if ($result_categories->num_rows > 0) {
            while ($row2 = $result_categories->fetch_assoc()) {
                $caid = $row2['catid'];
                $catname = $row2['catname'];

                // Using prepared statements for employee search
                $sql_employees = "SELECT empid, name, ph_num, serviceid, catid, myfile FROM empregi WHERE catid = ?";
                $stmt_employees = mysqli_prepare($conn, $sql_employees);
                if ($stmt_employees) {
                    mysqli_stmt_bind_param($stmt_employees, "i", $input);
                    mysqli_stmt_execute($stmt_employees);
                    $result_employees = mysqli_stmt_get_result($stmt_employees);

                    if ($result_employees->num_rows > 0) {
                        while ($row = $result_employees->fetch_assoc()) {
                            $empid = $row['empid'];
                            $imageSource = htmlspecialchars($row['myfile']);
                            $name = htmlspecialchars($row['name']);

                            // Displaying data
                            echo "
                            <div class='con-data'>
                                <img src='{$imageSource}' alt='Avatar' style='width:100px'/>
                                <p>NAME: {$name}</p>
                                <p>CONTACT: " . htmlspecialchars($row["ph_num"]) . "</p>
                                <p>EXPERT IN: {$catname}</p>
                            </div>";

                            $_SESSION['emp'] = $empid;
                            echo "<button><a href='fakebook.php?emp={$empid}'>BOOK NOW</a></button>";
                        }
                    } else {
                        echo "No employees found for category {$catname}.";
                    }
                    mysqli_stmt_close($stmt_employees);
                } else {
                    echo "Employee statement preparation failed.";
                }
            }
        } else {
            echo "No categories found for input '{$input}'.";
        }
        mysqli_stmt_close($stmt_categories);
    } else {
        echo "Category statement preparation failed.";
    }
} else {
    echo "No input provided.";
}
?>
