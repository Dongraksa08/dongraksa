<?php
include_once("connectdb.php");

// ส่วนการบันทึกข้อมูล
if (isset($_POST['Submit'])) {
    $pname = $_POST['pname'];
    $rid = $_POST['rid'];
    $ext = pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION); // ดึงนามสกุลไฟล์
    
    // บันทึกข้อมูลโดยใช้ชื่อคอลัมน์จาก provinces.sql
    $sql = "INSERT INTO provinces (p_name, p_ext, r_id) VALUES ('$pname', '$ext', '$rid')";
    
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        
        // บันทึกไฟล์ลงโฟลเดอร์ img/ โดยใช้ ID.นามสกุล
        $filename = $last_id . "." . $ext;
        move_uploaded_file($_FILES['pimage']['tmp_name'], "img/" . $filename);
    }
    header("Location: b.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>งาน i -- ดวงรักษา อรเพ็ชร (แป้ง)</title>
</head>
<body>
    <h1>จัดการข้อมูลจังหวัด -- ดวงรักษา อรเพ็ชร (แป้ง)</h1>
    
    <form method="post" enctype="multipart/form-data">
        ชื่อจังหวัด: <input type="text" name="pname" autofocus required>
        รูปภาพ: <input type="file" name="pimage" required>
        ภาค: 
        <select name="rid">
            <option value="">-- เลือกภาค --</option>
            <option value="17">ภาคตะวันออก</option>
            <option value="27">ภาคตะวันออกเฉียงเหนือ</option>
            <option value="28">ภาคกลาง</option>
            <option value="30">ภาคใต้</option>
            <option value="32">ภาคตะวันตก</option>
            <option value="35">ภาคเหนือ</option>
        </select>
        <button type="submit" name="Submit">บันทึก</button>
    </form>

    <br><br>

    <table border="1">
        <thead>
            <tr>
                <th>Province ID</th>
                <th>Province Name</th>
                <th>Province Picture</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // ดึงข้อมูลจากตาราง provinces ตามไฟล์ SQL
            $result = mysqli_query($conn, "SELECT * FROM provinces");
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['p_id'] . "</td>"; // ใช้ p_id
                echo "<td>" . $row['p_name'] . "</td>"; // ใช้ p_name
                
                // แสดงรูปตาม ID และนามสกุลที่เก็บใน DB (เช่น 24.jpg หรือ 29.png)
                $full_img_name = $row['p_id'] . "." . $row['p_ext'];
                echo "<td><img src='img/" . $full_img_name . "' width='150'></td>";
                
                echo "<td align='center'>
                        <a href='delete_provinces.php?id=" . $row['p_id'] . "' onclick=\"return confirm('คุณต้องการลบข้อมูลนี้หรือไม่')\">
                            <img src='img/delete.jpg' width='25'>
                        </a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>