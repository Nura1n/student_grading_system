<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Assessment - Student Grading</title>
</head>

<body>
    <?php
    include "db.php";

  $search = $_GET['search'] ?? "";

    $like = "%" . $search . "%";

    //$sql = $conn->prepare("SELECT * FROM result");
    $sql = $conn->prepare("SELECT * FROM result WHERE
    student_name LIKE ? OR
    matric_no LIKE ? OR
    subject_name LIKE ? OR
    subject_code LIKE ?
    ORDER BY student_name");

    $sql->bind_param("ssss", $like, $like, $like, $like);

    $sql->execute();

    $result = $sql->get_result();


    include "header.php";
    ?>
    <h2>Student Records</h2>

    <a href="add.php">+ Add Result</a>

    <br><br>
    <form method="get">
    <input type="text" name="search" placeholder="Search by name or id"
    value = "<?php echo $search ?>">
    <input type="submit" value ="Search">
    <a href="index.php">Show All</a>
    </form>

    <br><br>

    <table border="1">
        <tr>
            <th>No.</th>
            <th>Student Name</th>
            <th>Matric No.</th>
            <th>Subject</th>
            <th>Test 1 (20%)</th>
            <th>Test 2 (30%)</th>
            <th>Final (50%)</th>
            <th>Total (100%)</th>
            <th>Grade</th>
            <th>Actions</th>
        </tr>
        <?php

        $count = 1;

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $count++ . "</td>";
            echo "<td>" . $row['student_name'] . "</td>";
            echo "<td>" . $row['matric_no'] . "</td>";
            echo "<td>" . $row['subject_name'] . "<br>" . "(" . $row['subject_code'] . ")" . "</td>";
            echo "<td>" . $row['test_1'] . "</td>";
            echo "<td>" . $row['test_2'] . "</td>";
            echo "<td>" . $row['final_examination'] . "</td>";
            echo "<td>" . $row['total_marks'] . "</td>";
            echo "<td>" . $row['final_grade'] . "</td>";
            echo "<td>";
            echo "<button><a href= 'edit.php?id=" . $row['id'] . "'>Edit</a></button>";
            echo " ";
            echo "|";
            echo " ";
            echo "<form method= 'post' action='delete.php' onsubmit='return confrirm(\"Delete this?\");'>";
            echo "<input type ='hidden' name ='delete' value='". $row['id'] . "'>";
            echo "<input type = 'submit' value ='Delete'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>

    </table>




</body>


<?php

if($result-> num_rows == 0 ){
    if ($search != "")
        echo "<h3 style='color: red'>No records match your search!!!</h3>";
    else
        echo "<h3 style='color: grey'>No records found !!!!</h3>";
}
include "footer.php";
?>

</html>