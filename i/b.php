<?php
include_once("connectdb.php");

// --- ส่วนการบันทึกข้อมูล ---
if (isset($_POST['Submit'])) {
    $pname = $_POST['pname'];
    $rid = $_POST['rid'];
    $ext = pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION); 
    
    // บันทึกข้อมูลลงตาราง provinces
    $sql = "INSERT INTO provinces (p_name, p_ext, r_id) VALUES ('$pname', '$ext', '$rid')";
    
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        $filename = $last_id . "." . $ext;
        move_uploaded_file($_FILES['pimage']['tmp_name'], "img/" . $filename);
    }
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
        body { font-family: sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; }
        .del-btn img { cursor: pointer; border: none; }
    </style>
</head>
<body>
    <h1>จัดการข้อมูลจังหวัด -- ดวงรักษา อรเพ็ชร (แป้ง)</h1>
    
    <form method="post" enctype="multipart/form-data">
        ชื่อจังหวัด: <input type="text" name="pname" required>
        รูปภาพ: <input type="file" name="pimage" required>
        ภาค: 
        <select name="rid" required>
            <option value="">-- เลือกภาค --</option>
            <?php
            // ดึงรายชื่อภาคมาแสดงใน Dropdown (สมมติชื่อตาราง regions)
            $res_reg = mysqli_query($conn, "SELECT * FROM regions");
            while($row_reg = mysqli_fetch_array($res_reg)) {
                echo "<option value='".$row_reg['r_id']."'>".$row_reg['r_name']."</option>";
            }
            ?>
        </select>
        <button type="submit" name="Submit">บันทึก</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>รหัสจังหวัด</th>
                <th>ชื่อจังหวัด</th>
                <th>ชื่อภาค</th> <th>รูปภาพ</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // ใช้ INNER JOIN เพื่อดึงชื่อภาค (r_name) มาแสดงคู่กับข้อมูลจังหวัด
            // เรียงลำดับ p_id จากน้อยไปมาก เพื่อให้ข้อมูลใหม่ล่าสุดอยู่ล่างสุด
            $sql_view = "SELECT provinces.*, regions.r_name 
                         FROM provinces 
                         INNER JOIN regions ON provinces.r_id = regions.r_id 
                         ORDER BY provinces.p_id ASC";
            
            $result = mysqli_query($conn, $sql_view);
            while ($row = mysqli_fetch_array($result)) {
                $full_img_name = $row['p_id'] . "." . $row['p_ext'];
            ?>
            <tr>
                <td><?php echo $row['p_id']; ?></td>
                <td><?php echo $row['p_name']; ?></td>
                <td><?php echo $row['r_name']; ?></td> <td>
                    <img src="img/<?php echo $full_img_name; ?>" width="100">
                </td>
                <td>
                    <a href="delete_provinces.php?id=<?php echo $row['p_id']; ?>" 
                       onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่')">

                        <img src="img/delete.jpg" width="30" height="30" alt="ลบ">
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>