<?php
    session_start();
    
    uns ($_SESSION['aid']);
    unset($_SESSION['aname']);
        echo "<script>";
        echo "window.location='index2.php';"; // เพิ่ม ' หน้าชื่อไฟล์
        echo "</script>";
?>