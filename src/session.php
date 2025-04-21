<?php
session_start();
if (!isset($_SESSION['teacher'])) {
    header("Location: index.php");
    exit();
}
?>