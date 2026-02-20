<?php
include_once("connectdb.php");

// --- ส่วนการบันทึกข้อมูล ---
if (isset($_POST['Submit'])) {
    $p_name = $_POST['p_name'];
    $r_id = $_POST['r_id'];
    
    // ดึงนามสกุลไฟล์ภาพ
    $ext = pathinfo($_FILES['p_image']['name'], PATHINFO_EXTENSION);
    
    // บันทึกข้อมูลลงฐานข้อมูล (ใช้ชื่อคอลัมน์ตาม provinces.sql)
    $sql = "INSERT INTO provinces (p_name, p_ext, r_id) VALUES ('$p_name', '$ext', '$r_id')";
    
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn); // ดึง ID ล่าสุดที่เพิ่งบันทึก
        
        // ตั้งชื่อไฟล์ภาพเป็น ID.นามสกุล เช่น 5.jpg
        $filename = $last_id . "." . $ext;
        
        // ตรวจสอบและสร้างโฟลเดอร์ img ถ้ายังไม่มี
        if (!is_dir('img')) { mkdir('img'); }
        
        move_uploaded_file($_FILES['p_image']['tmp_name'], "img/" . $filename);
    }
    
    // บันทึกเสร็จแล้วให้โหลดหน้าเดิมใหม่
    header("Location: b.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>จัดการข้อมูลจังหวัด -- ดวงรักษา อรเพ็ชร (แป้ง)</title>
    <style>
        body { font-family: 'Tahoma', sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 80%; margin-top: 20px; }
        th { background-color: #f2f2f2; padding: 10px; border: 1px solid #999; }
        td { padding: 8px; border: 1px solid #999; text-align: center; }
        .del-btn img { cursor: pointer; transition: 0.2s; }
        .del-btn img:hover { transform: scale(1.2); }
    </style>
</head>
<body>

    <h2>จัดการข้อมูลจังหวัด -- ดวงรักษา อรเพ็ชร (แป้ง)</h2>

    <form method="post" action="" enctype="multipart/form-data">
        ชื่อจังหวัด: <input type="text" name="p_name" required autofocus> 
        รูปภาพ: <input type="file" name="p_image" required> 
        ภาค: 
        <select name="r_id" required>
            <option value="">-- เลือกภาค --</option>
            <option value="1">ภาคเหนือ</option>
            <option value="2">ภาคตะวันออกเฉียงเหนือ</option>
            <option value="3">ภาคกลาง</option>
            <option value="4">ภาคใต้</option>
        </select>
        <button type="submit" name="Submit">บันทึก</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Province ID</th>
                <th>Province Name</th>
                <th>Province Picture</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $res = mysqli_query($conn, "SELECT * FROM provinces ORDER BY p_id DESC");
            while ($row = mysqli_fetch_array($res)) {
                $img_path = "img/" . $row['p_id'] . "." . $row['p_ext'];
            ?>
            <tr>
                <td><?php echo $row['p_id']; ?></td>
                <td><?php echo $row['p_name']; ?></td>
                <td>
                    <?php if (file_exists($img_path)) { ?>
                        <img src="<?php echo $img_path; ?>" width="120">
                    <?php } else { echo "ไม่มีรูปภาพ"; } ?>
                </td>
                <td>
                    <a href="delete_province.php?id=<?php echo $row['p_id']; ?>" 
                       class="del-btn"
                       onclick="return confirm('คุณต้องการลบข้อมูลจังหวัด <?php echo $row['p_name']; ?> ใช่หรือไม่?')">
                        <img src="img/delete.jpg" width="30" height="30" alt="ลบ">
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>