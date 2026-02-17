<?php
include_once("connectdb.php");

// 1. ส่วนบันทึกข้อมูล
if (isset($_POST['submit'])) {
    $r_name = $_POST['r_name'];
    $sql_insert = "INSERT INTO regions (r_name) VALUES ('$r_name')";
    mysqli_query($conn, $sql_insert);
    header("location: a.php"); 
    exit();
}

// 2. ส่วนลบข้อมูล (เพิ่มส่วนนี้เข้าไป)
if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    $sql_delete = "DELETE FROM regions WHERE r_id = '$id'";
    mysqli_query($conn, $sql_delete);
    header("location: a.php"); // ลบเสร็จแล้ว refresh หน้า
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
    .input-field { padding: 5px; border: 1px solid #ccc; outline: none; border-radius: 2px; }
    table { border-collapse: collapse; margin-top: 20px; width: 400px; }
    th { background-color: #f2f2f2; }
    th, td { padding: 10px; text-align: left; border: 1px solid #ccc; }
    .btn-del { border: 1px solid #ccc; padding: 2px 5px; cursor: pointer; background: #fff; display: flex; align-items: center; }
    .btn-del:hover { background: #fee; border-color: #f00; }
</style>
</head>

<body>
<h1>งาน i -- 66010914007 ดวงรักษา อรเพ็ชร (แป้ง)</h1>

<form method="post" action="">
    ชื่อภาค <input type="text" name="r_name" class="input-field" required autofocus> 
    <input type="submit" name="submit" value="บันทึก">
</form>

<table border="1">
  <tr>
    <th>รหัสภาค</th>
    <th>ชื่อภาค</th>
    <th style="text-align:center;">ลบ</th>
  </tr>
<?php
$sql = "SELECT * FROM regions ORDER BY r_id ASC"; 
$rs = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_array($rs)){
?>
  <tr>
    <td><?php echo $data['r_id']; ?></td>
    <td><?php echo $data['r_name']; ?></td>
    <td align="center">
        <a href="a.php?del_id=<?php echo $data['r_id']; ?>" 
           onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบข้อมูลภาค: <?php echo $data['r_name']; ?>?')">
            <button type="button" class="btn-del">
                <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" width="15">
            </button>
        </a>
    </td>
  </tr>
<?php } ?>
</table>
</body>
</html>
<?php
mysqli_close($conn);
?>