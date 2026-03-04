<?php
include("connectdb.php");

if(isset($_POST['Submit'])) {
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];

    // จัดการเรื่องรูปภาพ
    $temp_file = $_FILES['pimage']['tmp_name']; // ไฟล์ที่อัปโหลดมาชั่วคราว
    $file_name = $_FILES['pimage']['name'];     // ชื่อไฟล์จริง
    $ext = pathinfo($file_name, PATHINFO_EXTENSION); // นามสกุลไฟล์ (.jpg, .png)
    
    // ตั้งชื่อไฟล์ใหม่เพื่อป้องกันชื่อซ้ำ (ใช้เวลา + สุ่มตัวเลข)
    $new_name = time() . "_" . rand(100, 999) . "." . $ext;
    $target_path = "images/" . $new_name;

    // ย้ายไฟล์ไปเก็บในโฟลเดอร์ images
    if(move_uploaded_file($temp_file, $target_path)) {
        // บันทึกชื่อไฟล์ ($new_name) ลงใน Database
        $sql = "INSERT INTO products (p_name, p_price, p_img) 
                VALUES ('$pname', '$pprice', '$new_name')";
        
        if(mysqli_query($conn, $sql)) {
            echo "<script>alert('เพิ่มสินค้าและรูปภาพสำเร็จ'); window.location='index.php';</script>";
        } else {
            echo "Error DB: " . mysqli_error($conn);
        }
    } else {
        echo "ไม่สามารถอัปโหลดไฟล์รูปภาพได้";
    }
}
?>