<?php
include_once("connectdb.php");

// ส่วนการบันทึกข้อมูล
if (isset($_POST['Submit'])) {
    $pname = $_POST['pname'];
    $rid = $_POST['rid'];
    $ext = pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION); // ดึงนามสกุลไฟล์
    
    // บันทึกข้อมูลลงตาราง provinces
    $sql = "INSERT INTO provinces (p_name, p_ext, r_id) VALUES ('$pname', '$ext', '$rid')";
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        // เก็บไฟล์ในรูปแบบ ID.นามสกุล (เช่น 1.jpg)
        $filename = $last_id . "." . $ext;
        move_uploaded_file($_FILES['pimage']['tmp_name'], "img/" . $filename);
    }
    // สั่งให้กลับมาหน้าเดิมหลังบันทึกเสร็จ
    header("Location: b.php");
    exit;
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
            <option value="1">ภาคเหนือ</option>
            <option value="2">ภาคตะวันออกเฉียงเหนือ</option>
            <option value="3">ภาคกลาง</option>
            <option value="4">ภาคใต้</option>
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
            // ดึงข้อมูลจากตาราง provinces
            $result = mysqli_query($conn, "SELECT * FROM provinces");
            while ($row = mysqli_fetch_array($result)) {
                $img_file = "img/" . $row['p_id'] . "." . $row['p_ext'];
                echo "<tr>";
                echo "<td>" . $row['p_id'] . "</td>";
                echo "<td>" . $row['p_name'] . "</td>";
                echo "<td><img src='$img_file' width='150'></td>";
                // แสดงรูปถังขยะในทุกแถว
                echo "<td align='center'>
                        <a href='delete_province.php?id=" . $row['p_id'] . "' onclick=\"return confirm('คุณต้องการลบข้อมูลนี้หรือไม่')\">
                            <img src='img/delete.jpg' width='25' height='25' alt='ลบ'>
                        </a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>