<?php
$host = "localhost";
$user = "root";
$pwd = "r660109"; 
$db = "4007db";


// เชื่อมต่อฐานข้อมูล
$conn = mysqli_connect($host, $user, $pwd, $db) or die("เชื่อมต่อฐานข้อมูลไม่ได้");

// ตั้งค่าให้อ่านภาษาไทยได้
mysqli_query($conn, "SET NAMES utf8");
?>