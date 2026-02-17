<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ดวงรักษา อรเพ็ชร</title>
</head>

<body>
<h1>งาน i -- 66010914007 ดวงรักษา อรเพ็ชร (แป้ง)</h1>

<?php
include_once("connectdb.php"); // แก้จาก linclude_once เป็น include_once
$sql = "SELECT * FROM regions"; // แก้จาก 'regions' (single quote) เป็นชื่อตารางปกติ
$rs = mysqli_query($conn, $sql); // แก้จาก mysali_query$conn เป็น mysqli_query($conn, ...)
?>
<table border="1">
 <tr> <th>รหัสภาค</th>
   <th>ชื่อภาค</th> <th>ลบ</th>
 </tr>
<?php
while ($data = mysqli_fetch_array($rs)){ // แก้จาก mysqli_ fetch_array เป็น mysqli_fetch_array
?>
 <tr>
  <td><?php echo $data['r_id']; ?></td> <td><?php echo $data['r_name']; ?></td> <td width="80" align="center"><img src="images/delete.jpg" width="20"></td>
 </tr>
<?php } ?>
</table>
</body>
</html>
<?php
mysqli_close($conn);
?>