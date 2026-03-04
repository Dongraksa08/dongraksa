<?php
include("connectdb.php");
$sql = "SELECT * FROM products";
$rs = mysqli_query($conn, $sql);

while($data = mysqli_fetch_array($rs)) {
    echo "<div>";
    echo "<h3>" . $data['p_name'] . "</h3>";
    // แสดงรูปภาพจากโฟลเดอร์ images/
    echo "<img src='images/" . $data['p_img'] . "' width='150'><br>";
    echo "ราคา: " . $data['p_price'] . " บาท";
    echo "</div><hr>";
}
?>