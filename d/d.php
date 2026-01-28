<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>ดวงรักษา อรเพ็ชร (แป้ง)</title>

<!-- Bootstrap 5.3 Stable -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container my-5">

<h1 class="text-center mb-4">ฟอร์มรับข้อมูล 66010914007 ดวงรักษา อรเพ็ชร (แป้ง)</h1>

<form method="post" action="" class="border p-4 rounded shadow">

    <div class="mb-3">
        <label class="form-label">ชื่อ-นามสกุล</label>
        <input type="text" name="fullname" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">เบอร์โทร</label>
        <input type="text" name="phone" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">ส่วนสูง (ซม.)</label>
        <input type="number" name="height" min="100" max="200" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">ที่อยู่</label>
        <textarea name="address" class="form-control" rows="4"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">วันเดือนปีเกิด</label>
        <input type="date" name="birthday" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">สีที่ชอบ</label>
        <input type="color" name="color" class="form-control form-control-color">
    </div>

    <div class="mb-3">
        <label class="form-label">สาขาวิชา</label>
        <select name="major" class="form-select">
            <option value="การบัญชี">การบัญชี</option>
            <option value="การตลาด">การตลาด</option>
            <option value="การจัดการ">การจัดการ</option>
            <option value="คอมพิวเตอร์ธุรกิจ">คอมพิวเตอร์ธุรกิจ</option>
        </select>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <button type="submit" name="Submit" class="btn btn-primary">สมัครสมาชิก</button>
        <button type="reset" class="btn btn-secondary">ยกเลิก</button>

        <button type="button" class="btn btn-info text-white"
            onClick="window.location='https://www.msu.ac.th/th';">
            GO TO MSU
        </button>

        <button type="button" class="btn btn-warning"
            onMouseOver="alert('หวัดดีค่า^-^ มีอะไรให้ช่วยไหมคะ')">
            Hello
        </button>

        <button type="button" class="btn btn-success" onClick="window.print()">
            พิมพ์
        </button>
    </div>

</form>

<hr class="my-4">

<?php
if (isset($_POST['Submit']))  {

    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $height = $_POST['height'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $color = $_POST['color'];
    $major = $_POST['major'];

    echo "<div class='alert alert-info'>";
    echo "<h4>ข้อมูลที่กรอก:</h4>";
    echo "ชื่อ-สกุล: ".$fullname."<br>";
    echo "เบอร์โทร: ".$phone."<br>";
    echo "ส่วนสูง: ".$height." ซม.<br>";
    echo "ที่อยู่: ".$address."<br>";
    echo "วันเดือนปีเกิด: ".$birthday."<br>";
    echo "สีที่ชอบ: <div style='background-color:$color;width:120px;height:30px;' class='mt-1'></div><br>";
    echo "สาขาวิชา: ".$major."<br>";
    echo "</div>";
}
?>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
