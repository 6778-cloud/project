<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("ไม่มีสินค้าในตะกร้า");
}

$user = $_SESSION['user'] ?? 'guest';
$total = 0;

// คำนวณ total
foreach ($_SESSION['cart'] as $id => $qty) {
    $sql = "SELECT price FROM products WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $total += $row['price'] * $qty;
}

// 1. insert order
$sql = "INSERT INTO orders (user_name, total_price) VALUES ('$user', $total)";
$conn->query($sql);

// เอา id ของ order ล่าสุด
$order_id = $conn->insert_id;

// 2. insert order_items
foreach ($_SESSION['cart'] as $id => $qty) {
    $sql = "SELECT price FROM products WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $price = $row['price'];

    $sql = "INSERT INTO order_items (order_id, product_id, quantity, price)
            VALUES ($order_id, $id, $qty, $price)";
    $conn->query($sql);
}

// 3. ล้าง cart
unset($_SESSION['cart']);

echo "<h2>สั่งซื้อสำเร็จ 🎉</h2>";
echo "<a href='index.php'>กลับหน้าแรก</a>";

$conn->close();
?>