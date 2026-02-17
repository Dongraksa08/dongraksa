<?php
include_once("connectdb.php");

// ส่วนบันทึกข้อมูล
if (isset($_POST['submit'])) {
    $p_name = $_POST['p_name'];
    $r_id = $_POST['r_id'];
    
    // รับข้อมูลรูปภาพ
    $file_name = $_FILES['p_img']['name'];
    $file_tmp = $_FILES['p_img']['tmp_name'];
    
    // กำหนดโฟลเดอร์เก็บรูปให้ตรงกับที่สร้างใน SSH
    $target_dir = "images/"; 
    $target_file = $target_dir . basename($file_name);

    // ย้ายไฟล์รูปไปที่โฟลเดอร์ images
    if (move_uploaded_file($file_tmp, $target_file)) {
        // ใช้ชื่อคอลัมน์ p_ext ตามที่เห็นในรูป image_241f60.jpg
        $sql = "INSERT INTO provinces (p_name, r_id, p_ext) VALUES ('$p_name', '$r_id', '$file_name')";
        mysqli_query($conn, $sql);
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
        table { border-collapse: collapse; width: 100%; max-width: 800px; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>จัดการข้อมูลจังหวัด -- ดวงรักษา อรเพ็ชร (แป้ง)</h1>

    <form method="post" action="" enctype="multipart/form-data">
        ชื่อจังหวัด: <input type="text" name="p_name" required> 
        รูปภาพ: <input type="file" name="p_img" required>
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
        <th>รูปภาพ</th>
        <th>ลบ</th>
      </tr>
    <?php
    // ดึงข้อมูลพร้อมชื่อภาค (INNER JOIN)
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
            <?php if($data['p_ext']){ // แสดงรูปจากคอลัมน์ p_ext ?>
                <img src="images/<?php echo $data['p_ext']; ?>" width="100">
            <?php } ?>
        </td>
        <td>
            <a href="delete_province.php?id=<?php echo $data['p_id']; ?>" onclick="return confirm('ลบไหม?')">
               <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" width="20">
            </a>
        </td>
      </tr>
    <?php } ?>
    </table>
</body>
</html>