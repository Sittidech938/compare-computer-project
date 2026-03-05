<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "comparing_computer";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // สำหรับ debug
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit; // หยุดโปรแกรมถ้าเชื่อมไม่ได้
}
?>