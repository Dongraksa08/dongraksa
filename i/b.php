<?php
include_once("connectdb.php");

// ส่วนบันทึกข้อมูล
if (isset($_POST['submit'])) {
    $p_name = $_POST['p_name'];
    $r_id = $_POST['r_id'];
    
    // จัดการรูปภาพ
    $file_name = $_FILES['p_img']['name'];
    $file_tmp = $_FILES['p_img']['tmp_name'];
    move_uploaded_file($file_tmp, "images/".$file_name);

    $sql_insert = "INSERT INTO provinces (p_name, r_id, p_img) VALUES ('$p_name', '$r_id', '$file_name')";
    mysqli_query($conn, $sql_insert);
    header("location: b.php");
    exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ดวงรักษา อรเพ็ชร</title>
<style>
    body { font-family: Tahoma, Geneva, sans-serif; padding: 20px; }
    table { border-collapse: collapse; width: 100%; max-width: 800px; margin-top: 20px; }
    th, td { border: 1px solid #333; padding: 10px; text-align: center; }
    th { background-color: #eee; }
    img { border-radius: 4px; object-fit: cover; }
    .btn-del { color: red; text-decoration: none; font-size: 20px; }
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
    <th>รหัสจังหวัด</th>
    <th>ชื่อจังหวัด</th>
    <th>ชื่อภาค</th>
    <th>รูป</th>
    <th>ลบ</th>
  </tr>
<?php
// แก้ไข SQL ตรงนี้: ใช้ INNER JOIN เพื่อไปดึงชื่อภาค (r_name) มาโชว์
$sql = "SELECT provinces.*, regions.r_name 
        FROM provinces 
        INNER JOIN regions ON provinces.r_id = regions.r_id 
        ORDER BY provinces.p_id ASC";

$rs = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_array($rs)){
?>
  <tr>
    <td><?php echo $data['p_id']; ?></td>
    <td><?php echo $data['p_name']; ?></td>
    <td><?php echo $data['r_name']; ?></td>
    <td>
        <?php if($data['p_img']){ ?>
            <img src="images/<?php echo $data['p_img']; ?>" width="100">
        <?php } ?>
    </td>
    <td>
        <a href="delete_province.php?id=<?php echo $data['p_id']; ?>" 
           onclick="return confirm('ยืนยันการลบ?')" class="btn-del">🗑️</a>
    </td>
  </tr>
<?php } ?>
</table>
</body>
</html>