<?php
include_once("connectdb.php");

// ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // คำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM regions WHERE r_id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        // ลบสำเร็จ ให้กลับไปหน้าหลัก
        header("location: a.php");
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
    }
} else {
    // ถ้าไม่มีการส่ง id มา ให้กลับหน้าหลักทันที
    header("location: a.php");
    exit();
}

mysqli_close($conn);
?>