<?php include "session.php"; include "db.php"; ?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>รายงานการเช็คชื่อ</title></head>
<body>
<h2>รายงานการเช็คชื่อ</h2>

<table border="1">
  <tr>
    <th>วันที่</th><th>รหัส</th><th>ชื่อ</th><th>สกุล</th><th>สถานะ</th>
  </tr>
<?php
$sql = "SELECT a.date, s.student_id, s.firstname, s.lastname, d.status
        FROM attendance_details d
        JOIN students s ON d.student_id = s.student_id
        JOIN attendance_records a ON d.record_id = a.record_id
        ORDER BY a.date DESC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>
      <td>{$row['date']}</td>
      <td>{$row['student_id']}</td>
      <td>{$row['firstname']}</td>
      <td>{$row['lastname']}</td>
      <td>{$row['status']}</td>
    </tr>";
}
?>
</table>

<br>
<a href="export_excel.php">Export Excel</a> |
<a href="export_pdf.php">Export PDF</a>
</body>
</html>