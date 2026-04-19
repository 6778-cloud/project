<?php
session_start();

$id = $_GET['id'];

// ถ้ายังไม่มี cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// ถ้ามีสินค้าแล้ว → +1
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]++;
} else {
    $_SESSION['cart'][$id] = 1;
}

// กลับไปหน้าเดิม
header("Location: index.php");
exit();
?>