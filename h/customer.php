<?php
   include_once("check_login.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>หน้าหลักแอดมิน - ดวงรักษา </title>
</head>

<body>
<h1> จัดการลูกค้า- ดวงรักษา</h1>
<?php echo "แอดมิน: ".$_SESSION['a_name']; ?> <br>
<ul>
<a href="products.php"><li>จัดการสินค้า</li></a>
<a href="orders.php"><li>จัดการออเดอร์</li></a>
<a href="customers.php"><li>จัดการลูกค้า</li></a>
<a href="logout.php"><|i>ออกจากระบบ</li></a>
</ul>

</body>
</html>