<?php

include "header.php";
include "db.php";

$id = $_GET['id'];

$sql = $conn->prepare("SELECT * FROM result WHERE id = $id");

$sql->execute();

$row = $sql->get_result()->fetch_assoc();

$student_name = $row['student_name'];
$matric_no = $row['matric_no'];
$subject_name = $row['subject_name'];
$subject_code = $row['subject_code'];
$test_1 = $row['test_1'];
$test_2 = $row['test_2'];
$final_examination = $row['final_examination'];

if (isset($_POST['submit'])) {
    $student_name = $_POST['student_name'];
    $matric_no = $_POST['matric_no'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];
    $test_1 = $_POST['test_1'];
    $test_2 = $_POST['test_2'];
    $final_examination = $_POST['final_examination'];

    $total = $test_1 + $test_2 + $final_examination;

    if ($total >= 80)
        $grade = 'A';
    else if ($total >= 65)
        $grade = 'B';
    else if ($total >= 50)
        $grade = 'C';
    else if ($total >= 40)
        $grade = 'D';
    else
        $grade = 'E';

    $sql = $conn->prepare("UPDATE result SET student_name = '$student_name', matric_no = '$matric_no',
    subject_name = '$subject_name', subject_code = '$subject_code', test_1 = '$test_1', test_2 = '$test_2',
    final_examination = '$final_examination', total_marks = '$total', final_grade = '$grade' WHERE id = $id");

    if ($sql->execute()) {
        header("Location: index.php");
        exit();
    }
}

?>


<h2>Edit Result</h2>

<?php
include "form.php";
include "footer.php";
?>