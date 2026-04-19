<?php
session_start();
require_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ตะกร้าสินค้า</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">🛒 ตะกร้าสินค้าของคุณ</h1>

<?php
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo '<div class="alert alert-warning">ตะกร้าสินค้าว่างเปล่า</div>';
    
    echo '<a href="index.php" class="btn btn-primary">กลับไปเลือกสินค้า</a>';
    exit();
}
?>

<table class="table table-bordered table-hover text-center">
    <thead class="thead-dark">
        <tr>
            <th>สินค้า</th>
            <th>ราคา</th>
            <th>จำนวน</th>
            <th>รวม</th>
            <th>ลบ</th>
        </tr>
    </thead>
    <tbody>

<?php
$total = 0;

foreach ($_SESSION['cart'] as $id => $qty) {

    $sql = "SELECT product_name, price, image_url FROM products WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $subtotal = $row['price'] * $qty;
    $total += $subtotal;
?>

<tr>
    <td>
        <img src="<?php echo $row['image_url']; ?>" width="60"><br>
        <?php echo htmlspecialchars($row['product_name']); ?>
    </td>
    <td><?php echo $row['price']; ?> บาท</td>
    <td><?php echo $qty; ?></td>
    <td class="text-danger"><?php echo $subtotal; ?> บาท</td>
    <td>
        <a href="remove.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm">
            ลบ
        </a>
    </td>
</tr>

<?php } ?>

    </tbody>
</table>

<div class="text-right">
    <h3>รวมทั้งหมด: <span class="text-success"><?php echo $total; ?> บาท</span></h3>
</div>

<div class="d-flex justify-content-between mt-3">
    <a href="index.php" class="btn btn-secondary">← กลับไปเลือกสินค้า</a>
    <a href="checkout.php" class="btn btn-success">ชำระเงิน</a>
</div>

</div>

</body>
</html>