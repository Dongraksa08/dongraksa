<?php
// 1. เชื่อมต่อฐานข้อมูล (เปลี่ยนค่าตามเครื่องของคุณ)
$conn = new mysqli("localhost", "root", "", "your_database_name");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// 2. ส่วนการบันทึกข้อมูลเมื่อกดปุ่ม "บันทึก"
if (isset($_POST['save'])) {
    $province_name = $_POST['province_name'];
    $region = $_POST['region'];
    $file_name = "";

    // จัดการอัปโหลดไฟล์
    if (!empty($_FILES['file_upload']['name'])) {
        $file_name = time() . "_" . $_FILES['file_upload']['name'];
        move_uploaded_file($_FILES['file_upload']['tmp_name'], "uploads/" . $file_name);
    }

    $sql = "INSERT INTO provinces (province_name, region, file_path) VALUES ('$province_name', '$region', '$file_name')";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']); // refresh หน้า
}

// 3. ส่วนการลบข้อมูล
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM provinces WHERE id=$id");
    header("Location: " . $_SERVER['PHP_SELF']);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จัดการข้อมูลจังหวัด</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 60%; border-collapse: collapse; margin-top: 20px; text-align: center; }
        table, th, td { border: 1px solid #ccc; }
        th { background-color: #f2f2f2; padding: 10px; }
        td { padding: 8px; }
        .form-section { margin-bottom: 20px; font-weight: bold; }
    </style>
</head>
<body>

    <h2>จัดการข้อมูลจังหวัด -- ดวงรักษา อรเพ็ชร (แป้ง)</h2>

    <div class="form-section">
        <form action="" method="post" enctype="multipart/form-data">
            ชื่อจังหวัด: <input type="text" name="province_name" required>
            รูปภาพ/ไฟล์: <input type="file" name="file_upload">
            ภาค: 
            <select name="region">
                <option value="">-- เลือกภาค --</option>
                <option value="เหนือ">เหนือ</option>
                <option value="กลาง">กลาง</option>
                <option value="อีสาน">อีสาน</option>
                <option value="ใต้">ใต้</option>
            </select>
            <button type="submit" name="save">บันทึก</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th width="15%">รหัส</th>
                <th width="30%">จังหวัด</th>
                <th width="20%">ภาค</th>
                <th width="25%">ไฟล์ที่อัปโหลด</th>
                <th width="10%">ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM provinces");
            while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['province_name']; ?></td>
                <td><?php echo $row['region']; ?></td>
                <td><?php echo $row['file_path']; ?></td>
                <td><a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>