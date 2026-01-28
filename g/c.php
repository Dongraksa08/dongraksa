<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>66010914007 ดวงรักษา อรเพ็ชร</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: #f0f5f9; /* พื้นหลังฟ้าอ่อน */
            color: #33475b;
        }
        .main-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); /* ไล่เฉดสีน้ำเงิน */
            padding: 20px;
            border: none;
        }
        .table thead {
            background-color: #e3f2fd;
            color: #0d47a1;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f8ff;
            transition: 0.3s;
        }
        .img-product {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e3f2fd;
        }
        .badge-category {
            background-color: #d1e9ff;
            color: #0d47a1;
            font-weight: 500;
            border: 1px solid #b3d7ff;
        }
        .total-row {
            background-color: #1e3c72 !important;
            color: white !important;
        }
        /* ปรับแต่ง Search Box ของ DataTable */
        .dataTables_filter input {
            border: 2px solid #e3f2fd;
            border-radius: 20px;
            padding: 5px 15px;
        }
    </style>
</head>

<body class="py-5">
    <div class="container">
        <div class="card main-card">
            <div class="card-header text-center">
                <h3 class="text-white mb-0 fw-bold">🛒 ระบบจัดการข้อมูลสินค้า Supermarket</h3>
                <p class="text-white-50 mb-0 mt-2">66010914007 ดวงรักษา อรเพ็ชร (แป้ง)</p>
            </div>
            <div class="card-body p-4">
                <table id="myTable" class="table table-hover align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ชื่อสินค้า</th>
                            <th>หมวดหมู่</th>
                            <th>วันที่</th>
                            <th>ประเทศ</th>
                            <th class="text-end">จำนวนเงิน</th>
                            <th class="text-center">รูปภาพ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    include_once("connectdb.php");
                    $sql = "SELECT * FROM `popsupermarket`";
                    $rs = mysqli_query($conn, $sql);
                    $total = 0;

                    while ($data = mysqli_fetch_array($rs)) {
                        $total += $data['p_amount'];
                    ?>
                        <tr>
                            <td><strong><?php echo $data['p_order_id']; ?></strong></td>
                            <td class="fw-semibold"><?php echo $data['p_product_name']; ?></td>
                            <td><span class="badge badge-category px-3 py-2"><?php echo $data['p_category']; ?></span></td>
                            <td class="text-muted small"><?php echo $data['p_date']; ?></td>
                            <td><i class="bi bi-geo-alt"></i> <?php echo $data['p_country']; ?></td>
                            <td class="text-end fw-bold text-primary"><?php echo number_format($data['p_amount'], 2); ?></td>
                            <td class="text-center">
                                <img src="<?php echo $data['p_product_name']; ?>.jpg" 
                                     class="img-product shadow-sm"
                                     onerror="this.src='https://via.placeholder.com/50/e3f2fd/0d47a1?text=No+Img'">
                            </td>
                        </tr>
                    <?php 
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr class="total-row">
                            <td colspan="5" class="text-end fw-bold">ยอดรวมสุทธิ:</td>
                            <td class="text-end fw-bold"><?php echo number_format($total, 2); ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <footer class="text-center mt-4 text-muted">
            <small>&copy; 2026 ระบบจัดการข้อมูลร้านค้า - รายวิชาการพัฒนาเว็บ</small>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></