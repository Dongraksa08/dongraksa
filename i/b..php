<?php
include_once("connectdb.php");

// --- ส่วนการบันทึกข้อมูล ---
if (isset($_POST['Submit'])) {
    $pname = $_POST['pname'];
    $rid = $_POST['rid'];
    $ext = pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION); // ดึงนามสกุลไฟล์
    
    // บันทึกข้อมูลลงตาราง provinces
    $sql = "INSERT INTO provinces (p_name, p_ext, r_id) VALUES ('$pname', '$ext', '$rid')";
    
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        // บันทึกไฟล์ลง img/ โดยใช้ ID.นามสกุล (เช่น 1.jpg)
        $filename = $last_id . "." . $ext;
        move_uploaded_file($_FILES['pimage']['tmp_name'], "img/" . $filename);
    }
    // บันทึกเสร็จแล้วรีเฟรชกลับมาหน้าเดิม
    header("Location: b.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>งาน i -- ดวงรักษา อรเพ็ชร (แป้ง)</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 80%; margin-top: 20px; }
        th { background-color: #f2f2f2; padding: 10px; border: 1px solid #ccc; }
        td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        .del-btn img { cursor: pointer; transition: 0.2s; }
        .del-btn img:hover { transform: scale(1.2); }
    </style>
</head>
<body>
    <h1>จัดการข้อมูลจังหวัด -- ดวงรักษา อรเพ็ชร (แป้ง)</h1>
    
    <form method="post" enctype="multipart/form-data">
        ชื่อจังหวัด: <input type="text" name="pname" autofocus required>
        รูปภาพ: <input type="file" name="pimage" required>
        ภาค: 
        <select name="rid" required>
            <option value="">-- เลือกภาค --</option>
            <option value="17">ภาคตะวันออก</option>
            <option value="27">ภาคตะวันออกเฉียงเหนือ</option>
            <option value="28">ภาคกลาง</option>
            <option value="30">ภาคใต้</option>
            <option value="32">ภาคตะวันตก</option>
            <option value="35">ภาคเหนือ</option>
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
            // เรียงลำดับจาก ID น้อยไปมาก (ASC) เพื่อให้ข้อมูลล่าสุดอยู่ล่างสุด
            $result = mysqli_query($conn, "SELECT * FROM provinces ORDER BY p_id ASC");
            while ($row = mysqli_fetch_array($result)) {
                $full_img_name = $row['p_id'] . "." . $row['p_ext']; //
            ?>
            <tr>
                <td><?php echo $row['p_id']; ?></td>
                <td><?php echo $row['p_name']; ?></td>
                <td><img src="img/<?php echo $full_img_name; ?>" width="150"></td>
                <td>
                    <a href="delete_provinces.php?id=<?php echo $row['p_id']; ?>" 
                       class="del-btn"
                       onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่')">
                        <img src="img/delete.jpg" width="25" height="25" alt="ลบ">
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>