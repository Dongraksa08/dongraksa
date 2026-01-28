<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ใบสมัครงาน - บริษัท นวัตกรรมโลกใหม่ จำกัด</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
    /* Custom CSS for light background card */
    .app-form-card {
        background-color: #f8f9fa; /* Light background for the form area */
        border-top: 5px solid #0d6efd; /* Blue border on top */
    }
    .form-section-title {
        color: #0d6efd;
        border-bottom: 2px solid #0d6efd;
        padding-bottom: 5px;
        margin-bottom: 20px;
        font-weight: bold;
    }
</style>
</head>

<body>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            <header class="text-center mb-4">
                <h1 class="display-6 text-dark"><i class="bi bi-person-workspace"></i> ใบสมัครงาน</h1>
                <p class="lead text-secondary">บริษัท นวัตกรรมโลกใหม่ จำกัด (Global Innovation Tech Co., Ltd.)</p>
                <hr>
            </header>

            <div class="card shadow-lg p-4 app-form-card">
                <form method="post" action="f.php">
                    
                    <h4 class="form-section-title"><i class="bi bi-briefcase-fill"></i> ตำแหน่งงาน</h4>
                    <div class="mb-4">
                        <label for="position" class="form-label">ตำแหน่งที่ต้องการสมัคร <span class="text-danger">*</span></label>
                        <select class="form-select" id="position" name="position" required>
                            <option value="" selected disabled>-- กรุณาเลือกตำแหน่งงาน --</option>
                            <option value="Software Developer">นักพัฒนาซอฟต์แวร์</option>
                            <option value="Data Analyst">นักวิเคราะห์ข้อมูล</option>
                            <option value="Network Administrator">ผู้ดูแลระบบเครือข่าย</option>
                            <option value="Sales and Marketing Executive">พนักงานฝ่ายขายและการตลาด</option>
                            <option value="Administrative Officer">เจ้าหน้าที่ธุรการ</option>
                        </select>
                    </div>

                    <h4 class="form-section-title"><i class="bi bi-person-fill"></i> ข้อมูลส่วนตัว</h4>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="title" class="form-label">คำนำหน้าชื่อ <span class="text-danger">*</span></label>
                            <select class="form-select" id="title" name="title" required>
                                <option value="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option>
                                <option value="อื่นๆ">อื่นๆ</option>
                            </select>
                        </div>
                        
                        <div class="col-md-8">
                            <label for="fullname" class="form-label">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="dob" class="form-label">วันเดือนปีเกิด <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>

                    <h4 class="form-section-title"><i class="bi bi-book-fill"></i> การศึกษาและความสามารถ</h4>
                    
                    <div class="mb-3">
                        <label for="education" class="form-label">ระดับการศึกษาสูงสุด <span class="text-danger">*</span></label>
                        <select class="form-select" id="education" name="education" required>
                            <option value="" selected disabled>-- เลือกระดับการศึกษา --</option>
                            <option value="มัธยมศึกษา">มัธยมศึกษา / ปวช.</option>
                            <option value="ปวส./อนุปริญญา">ปวส. / อนุปริญญา</option>
                            <option value="ปริญญาตรี">ปริญญาตรี</option>
                            <option value="ปริญญาโท">ปริญญาโท</option>
                            <option value="ปริญญาเอก">ปริญญาเอก</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="skills" class="form-label">ความสามารถพิเศษ (เช่น ภาษา, โปรแกรม, ทักษะเฉพาะ)</label>
                        <textarea class="form-control" id="skills" name="skills" rows="3" placeholder="ระบุความสามารถพิเศษที่เกี่ยวข้องกับตำแหน่งงาน..."></textarea>
                    </div>

                    <h4 class="form-section-title"><i class="bi bi-building-fill"></i> ประสบการณ์ทำงาน</h4>
                    <div class="mb-4">
                        <label for="experience" class="form-label">ประสบการณ์ทำงานโดยสรุป</label>
                        <textarea class="form-control" id="experience" name="experience" rows="5" placeholder="ระบุชื่อบริษัท, ตำแหน่ง, ระยะเวลาการทำงาน, และหน้าที่ความรับผิดชอบโดยสังเขป..."></textarea>
                    </div>

                    <div class="d-grid gap-2 border-top pt-3">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-send-fill"></i> ส่งใบสมัคร</button>
                        <button type="reset" class="btn btn-outline-secondary">ล้างข้อมูลในฟอร์ม</button>
                    </div>

                </form>
            </div>
            
            <footer class="text-center mt-3 text-muted">
                <p><small>* กรุณากรอกข้อมูลในช่องที่มีเครื่องหมายดอกจันให้ครบถ้วน</small></p>
            </footer>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHzI" crossorigin="anonymous"></script>
</body>
</html>