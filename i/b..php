<?php
include_once("connectdb.php");

// ส่วนการบันทึกข้อมูล
if (isset($_POST['Submit'])) {
    $pname = $_POST['pname'];
    $rid = $_POST['rid'];
    
    // บันทึกข้อมูลลงฐานข้อมูลก่อนเพื่อเอา ID มาตั้งชื่อไฟล์
    $sql = "INSERT INTO province (pname, rid) VALUES ('$pname', '$rid')";
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        
        // จัดการไฟล์รูปภาพตามโครงสร้าง img/ID.ext
        $ext = pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION);
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
            $result = mysqli_query($conn, "SELECT * FROM province");
            while ($row = mysqli_fetch_array($result)) {
                // สมมติว่าไฟล์ถูกเก็บเป็น ID และนามสกุลไฟล์ในเครื่อง
                // อ้างอิงจากภาพที่ใช้ชื่อไฟล์เป็น 24.jpg, 29.png
                echo "<tr>";
                echo "<td>" . $row['pid'] . "</td>";
                echo "<td>" . $row['pname'] . "</td>";
                echo "<td><img src='img/" . $row['pid'] . ".jpg' width='150'></td>"; 
                echo "<td align='center'>
                        <a href='delete_province.php?id=" . $row['pid'] . "' onclick=\"return confirm('คุณต้องการลบข้อมูลนี้หรือไม่')\">
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