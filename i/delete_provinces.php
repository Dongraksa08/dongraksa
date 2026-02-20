<?php
include_once("connectdb.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // 1. หานามสกุลไฟล์จาก DB เพื่อตามไปลบไฟล์จริงในเครื่อง
    $res = mysqli_query($conn, "SELECT p_ext FROM provinces WHERE p_id = '$id'");
    $data = mysqli_fetch_array($res);
    
    if ($data) {
        $file_path = "img/" . $id . "." . $data['p_ext'];
        
        // ลบไฟล์รูปภาพออกจากโฟลเดอร์ img
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        
        // 2. ลบข้อมูลในฐานข้อมูล
        mysqli_query($conn, "DELETE FROM provinces WHERE p_id = '$id'");
    }
}

// เมื่อเสร็จแล้วให้เด้งกลับหน้าหลัก
header("Location: b..php");
exit;
?>