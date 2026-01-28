<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>ดวงรักษา อรเพ็ชร</title>
</head>

<body>
    <h1>66010914007 ดวงรักษา อรเพ็ชร (แป้ง)</h1>

    <form method="post" action="">
        คำค้น <input type="text" name="a" autofocus value="<?php echo @$_POST['a']; ?>">
        <button type="submit" name="submit">ok</button> 
    </form>
    <br>

    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>ชื่อสินค้า</th>
            <th>ประเภทสินค้า</th>
            <th>วันที่</th>
            <th>ประเทศ</th>
            <th>จำนวนเงิน</th>
            <th>รูปภาพ</th>
        </tr>
        <?php
        include_once("connectdb.php");
        @$kw = $_POST['a'];

        // ปรับ SQL ให้ค้นหาได้ทั้งชื่อสินค้า (p_product_name) และประเภทสินค้า (p_category)
        $sql = "SELECT * FROM `popsupermarket` 
                WHERE p_product_name LIKE '%{$kw}%' 
                OR p_category LIKE '%{$kw}%'";
        
        $rs = mysqli_query($conn, $sql);
        $total = 0; 

        while ($data = mysqli_fetch_array($rs)) {
            $total += $data['p_amount']; 
        ?>
        <tr>
            <td><?php echo $data['p_order_id']; ?></td>
            <td><?php echo $data['p_product_name']; ?></td>
            <td><?php echo $data['p_category']; ?></td>
            <td><?php echo $data['p_date']; ?></td>
            <td><?php echo $data['p_country']; ?></td>
            <td align="right"><?php echo number_format($data['p_amount'], 0); ?></td>
            <td>
                <img src="<?php echo $data['p_product_name']; ?>.jpg" width="55">
            </td>
        </tr>
        <?php 
        }
        ?>

        <tr bgcolor="#f2f2f2">
            <td colspan="5" align="right"><strong>ยอดรวมทั้งสิ้น</strong></td>
            <td align="right"><strong><?php echo number_format($total, 0); ?></strong></td>
            <td>&nbsp;</td>
        </tr>
    </table> 
</body>
</html>