<?php

include "session.php";
include "db.php";


$date = date('Y-m-d');
$teacher = $_SESSION['teacher'];

// var_dump($_POST,$_SESSION);
// foreach ($_POST['status'] as $student_id => $status) {
//    echo "<br>";
//    echo "student_id ".$student_id."<br>";
//    echo "status ".$status."<br>";
// }
// exit();

// เริ่มต้น Transaction
$conn->begin_transaction();
try {
    // 1. บันทึกหัวรายการ
    $sql = "INSERT INTO attendance_records (date, teacher_name) VALUES ('$date', '$teacher')";
    if (!$conn->query($sql)) {
        throw new Exception("บันทึก attendance_records ไม่สำเร็จ: " . $conn->error);
    }
    $record_id = $conn->insert_id;

     // 2. บันทึกรายละเอียดของแต่ละนักเรียน
     $stmt = $conn->prepare("INSERT INTO attendance_details (record_id, student_id, status) VALUES (?, ?, ?)");
     if (!$stmt) {
         throw new Exception("เตรียม statement ล้มเหลว: " . $conn->error);
     }
 
     foreach ($_POST['status'] as $student_id => $status) {
         $stmt->bind_param("iis", $record_id, $student_id, $status);
         if (!$stmt->execute()) {
             throw new Exception("บันทึก attendance_details ล้มเหลว: " . $stmt->error);
         }
         
     }
     // ถ้าทุกอย่างผ่าน → commit
    $conn->commit();
    echo "<script>
        alert('บันทึกข้อมูลเช็คชื่อสำเร็จ');
        window.history.back();
    </script>";
     

} catch(Exception $e) {
    // ถ้ามีข้อผิดพลาด → rollback
    $conn->rollback();
    echo "<script>
        alert('เกิดข้อผิดพลาด: " . $e->getMessage() . "');
        window.history.back();
    </script>";
}

// header("Location: report_page.php");
exit();
?>