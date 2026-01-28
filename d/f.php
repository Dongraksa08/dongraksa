<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ผลลัพธ์ใบสมัครงาน - บริษัท นวัตกรรมโลกใหม่ จำกัด</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .display-section {
        margin-top: 40px;
        padding: 30px;
        background-color: #e9f7fe; /* Light blue background for display area */
        border-left: 5px solid #0d6efd; /* Blue border */
    }
    .data-card {
        border-radius: 10px;
    }
    .data-card .card-header {
        font-weight: bold;
        background-color: #0d6efd;
        color: white;
    }
</style>
</head>

<body>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            <header class="text-center mb-4">
                <h1 class="display-6 text-primary"><i class="bi bi-file-earmark-check-fill"></i> สรุปข้อมูลใบสมัครงาน</h1>
                <p class="lead text-success">บริษัท นวัตกรรมโลกใหม่ จำกัด</p>
                <hr>
            </header>

            <?php
            // ตรวจสอบว่ามีการส่งข้อมูลมาหรือไม่
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                // 1. ดึงข้อมูลจาก $_POST โดยใช้ Null Coalescing Operator (??) เพื่อป้องกันข้อผิดพลาดหากข้อมูลบางฟิลด์ขาดหาย
                $position = $_POST['position'] ?? ' - ไม่มีข้อมูล - ';
                $title = $_POST['title'] ?? '';
                $fullname = $_POST['fullname'] ?? ' - ไม่มีข้อมูล - ';
                $dob = $_POST['dob'] ?? ' - ไม่มีข้อมูล - ';
                $education = $_POST['education'] ?? ' - ไม่มีข้อมูล - ';
                $skills = $_POST['skills'] ?? ' - ไม่มีข้อมูล - ';
                $experience = $_POST['experience'] ?? ' - ไม่มีข้อมูล - ';

                // 2. เริ่มต้นการแสดงผลด้วย Bootstrap Card
                echo '<div class="card shadow-lg display-section">';
                echo '<h3 class="text-dark mb-4"><i class="bi bi-info-circle-fill"></i> รายละเอียดที่ผู้สมัครกรอก</h3>';
                
                // 3. แสดงข้อมูลหลักในรูปแบบรายการ (List Group)
                echo '<ul class="list-group list-group-flush mb-4">';

                // ข้อมูลตำแหน่งงาน
                echo '<li class="list-group-item">';
                echo '<strong><i class="bi bi-briefcase-fill me-2"></i> ตำแหน่งที่สมัคร:</strong> <span class="text-primary fw-bold">'.$position.'</span>';
                echo '</li>';

                // ข้อมูลส่วนตัว
                echo '<li class="list-group-item">';
                echo '<strong><i class="bi bi-person-fill me-2"></i> ชื่อ-นามสกุล:</strong> '.$title.' '.$fullname;
                echo '</li>';

                echo '<li class="list-group-item">';
                echo '<strong><i class="bi bi-calendar-fill me-2"></i> วันเดือนปีเกิด:</strong> '.$dob;
                echo '</li>';
                
                // ข้อมูลการศึกษา
                echo '<li class="list-group-item">';
                echo '<strong><i class="bi bi-award-fill me-2"></i> ระดับการศึกษาสูงสุด:</strong> '.$education;
                echo '</li>';
                
                echo '</ul>'; // ปิด List Group 1

                // 4. แสดงข้อมูล Textarea ในรูปแบบ Card ย่อย

                // ความสามารถพิเศษ
                echo '<div class="card mb-3 data-card">';
                echo '<div class="card-header bg-warning text-dark"><i class="bi bi-stars"></i> ความสามารถพิเศษ</div>';
                echo '<div class="card-body bg-white">';
                // ใช้ nl2br() เพื่อให้แสดงผลขึ้นบรรทัดใหม่ตามที่ผู้ใช้กรอก
                echo '<p class="card-text text-break">'.nl2br(htmlspecialchars($skills)).'</p>';
                echo '</div>';
                echo '</div>';

                // ประสบการณ์ทำงาน
                echo '<div class="card data-card">';
                echo '<div class="card-header bg-success text-white"><i class="bi bi-journal-text"></i> ประสบการณ์ทำงาน</div>';
                echo '<div class="card-body bg-white">';
                echo '<p class="card-text text-break">'.nl2br(htmlspecialchars($experience)).'</p>';
                echo '</div>';
                echo '</div>';


                echo '</div>'; // ปิด display-section card

            } else {
                // หากไม่มีการส่งข้อมูลด้วยเมธอด POST (เช่น เข้าหน้า f.php โดยตรง)
                echo '<div class="alert alert-danger text-center" role="alert">';
                echo '<h4 class="alert-heading"><i class="bi bi-x-octagon-fill"></i> ข้อผิดพลาด!</h4>';
                echo '<p>ไม่พบข้อมูลใบสมัคร กรุณากลับไปที่หน้าฟอร์มเพื่อกรอกข้อมูลและกดปุ่ม "ส่งใบสมัคร"</p>';
                echo '<a href="index.html" class="btn btn-danger mt-2">กลับสู่หน้าฟอร์ม</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHzI" crossorigin="anonymous"></script>
</body>
</html>