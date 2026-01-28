<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>ดวงรักษา อรเพ็ชร</title>
</head>

<body>
    <h1>66010914007 ดวงรักษา อรเพ็ชร (แป้ง)</h1>

    <table border="1" width="500">
        <tr>
            <th>ลำดับ</th>
            <th>ประเทศ</th>
            <th>ยอดขายรวม</th>
        </tr>
        <?php
        include_once("connectdb.php");
        
        // แก้ไข: เพิ่ม ; ปิดท้ายบรรทัด และใช้ SUM เพื่อรวมยอดเงิน
        $sql = "SELECT p_country, SUM(p_amount) AS total FROM popsupermarket GROUP BY p_country ORDER BY total DESC";
        $rs = mysqli_query($conn, $sql);
        
        $i = 1;
        $grand_total = 0; // ตัวแปรเก็บยอดรวมทั้งหมด

        while ($data = mysqli_fetch_array($rs)) {
            $grand_total += $data['total'];
        ?>
        <tr>
            <td align="center"><?php echo $i++; ?></td>
            <td><?php echo $data['p_country']; ?></td>
            <td align="right"><?php echo number_format($data['total'], 2); ?></td>
        </tr>
        <?php 
        }
        ?>
        <tr bgcolor="#dddddd">
            <td colspan="2" align="right"><strong>รวมทั้งสิ้น</strong></td>
            <td align="right"><strong><?php echo number_format($grand_total, 2); ?></strong></td>
        </tr>
    </table> 
</body>
</html>