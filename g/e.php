<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard High Contrast - ดวงรักษา อรเพ็ชร</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&family=Kanit:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: #0b0e14;
            color: #ffffff; /* ปรับตัวหนังสือหลักของหน้าจอเป็นสีขาว */
            padding: 30px 0;
        }
        .header-box {
            background: linear-gradient(45deg, #00d2ff 0%, #3a7bd5 100%);
            color: #fff;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        .gray-card {
            background-color: #2c2f33; 
            border: 1px solid #444;
            border-radius: 15px;
            padding: 20px;
            height: 100%;
        }
        
        /* --- ปรับปรุงส่วนตารางให้ตัวหนังสือเป็นสีขาว --- */
        .table {
            color: #ffffff !important; /* บังคับตัวหนังสือในตารางเป็นสีขาว */
            --bs-table-bg: transparent;
        }
        .table thead th {
            background-color: #3e4248;
            color: #00f2fe; /* หัวตารางใช้สีฟ้าสดใสเพื่อให้แยกแยะง่าย */
            font-weight: 600;
            padding: 15px;
        }
        .table tbody td {
            color: #ffffff !important; /* บังคับตัวหนังสือในแถวเป็นสีขาว */
            border-color: #444;
            padding: 12px;
            font-weight: 400;
        }
        /* ------------------------------------------ */

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.05);
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0, 210, 255, 0.15);
        }
        .total-row {
            background-color: #00d2ff !important;
            color: #000 !important;
            font-weight: bold;
            font-size: 1.1rem;
        }
        .text-neon { color: #00f2fe; font-weight: bold; }
    </style>
</head>

<body>
    <div class="container">
        <div class="header-box text-center shadow">
            <h1 class="fw-bold mb-0">66010914007 ดวงรักษา อรเพ็ชร (แป้ง)</h1>
            <p class="mb-0">Dashboard สรุปยอดขายรายประเทศ</p>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-7">
                <div class="gray-card shadow">
                    <h5 class="text-neon mb-3">📊 กราฟแท่งยอดขาย</h5>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="gray-card shadow">
                    <h5 class="text-warning mb-3">🍩 สัดส่วนยอดขาย</h5>
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>

        <div class="gray-card p-0 overflow-hidden shadow">
            <div class="p-3 border-bottom border-secondary">
                <h5 class="mb-0 text-white">📑 รายละเอียดข้อมูล (High Contrast)</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr class="text-center">
                            <th>ลำดับ</th>
                            <th class="text-start">ประเทศ</th>
                            <th class="text-end">ยอดขายรวม (บาท)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once("connectdb.php");
                        $sql = "SELECT p_country, SUM(p_amount) AS total FROM popsupermarket GROUP BY p_country ORDER BY total DESC";
                        $rs = mysqli_query($conn, $sql);
                        
                        $i = 1; $grand_total = 0;
                        $countries = []; $amounts = [];

                        while ($data = mysqli_fetch_array($rs)) {
                            $grand_total += $data['total'];
                            $countries[] = $data['p_country'];
                            $amounts[] = $data['total'];
                        ?>
                        <tr class="text-center align-middle">
                            <td><?php echo $i++; ?></td>
                            <td class="text-start fw-semibold"><?php echo $data['p_country']; ?></td>
                            <td class="text-end fw-bold"><?php echo number_format($data['total'], 2); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr class="total-row text-center">
                            <td colspan="2" class="text-end">รวมยอดขายทั้งหมด:</td>
                            <td class="text-end"><?php echo number_format($grand_total, 2); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <script>
        const labels = <?php echo json_encode($countries); ?>;
        const dataValues = <?php echo json_encode($amounts); ?>;
        const brightColors = ['#00f2fe', '#f093fb', '#96e6a1', '#fbc2eb', '#fff1eb', '#00d2ff', '#a1c4fd', '#84fab0'];

        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'ยอดขาย (บาท)',
                    data: dataValues,
                    backgroundColor: '#3a7bd5',
                    borderRadius: 8
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#444' }, ticks: { color: '#ffffff' } },
                    x: { ticks: { color: '#ffffff' } }
                }
            }
        });

        new Chart(document.getElementById('pieChart'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: brightColors,
                    borderWidth: 2,
                    borderColor: '#2c2f33'
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'bottom', labels: { color: '#ffffff' } }
                }
            }
        });
    </script>
</body>
</html>