<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM teachers WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password); // ใน production ควรใช้ password_hash
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['teacher'] = $username;
        header("Location: check_attendance.php");
        exit();
    } else {
        $error = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>เข้าสู่ระบบครู</title>
  <style>
    *,
*::before,
*::after {
  box-sizing: border-box;
}
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #4CAF50, #2E7D32);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      background: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 5px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    button {
      width: 100%;
      background-color: #4CAF50;
      color: white;
      padding: 12px;
      margin: 5px 0;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #45a049;
    }

    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
    }

    @media (max-width: 480px) {
      .login-box {
        padding: 30px 20px;
      }

      h2 {
        font-size: 22px;
      }
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>เข้าสู่ระบบเช็คชื่อสำหรับครู</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="ชื่อผู้ใช้" required>
      <input type="password" name="password" placeholder="รหัสผ่าน" required>
      <button type="submit">เข้าสู่ระบบ</button>
    </form>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
  </div>
</
