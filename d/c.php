<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ดวงรักษา อรเพ็ชร (แป้ง)</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    /* Custom CSS เพื่อจัดรูปแบบสีที่ชอบ */
    .color-display-box {
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
        display: inline-block;
        min-width: 150px;
        text-align: center;
        margin-top: 5px;
    }
    .form-label {
        font-weight: bold;
    }
</style>
</head>

<body>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <h1 class="text-center text-primary mb-4">
                <i class="bi bi-person-lines-fill"></i> ฟอร์มรับข้อมูล 66010914007 ดวงรักษา อรเพ็ชร (แป้ง) - Gemini
            </h1>
            <div class="card shadow-lg p-4">
                <form method="post" action="">

                    <div class="mb-3">
                        <label for="fullname" class="form-label">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="fullname" name="fullname" autofocus required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">เบอร์โทร <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <label for="height" class="form-label">ส่วนสูง (ซม.) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="height" name="height" min="100" max="200" required>
                            <span class="input-group-text">ซม.</span>
                        </div>
                        <div class="form-text">ระบุส่วนสูงระหว่าง 100 ถึง 200 ซม.</div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">ที่อยู่</label>
                        <textarea class="form-control" id="address" name="address" rows="4"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="birthday" class="form-label">วันเดือนปีเกิด</label>
                            <input type="date" class="form-control" id="birthday" name="birthday">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="color" class="form-label">สีที่ชอบ</label>
                            <input type="color" class="form-control form-control-color" id="color" name="color" value="#000000">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="major" class="form-label">สาขาวิชา</label>
                        <select class="form-select" id="major" name="major">
                            <option value="การบัญชี">การบัญชี</option>
                            <option value="การตลาด">การตลาด</option>
                            <option value="การจัดการ">การจัดการ</option>
                            <option value="คอมพิวเตอร์ธุรกิจ">คอมพิวเตอร์ธุรกิจ</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2 d-md-block text-center border-top pt-3">
                        <button type="submit" name="Submit" class="btn btn-success me-2"><i class="bi bi-check-circle-fill"></i> สมัครสมาชิก</button>
                        <button type="reset" class="btn btn-warning me-2"><i class="bi bi-arrow-counterclockwise"></i> ยกเลิก</button>
                        <button type="button" class="btn btn-info me-2 text-white" onClick="window.location='https://www.msu.ac.th/th/%e0%b8%ab%e0%b8%99%e0%b9%89%e0%b8%b2%e0%b9%81%e0%b8%a3%e0%b8%81-n/';">GO TO MSU</button>
                        <button type="button" class="btn btn-secondary me-2" onMouseOver="alert('หวัดดีค่า^-^มีอะไรให้ช่วยไหมคะ') ;">Hello</button>
                        <button type="button" class="btn btn-primary" onClick="window.print() ;"><i class="bi bi-printer-fill"></i> พิมพ์</button>
                    </div>
                </form>
            </div>

            <hr class="my-5">

            <?php
            if (isset($_POST['Submit']))  {
                $fullname = $_POST['fullname'];
                $phone = $_POST['phone'] ;
                $height = $_POST['height'];
                $address = $_POST['address'];
                $birthday = $_POST['birthday'];
                $color = $_POST['color'];
                $major = $_POST['major'];

                echo '<div class="card p-4 bg-light shadow-sm">';
                echo '<h2 class="text-success mb-3"><i class="bi bi-check-circle"></i> ข้อมูลที่กรอก:</h2>';
                echo '<ul class="list-group list-group-flush">';

                echo '<li class="list-group-item"><strong>ชื่อ-สกุล:</strong> '.$fullname.'</li>';
                echo '<li class="list-group-item"><strong>เบอร์โทร:</strong> '. $phone.'</li>';
                echo '<li class="list-group-item"><strong>ส่วนสูง:</strong> '.$height.' ซม.</li>';
                echo '<li class="list-group-item"><strong>ที่อยู่:</strong> '.$address.'</li>';
                echo '<li class="list-group-item"><strong>วันเดือนปีเกิด:</strong> '.$birthday.'</li>';
                
                // แสดงผลสีที่ชอบด้วย Bootstrap style
                echo '<li class="list-group-item">';
                echo '<strong>สีที่ชอบ:</strong> ';
                echo '<div class="color-display-box" style="background-color:'.$color.';">'.$color.'</div>';
                echo '</li>';
                
                echo '<li class="list-group-item"><strong>สาขาวิชา:</strong> '.$major.'</li>';

                echo '</ul>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHzI" crossorigin="anonymous"></script>
</body>
</html>