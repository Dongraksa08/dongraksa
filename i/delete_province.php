<?php
include_once("connectdb.php");

// ตรวจสอบว่ามีการส่ง id ของจังหวัดที่ต้องการลบมาหรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // 1. ดึงชื่อไฟล์จากคอลัมน์ p_ext มาเก็บไว้ก่อนลบข้อมูลใน DB
    $sql_file = "SELECT p_ext FROM provinces WHERE p_id = '$id'";
    $res = mysqli_query($conn, $sql_file);
    $row = mysqli_fetch_array($res);
    $filename = $row['p_ext'];
    
    // 2. ลบไฟล์จริงออกจากโฟลเดอร์ images (ถ้ามีไฟล์อยู่)
    if ($filename != "") {
        $file_path = "images/" . $filename;
        if (file_exists($file_path)) {
            @unlink($file_path); // คำสั่งลบไฟล์ออกจาก Server
        }
    }
    
    // 3. ลบข้อมูลจังหวัดออกจากฐานข้อมูล
    $sql_delete = "DELETE FROM provinces WHERE p_id = '$id'";
    mysqli_query($conn, $sql_delete);
}

// ลบเสร็จแล้วให้กระโดดกลับไปหน้า b.php
header("location: b.php");
exit();
?>