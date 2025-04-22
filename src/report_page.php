<?php include "session.php"; include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>รายงานการเช็คชื่อ</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0fff4;
      color: #2e7d32;
      margin: 30px;
    }

    h2 {
      text-align: center;
      color: #1b5e20;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background-color: #ffffff;
    }

    th, td {
      border: 1px solid #a5d6a7;
      padding: 12px;
      text-align: center;
    }

    th {
      background-color: #81c784;
      color: #ffffff;
    }

    tr:nth-child(even) {
      background-color: #e8f5e9;
    }

    a.button {
      display: inline-block;
      margin: 15px 10px 0 0;
      padding: 10px 20px;
      background-color: #66bb6a;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    a.button:hover {
      background-color: #4caf50;
    }

    .buttons {
      margin-top: 20px;
      text-align: center;
    }
  </style>
</head>
<body>

<h2>รายงานการเช็คชื่อ</h2>

<table>
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

<div class="buttons">
  <a class="button" href="check_attendance.php">กลับไปยังหน้าเช็คชื่อ</a>
  <a class="button" href="export_excel.php">Export Excel</a>
  <a class="button" href="export_pdf.php">Export PDF</a>
</div>

</body>
</html>
