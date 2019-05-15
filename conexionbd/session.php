<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['user_codigo'])) {
    echo "<script> window.location='../../login.php'; </script>";
}
?>
