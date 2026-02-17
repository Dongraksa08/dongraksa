<?php
include_once("connectdb.php");

// ส่วนบันทึกข้อมูล (เพิ่มเข้าไปเพื่อให้ปุ่มบันทึกใช้งานได้)
if (isset($_POST['submit'])) {
    $r_name = $_POST['r_name'];
    $sql_insert = "INSERT INTO regions (r_name) VALUES ('$r_name')";
    mysqli_query($conn, $sql_insert);
    header("location: a.php"); // บันทึกเสร็จแล้ว refresh หน้าตัวเอง
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
    
    /* สไตล์สำหรับช่องกรอกให้กะพริบ */
    .blink-input {
        padding: 5px;
        border: 2px solid #007bff;
        outline: none;
        border-radius: 4px;
        /* สร้างแอนิเมชันชื่อ blink-border กะพริบทุก 1 วินาที */
        animation: blink-border 1s infinite; 
    }

    @keyframes blink-border {
        0% { border-color: #007bff; box-shadow: 0 0 5px #007bff; }
        50% { border-color: transparent; box-shadow: none; }
        100% { border-color: #007bff; box-shadow: 0 0 5px #007bff; }
    }

    table { border-collapse: collapse; margin-top: 20px; }
    th { background-color: #f2f2f2; }
    th, td { padding: 8px; text-align: left; border: 1px solid #ccc; }
    .btn-del { border: 1px solid #ccc; padding: 2px 5px; cursor: pointer; background: #fff; }
    .btn-del:hover { background: #eee; }
</style>
</head>

<body>
<h1>งาน i -- 66010914007 ดวงรักษา อรเพ็ชร (แป้ง)</h1>

<form method="post" action="">
    ชื่อภาค <input type="text" name="r_name" class="blink-input" required autofocus> 
    <input type="submit" name="submit" value="บันทึก">
</form>

<table border="1">
  <tr>
    <th>รหัสภาค</th>
    <th>ชื่อภาค</th>
    <th>ลบ</th>
  </tr>
<?php
$sql = "SELECT * FROM regions";
$rs = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_array($rs)){
?>
  <tr>
    <td><?php echo $data['r_id']; ?></td>
    <td><?php echo $data['r_name']; ?></td>
    <td align="center">
        <button type="button" class="btn-del">
            <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" width="15">
        </button>
    </td>
  </tr>
<?php } ?>
</table>
</body>
</html>
<?php
mysqli_close($conn);
?>