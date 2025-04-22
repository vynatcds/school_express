<?php
$host = 'db';
$user = 'se_user';
$pass = '123456';
$db = 'school_express_database';
 
$conn = new mysqli($host, $user, $pass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected to MySQL server successfully!";
}
?>