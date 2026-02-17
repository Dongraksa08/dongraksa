<?php
include_once("connectdb.php");

// ส่วนบันทึกข้อมูล
if (isset($_POST['submit'])) {
    $p_name = $_POST['p_name'];
    $r_id = $_POST['r_id'];
    
    // จัดการอัปโหลดรูปภาพ
    $ext = pathinfo(basename($_FILES['p_img']['name']), PATHINFO_EXTENSION);
    $new_file_name = "img_" . uniqid() . "." . $ext;
    $target_path = "images/" . $new_file_name;
    move_uploaded_file($_FILES['p_img']['tmp_name'], $target_path);

    $sql = "INSERT INTO provinces (p_name, r_id, p_img) VALUES ('$p_name', '$r_id', '$new_file_name')";
    mysqli_query($conn, $sql);
    header("location: b.php");
    exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ดวงรักษา อรเพ็ชร</title>
</head>
<body>
<h1>งาน i -- 66010914007 ดวงรักษา อรเพ็ชร (แป้ง)</h1>

<form method="post" action="" enctype="multipart/form-data">
    ชื่อจังหวัด <input type="text" name="p_name" required> 
    รูปภาพ <input type="file" name="p_img" required><br><br>
    ภาค 
    <select name="r_id">
    <?php
    $sql_r = "SELECT * FROM regions ORDER BY r_name ASC";
    $rs_r = mysqli_query($conn, $sql_r);
    while($data_r = mysqli_fetch_array($rs_r)){
        echo "<option value='{$data_r['r_id']}'>{$data_r['r_name']}</option>";
    }
    ?>
    </select><br><br>
    <input type="submit" name="submit" value="บันทึก">
</form>

<table border="1" style="margin-top:20px;">
  <tr>
    <th>รหัสจังหวัด</th>
    <th>ชื่อจังหวัด</th>
    <th>รูป</th>
    <th>ลบ</th>
  </tr>
<?php
$sql_p = "SELECT * FROM provinces ORDER BY p_id ASC";
$rs_p = mysqli_query($conn, $sql_p);
while ($data_p = mysqli_fetch_array($rs_p)){
?>
  <tr>
    <td><?php echo $data_p['p_id']; ?></td>
    <td><?php echo $data_p['p_name']; ?></td>
    <td align="center">
        <img src="images/<?php echo $data_p['p_img']; ?>" width="50" alt="ไม่มีรูป">
    </td>
    <td align="center">
        <a href="delete_province.php?id=<?php echo $data_p['p_id']; ?>" onclick="return confirm('ลบหรือไม่?')">
            <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" width="20">
        </a>
    </td>
  </tr>
<?php } ?>
</table>
</body>
</html>