<?php
include_once("connectdb.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 1. ดึงข้อมูลเพื่อหานามสกุลไฟล์ภาพก่อนลบ
    $sql_file = "SELECT p_id, p_ext FROM provinces WHERE p_id = '$id'";
    $result_file = mysqli_query($conn, $sql_file);
    $row = mysqli_fetch_array($result_file);
    
    if ($row) {
        $full_path = "img/" . $row['p_id'] . "." . $row['p_ext'];
        
        // 2. ลบไฟล์ภาพในโฟลเดอร์ img/
        if (file_exists($full_path)) {
            unlink($full_path);
        }

        // 3. ลบข้อมูลในฐานข้อมูล
        $sql_delete = "DELETE FROM provinces WHERE p_id = '$id'";
        mysqli_query($conn, $sql_delete);
    }
}

// ลบเสร็จแล้วเด้งกลับหน้าหลัก
echo "<script>window.location='b..php';</script>";
?>