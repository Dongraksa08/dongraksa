<?php
include_once("connectdb.php");

// ส่วนบันทึกข้อมูล
if (isset($_POST['submit'])) {
    $p_name = $_POST['p_name'];
    $r_id = $_POST['r_id'];
    
    // รับข้อมูลไฟล์
    $file_name = $_FILES['p_img']['name'];
    $file_tmp = $_FILES['p_img']['tmp_name'];
    
    // ตรวจสอบว่ามีการเลือกไฟล์มาจริงหรือไม่
    if ($file_name != "") {
        // กำหนดที่อยู่เก็บไฟล์ (โฟลเดอร์ images)
        $target_dir = "images/"; 
        $target_file = $target_dir . basename($file_name);

        // ย้ายไฟล์ขึ้นเซิร์ฟเวอร์ (รองรับทุกนามสกุล)
        if (move_uploaded_file($file_tmp, $target_file)) {
            // บันทึกชื่อไฟล์ลงคอลัมน์ p_ext ตามโครงสร้างฐานข้อมูลของแป้ง
            $sql = "INSERT INTO provinces (p_name, r_id, p_ext) VALUES ('$p_name', '$r_id', '$file_name')";
            mysqli_query($conn, $sql);
        }
    }
    
    header("location: b.php");
    exit();
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>จัดการข้อมูลจังหวัด -- ดวงรักษา อรเพ็ชร</title>
    <style>
        body { font-family: Tahoma, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; max-width: 900px; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; }
        img { max-width: 100px; height: auto; }
    </style>
</head>
<body>
    <h1>จัดการข้อมูลจังหวัด -- ดวงรักษา อรเพ็ชร (แป้ง)</h1>

    <form method="post" action="" enctype="multipart/form-data">
        ชื่อจังหวัด: <input type="text" name="p_name" required> 
        รูปภาพ/ไฟล์: <input type="file" name="p_img" required>
        ภาค: 
        <select name="r_id" required>
            <option value="">-- เลือกภาค --</option>
            <?php
            $q_reg = mysqli_query($conn, "SELECT * FROM regions ORDER BY r_name ASC");
            while($r = mysqli_fetch_array($q_reg)){
                echo "<option value='".$r['r_id']."'>".$r['r_name']."</option>";
            }
            ?>
        </select>
        <input type="submit" name="submit" value="บันทึก">
    </form>

    <table>
      <tr>
        <th>รหัส</th>
        <th>จังหวัด</th>
        <th>ภาค</th>
        <th>ไฟล์ที่อัปโหลด</th>
        <th>ลบ</th>
      </tr>
    <?php
    $sql_show = "SELECT provinces.*, regions.r_name 
                 FROM provinces 
                 INNER JOIN regions ON provinces.r_id = regions.r_id 
                 ORDER BY provinces.p_id ASC";
    $rs = mysqli_query($conn, $sql_show);
    while ($data = mysqli_fetch_array($rs)){
    ?>
      <tr>
        <td><?php echo $data['p_id']; ?></td>
        <td><?php echo $data['p_name']; ?></td>
        <td><?php echo $data['r_name']; ?></td>
        <td>
            <?php if($data['p_ext']){ 
                // เช็คว่าเป็นไฟล์รูปภาพหรือไม่ เพื่อแสดงผลเป็นรูป
                $file_path = "images/" . $data['p_ext'];
                echo "<img src='$file_path' alt='ไฟล์: {$data['p_ext']}'>";
            } ?>
        </td>
        <td>
            <a href="delete_province.php?id=<?php echo $data['p_id']; ?>" onclick="return confirm('ลบข้อมูลนี้?')">
               <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" width="20" alt="ลบ">
            </a>
        </td>
      </tr>
    <?php } ?>
    </table>
</body>
</html>