<?php
include_once("connectdb.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // ค้นหานามสกุลไฟล์เพื่อลบรูปภาพ
    $query = mysqli_query($conn, "SELECT p_ext FROM provinces WHERE p_id = '$id'");
    $data = mysqli_fetch_array($query);
    
    if ($data) {
        $file_path = "img/" . $id . "." . $data['p_ext'];
        if (file_exists($file_path)) {
            unlink($file_path); 
        }
        mysqli_query($conn, "DELETE FROM provinces WHERE p_id = '$id'");
    }
}
header("Location: b.php");
exit;
?>