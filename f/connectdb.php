<?PHP
    $host = "localhost";
    $user = "root";
    $pwd = "r660109";
    $db = "4007db";
    $conn = mysqli_connect($host,$user,$pwd,$db) or die ("เชื่อมต่อฐานข้อมูลไม่ได้");
    mysqli_query($conn,"SET NAMES utf8");
?>