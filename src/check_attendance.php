<?php include "session.php"; include "db.php"; ?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>เช็คชื่อนักเรียน</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f6f8;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      text-align: center;
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    select {
      padding: 6px 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    @media (max-width: 600px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }

      tr {
        margin-bottom: 15px;
      }

      td {
        text-align: left;
        padding-left: 50%;
        position: relative;
      }

      td::before {
        position: absolute;
        left: 10px;
        width: 45%;
        white-space: nowrap;
        font-weight: bold;
      }

      td:nth-of-type(1)::before { content: "ลำดับ"; }
      td:nth-of-type(2)::before { content: "เลขประจำตัวนักเรียน"; }
      td:nth-of-type(3)::before { content: "ชื่อ"; }
      td:nth-of-type(4)::before { content: "สกุล"; }
      td:nth-of-type(5)::before { content: "สถานะ"; }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>ระบบเช็คชื่อนักเรียน</h1>
    <form action="submit_attendance.php" method="post">
    <table>
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>เลขประจำตัวนักเรียน</th>
          <th>ชื่อ</th>
          <th>สกุล</th>
          <th>สถานะ</th>
        </tr>
      </thead>
      <tbody>
              <?php
                $sql = "SELECT *
                        FROM students
                        ORDER BY student_id ASC";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                          <td>{$row['student_id']}</td>
                          <td>{$row['student_id']}</td>
                          <td>{$row['firstname']}</td>
                          <td>{$row['lastname']}</td>
                          <td>
                              <select name='status[{$row['student_id']}]'>
                                <option>ปกติ</option>
                                <option>สาย</option>
                                <option>ลา</option>
                                <option>ขาด</option>
                              </select>
                          </td>
                        </tr>";
                }
                ?>
       
      </tbody>
    </table>
    <div style="text-align: center; margin-top: 20px;">
    <button type="submit" style="padding: 10px 20px; margin: 5px; background-color: #4CAF50; color: white; border: none; border-radius: 6px; font-size: 16px;">
      ส่งข้อมูลเช็คชื่อ
    </button>
    <button type="button" onclick="window.location='report_page.php'" style="padding: 10px 20px; margin: 5px; background-color: #2196F3; color: white; border: none; border-radius: 6px; font-size: 16px;">
      แสดงรายงาน
    </button>
  </div>
</form>
  </div>

</body>
</html>
