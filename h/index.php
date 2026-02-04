<?php
    session_start(); 
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>หน้าเข้าสู่ระบบ - ดวงรักษา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fce4ec; /* พื้นหลังสีชมพูอ่อน */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: none;
        }
        .btn-pink {
            background-color: #f06292;
            color: white;
            border: none;
        }
        .btn-pink:hover {
            background-color: #ec407a;
            color: white;
        }
        .text-pink {
            color: #d81b60;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card login-card p-4">
                <div class="card-body">
                    <h3 class="text-center mb-4 text-pink">เข้าสู่ระบบ</h3>
                    <h6 class="text-center mb-4 text-muted">ดวงรักษา อรเพ็ชร</h6>
                    
                    <form method="post" action="">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="auser" class="form-control" placeholder="ระบุชื่อผู้ใช้งาน" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="pang" class="form-control" placeholder="ระบุรหัสผ่าน" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="Submit" class="btn btn-pink btn-lg">LOGIN</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['Submit'])){
    include_once("connectdb.php");
    
    // 1. ตรวจสอบว่า $_POST['auser'] และ $_POST['pang'] ตรงกับ name="" ใน input หรือไม่
    $user = mysqli_real_escape_string($conn, $_POST['auser']);
    $pass = mysqli_real_escape_string($conn, $_POST['pang']);

    // 2. ลอง echo ค่าออกมาดู (ใช้เพื่อ debug เท่านั้น พอแก้ได้แล้วให้ลบออก)
    // die("User: $user | Pass: $pass"); 

    $sql = "SELECT * FROM admin WHERE a_username='{$user}' AND a_password='{$pass}' LIMIT 1";
    
    $rs = mysqli_query($conn, $sql);
    
    if ($rs && mysqli_num_rows($rs) == 1) {
        $data = mysqli_fetch_array($rs);
        $_SESSION['aid'] = $data['a_id'];
        $_SESSION['auser'] = $data['a_username']; // เก็บ username
        $_SESSION['aname'] = $data['a_name'];     // เก็บชื่อจริง
        
        echo "<script>window.location='index2.php';</script>";
    } else {
        echo "<script>alert('Username หรือ Password ไม่ถูกต้อง');</script>";
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>