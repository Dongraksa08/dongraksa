<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ดวงรักษา อรเพ็ชร (แป้ง)</title>
</head>

<body>
<h1>66010914007 ดวงรักษา อรเพ็ชร (แป้ง)</h1>

<form method="post" action="">
  กรอกแม่สูตรคูณ: <input type="number" min="2" max="1000" name="a" autofocus required>
  <button type="submit" name="Submit">OK</button>
</form>
<hr>

<?php
if(isset($_POST['Submit'])){
    $m = $_POST['a'];
    for($i=2; $i<=12; $i++) {
        $x =$m *$i ;
        echo "{$m} x {$i} = {$x}<br>" ;
        }
    }
?>


</body>
</html>
