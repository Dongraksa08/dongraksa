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
            <th>เดือน</th>
            <th>ยอดขายรวม</th>
        </tr>
        <?php
        include_once("connectdb.php");
        
        $sql ="SELECT 
        MONTH(p_date) AS Month, 
        SUM(p_amount) AS Total_Sales
    FROM popsupermarket
    GROUP BY MONTH(p_date)
    ORDER BY Month;";
        $rs = mysqli_query($conn, $sql);
        
        $i = 1;
        $grand_total = 0; 
        while ($data = mysqli_fetch_array($rs)) {
            // แก้ไข: บวกยอดจากชื่อคอลัมน์ Total_Sales ที่ได้จาก SQL
            $grand_total += $data['Total_Sales']; 
        ?>
        <tr>
            <td align="center"><?php echo $i++; ?></td>
            <td align="center">เดือนที่ <?php echo $data['Month']; ?></td>
            <td align="right"><?php echo number_format($data['Total_Sales'], 2); ?></td>
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