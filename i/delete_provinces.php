<?php
include_once("connectdb.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // ค้นหาข้อมูลเพื่อลบไฟล์ภาพออกจากโฟลเดอร์ก่อน
    $query = mysqli_query($conn, "SELECT p_ext FROM provinces WHERE p_id = '$id'");
    $data = mysqli_fetch_array($query);
    
    if ($data) {
        $file_path = "img/" . $id . "." . $data['p_ext'];
        if (file_exists($file_path)) {
            unlink($file_path); // ลบไฟล์รูปภาพออกจากเครื่อง
        }
        
        // ลบข้อมูลในฐานข้อมูล
        mysqli_query($conn, "DELETE FROM provinces WHERE p_id = '$id'");
    }
}


header("Location: b..php");
exit;
?>