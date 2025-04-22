<?php
require_once('./vendor/autoload.php');
include "db.php";

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

define('SARABUN_BOLDR', TCPDF_FONTS::addTTFfont(dirname(__FILE__).'/fonts/Sarabun-Bold.ttf', 'TrueTypeUnicode'));
define('SARABUN_REGULAR', TCPDF_FONTS::addTTFfont(dirname(__FILE__).'/fonts/Sarabun-Regular.ttf', 'TrueTypeUnicode'));

$pdf->AddPage();
$pdf->SetFont(SARABUN_REGULAR, '', 16);



$html = '<h2>รายงานการเช็คชื่อ</h2><table border="1" cellpadding="4"><tr>
  <th>วันที่</th><th>รหัส</th><th>ชื่อ</th><th>สกุล</th><th>สถานะ</th></tr>';

$sql = "SELECT a.date, s.student_id, s.firstname, s.lastname, d.status
        FROM attendance_details d
        JOIN students s ON d.student_id = s.student_id
        JOIN attendance_records a ON d.record_id = a.record_id";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $html .= "<tr><td>{$row['date']}</td><td>{$row['student_id']}</td><td>{$row['firstname']}</td><td>{$row['lastname']}</td><td>{$row['status']}</td></tr>";
}

$html .= '</table>';
$pdf->writeHTML($html);
$pdf->Output('attendance_report.pdf', 'I');
?>