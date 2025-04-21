<?php
include "session.php";
include "db.php";

$date = date('Y-m-d');
$teacher = $_SESSION['teacher'];

// สร้าง record ใหม่
$conn->query("INSERT INTO attendance_records (date, teacher_name) VALUES ('$date', '$teacher')");
$record_id = $conn->insert_id;

foreach ($_POST['status'] as $student_id => $status) {
    $stmt = $conn->prepare("INSERT INTO attendance_details (record_id, student_id, status) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $record_id, $student_id, $status);
    $stmt->execute();
}

header("Location: report.php");
exit();