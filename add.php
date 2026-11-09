<?php

include "header.php";
include "db.php";


$student_name = "";
$matric_no = "";
$subject_name = "";
$subject_code = "";
$test_1 = "";
$test_2 = "";
$final_examination = "";

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

    $sql = $conn->prepare("INSERT INTO result(student_name, matric_no, subject_name, subject_code, test_1, test_2, final_examination, total_marks, final_grade) 
        VALUES ('$student_name','$matric_no','$subject_name', '$subject_code', '$test_1', '$test_2' , '$final_examination', $total, '$grade')");

    if ($sql->execute()) {
        header("Location: index.php");
        exit();
    }
}
?>


<h2>Add Result</h2>

<?php
include "form.php";
include "footer.php";
?>