<?php
include_once("connectdb.php");

// ส่วนการบันทึกข้อมูล
if (isset($_POST['Submit'])) {
    $p_name = $_POST['p_name'];
    $r_id = $_POST['r_id'];
    
    // ดึงนามสกุลไฟล์เพื่อเก็บลง p_ext
    $ext = pathinfo($_FILES['p_image']['name'], PATHINFO_EXTENSION);
    
    // บันทึกข้อมูลลงตาราง provinces
    $sql = "INSERT INTO provinces (p_name, p_ext, r_id) VALUES ('$p_name', '$ext', '$r_id')";
    
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        // ตั้งชื่อไฟล์รูปภาพเป็น ID.นามสกุล (เช่น 1.jpg)
        $filename = $last_id . "." . $ext;
        move_uploaded_file($_FILES['p_image']['tmp_name'], "img/" . $filename);
    }
    // บันทึกเสร็จแล้วให้รีเฟรชกลับมาที่หน้าเดิม (b.php)
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
        body { font-family: Tahoma, sans-serif; }
        table { border-collapse: collapse; width: 80%; margin-top: 20px; }
        th { background-color: #f2f2f2; padding: 10px; border: 1px solid #ccc; }
        td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        .btn-del { cursor: pointer; border: none; background: none; }
    </style>
</head>
<body>
    <h1>จัดการข้อมูลจังหวัด -- ดวงรักษา อรเพ็ชร (แป้ง)</h1>
    
    <form method="post" action="" enctype="multipart/form-data">
        ชื่อจังหวัด: <input type="text" name="p_name" autofocus required>
        รูปภาพ: <input type="file" name="p_image" required>
        ภาค: 
        <select name="r_id">
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
            // ดึงข้อมูลจากตาราง provinces
            $res = mysqli_query($conn, "SELECT * FROM provinces");
            while ($row = mysqli_fetch_array($res)) {
                $img_path = "img/" . $row['p_id'] . "." . $row['p_ext'];
            ?>
            <tr>
                <td><?php echo $row['p_id']; ?></td>
                <td><?php echo $row['p_name']; ?></td>
                <td><img src="<?php echo $img_path; ?>" width="150"></td>
                <td>
                    <a href="delete_province.php?id=<?php echo $row['p_id']; ?>" 
                       onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่')">
                        <img src="img/delete.jpg" width="25" height="25" alt="ลบ" class="btn-del">
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>