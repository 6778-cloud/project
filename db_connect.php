<?php
$servername = "localhost"; // หรืออาจจะเป็น IP address ของเซิร์ฟเวอร์ฐานข้อมูล
$username = "root"; // ชื่อผู้ใช้งาน phpMyAdmin, โดยปกติจะเป็น "root" สำหรับ XAMPP/WAMP
$password = ""; // รหัสผ่าน, โดยปกติจะไม่มีสำหรับ "root" บน localhost
$dbname = "plaishrit"; // ตั้งชื่อฐานข้อมูลที่คุณจะใช้

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>