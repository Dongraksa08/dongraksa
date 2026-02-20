<?php
include_once("connectdb.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // ค้นหานามสกุลไฟล์เพื่อลบรูปภาพ
    $res = mysqli_query($conn, "SELECT p_ext FROM provinces WHERE p_id='$id'");
    $data = mysqli_fetch_array($res);
    
    if ($data) {
        $file_to_delete = "img/" . $id . "." . $data['p_ext'];
        if (file_exists($file_to_delete)) {
            unlink($file_to_delete); // ลบไฟล์จริงออกจากเครื่อง
        }
        // ลบข้อมูลในฐานข้อมูล
        mysqli_query($conn, "DELETE FROM provinces WHERE p_id='$id'");
    }
}
// กลับไปที่หน้าหลัก
header("Location: b.php");
?>