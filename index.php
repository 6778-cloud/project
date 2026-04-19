<?php
session_start();

$cart_count = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $qty) {
        $cart_count += $qty;
    }
}

?>


<?php
// includes/db_connect.php
require_once 'db_connect.php'; 

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลสินค้าทั้งหมดจากตาราง products
$sql = "SELECT id,product_name, price, image_url FROM products";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>เสื้อผ้ามือสองสุดเท่</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
        <header> 
            <nav class="navbar navbar-expand-lg custom-navbar">
  <div class="container">
    <a class="navbar-brand" href="index.php">Thin fabric</a>

    <div class="ml-auto">
      <a href="index.php" class="nav-btn">หน้าหลัก</a>
      <a href="catalog.php" class="nav-btn">หมวดหมู่</a>
      <a href="cart.php" class="nav-btn position-relative">
    🛍️ ตะกร้า
    <?php if ($cart_count > 0): ?>
        <span class="badge badge-danger position-absolute" style="top:-5px; right:-10px;">
            <?php echo $cart_count; ?>
        </span>
    <?php endif; ?>
</a>
      <a href="contact.php" class="nav-btn">ติดต่อ</a>

      <?php if (isset($_SESSION['user'])): ?>
        <span class="text-white mx-2">สวัสดี <?php echo htmlspecialchars($_SESSION['user']); ?></span>
        <a href="logout.php" class="btn btn-danger btn-sm">ออก</a>
      <?php else: ?>
        <a href="login.php" class="btn btn-light btn-sm">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
        </header>
    

    
        <div class="header">
            <p>เลือกซื้อเสื้อผ้าคุณภาพดี ราคาสบายกระเป๋า</p>
        </div>
        
        <div class="container mt-4">
            <div class="row">
            <?php
            // ตรวจสอบว่ามีข้อมูลในฐานข้อมูลหรือไม่
            if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card h-100">';
        echo '<img src="' . htmlspecialchars($row["image_url"]) . '" class="card-img-top">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($row["product_name"]) . '</h5>';
        echo '<p class="card-text text-danger">' . htmlspecialchars($row["price"]) . ' บาท</p>';
        echo '<a href="addcart.php?id=' . $row['id'] . '" class="btn btn-primary btn-block">Add to cart</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "ไม่พบข้อมูลสินค้า";
}

$conn->close();
            ?>
        </div>
    </div>
    
    <footer>
        <p>© 2025 ร้านขายเสื้อมือสองจากปากี. สงวนลิขสิทธิ์</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>

                <script>
                  const coords = { x: 0, y: 0 };
                    const circles = [];
                    const numCircles = 12;

    // สร้างวงกลม
    for (let i = 0; i < numCircles; i++) {
        const div = document.createElement("div");
        div.classList.add("circle");
        div.style.position = "fixed";
        div.style.top = 0;
        div.style.left = 0;
        div.style.width = "20px";
        div.style.height = "20px";
        div.style.borderRadius = "50%";
        div.style.backgroundColor = "#FF6600";
        div.style.pointerEvents = "none";
        div.style.zIndex = "9999";
        div.style.opacity = (numCircles - i) / numCircles;
        document.body.appendChild(div);
        circles.push(div);
    }

    window.addEventListener("mousemove", function(e) {
        coords.x = e.clientX;
        coords.y = e.clientY;
    });

    function animateCircles() {
        let x = coords.x;
        let y = coords.y;

        circles.forEach(function(circle, index) {
            circle.style.left = x - 10 + "px";
            circle.style.top = y - 10 + "px";
            
            circle.style.scale = (numCircles - index) / numCircles;

            const nextCircle = circles[index + 1] || circles[0];
            x += (nextCircle.offsetLeft - x) * 0.3;
            y += (nextCircle.offsetTop - y) * 0.3;
        });

        requestAnimationFrame(animateCircles);
    }

    animateCircles();
                    </script>



<style>
@import url('https://fonts.googleapis.com/css2?family=Anton&family=Kanit:wght@300;400;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Kanit', sans-serif;
    background-color: #ffffff; /* พื้นหลังขาว */
    color: #333;
    line-height: 1.6;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* Header */
/* Navbar เต็มแถบ */
.custom-navbar {
    background: linear-gradient(90deg, #ff6600, #ff8533);
    padding: 15px 0;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

/* โลโก้ */
.navbar-brand {
    font-family: 'Anton', sans-serif;
    font-size: 3.8rem;
    color: #fff !important;
    letter-spacing: 2px;
}

/* ปุ่มเมนู */
.nav-btn {
    color: #fff;
    text-decoration: none;
    margin-left: 15px;
    padding: 8px 16px;
    border-radius: 30px;
    font-weight: 600;
    transition: 0.3s;
    background: rgba(255,255,255,0.15);
}

/* hover */
.nav-btn:hover {
    background: #fff;
    color: #ff6600;
}

/* ทำให้ navbar ลอยติดด้านบน */
.navbar {
    position: sticky;
    top: 0;
    z-index: 1000;
}

/* Container */
.container {
    flex: 1;
    padding: 40px 5%;
    max-width: 1200px;
    margin: 0 auto;
}

.header {
    text-align: center;
    margin-bottom: 50px;
}

.header p {
    font-size: 1.2rem;
    color: #666;
    border-left: 5px solid #FF6600;
    display: inline-block;
    padding-left: 15px;
}

/* Product Grid */

}

/* แถม: ทำให้รองรับมือถือด้วย (ถ้าเปิดในมือถือจะเหลือ 1 หรือ 2 คอลัมน์เพื่อให้ไม่เบียดกันเกินไป) */
@media (max-width: 1024px) {
    .product-grid {
        grid-template-columns: repeat(2, 1fr); /* แท็บเล็ตเหลือ 2 */
    }
}

@media (max-width: 600px) {
    .product-grid {
        grid-template-columns: repeat(1, 1fr); /* มือถือเหลือ 1 */
    }
}

/* Product Card */

}

.product-card:hover {
    border-color: #FF6600;
    transform: scale(1.03);
    box-shadow: 10px 10px 0px rgba(255, 102, 0, 0.1); /* เงาสีส้มแบบเหลี่ยม */
}

.product-image {
    width: 100%;
    aspect-ratio: 1 / 1; /* บังคับให้รูปเป็นจัตุรัสเท่ากันทุกใบ */
    object-fit: cover;
    margin-bottom: 15px;
    filter: grayscale(20%);
    transition: 0.3s;
}

.product-card:hover .product-image {
    filter: grayscale(0%);
}

.product-title {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-transform: uppercase;
}

.product-price {
    background: #FF6600;
    color: #fff;
    display: inline-block;
    padding: 2px 10px;
    font-family: 'Anton', sans-serif;
    font-size: 1.2rem;
}

/* Footer */
footer {
    background: #333;
    color: #fff;
    padding: 30px;
    text-align: center;
    margin-top: 50px;
}
</style>