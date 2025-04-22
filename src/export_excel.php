<?php
include "db.php";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=attendance_report.xls");

echo "วันที่\tรหัส\tชื่อ\tสกุล\tสถานะ\n";

$sql = "SELECT a.date, s.student_id, s.firstname, s.lastname, d.status
        FROM attendance_details d
        JOIN students s ON d.student_id = s.student_id
        JOIN attendance_records a ON d.record_id = a.record_id";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "{$row['date']}\t{$row['student_id']}\t{$row['firstname']}\t{$row['lastname']}\t{$row['status']}\n";
}
?>