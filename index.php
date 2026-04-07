<?php
session_start();
?>


<?php
// includes/db_connect.php
require_once 'db_connect.php'; 

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลสินค้าทั้งหมดจากตาราง products
$sql = "SELECT product_name, price, image_url FROM products";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เสื้อผ้ามือสองสุดเท่</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
        <header> 
            <h1>เสื้อผ้าขี้ริ้วมือสอง</h1>
            <a href="index.php"> หน้าหลัก</a>
            <a href="catalog.php"> หมวดหมู่</a>
            <a href="cart.php">🛍️ ตะกร้าสินค้า</a>
            <a href="contact.php">ติดต่อเรา</a>
        
            <?php if (isset($_SESSION['user'])): ?>
            <span>สวัสดี <?php echo htmlspecialchars($_SESSION['user']); ?></span>
            <a href="logout.php">ออกจากระบบ</a>
            <?php else: ?>
            <a href="login.php">เข้าสู่ระบบ</a>
            <?php endif; ?>
        </header>
    

    <div class="container">
        <div class="header">
            <p>เลือกซื้อเสื้อผ้าคุณภาพดี ราคาสบายกระเป๋า</p>
        </div>
        
        <div class="product-grid">
            <?php
            // ตรวจสอบว่ามีข้อมูลในฐานข้อมูลหรือไม่
            if ($result->num_rows > 0) {
                // วนลูปเพื่อแสดงผลสินค้าแต่ละชิ้น
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product-card">';
                    echo '<img src="' . htmlspecialchars($row["image_url"]) . '" alt="' . htmlspecialchars($row["product_name"]) . '" class="product-image">';
                    echo '<h2 class="product-title">' . htmlspecialchars($row["product_name"]) . '</h2>';
                    echo '<p class="product-price">' . htmlspecialchars($row["price"]) . ' บาท</p>';
                    echo '</div>';
                }
            } else {
                echo "ไม่พบข้อมูลสินค้า";
            }
            
            // ปิดการเชื่อมต่อเมื่อใช้งานเสร็จ
            $conn->close();
            ?>
        </div>
    </div>
    
    <footer>
        <p>© 2025 ร้านขายเสื้อมือสองจากปากี. สงวนลิขสิทธิ์</p>
    </footer>
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
header {
    background-color: #fff;
    padding: 20px 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 3px solid #FF6600; /* เส้นใต้สีส้ม */
    position: sticky;
    top: 0;
    z-index: 1000;
}

header h1 {
    font-family: 'Anton', sans-serif;
    color: #FF6600; /* ส้มเด่นๆ */
    text-transform: uppercase;
    font-size: 2.2rem;
}

header div a {
    color: #333;
    text-decoration: none;
    margin-left: 15px;
    font-weight: 600;
    padding: 8px 16px;
    border-radius: 50px;
    transition: 0.3s;
}

header a:hover {
    color: #FF6600;
}
header a[href="index.php"] {
    background-color: #FF6600;
    color: #fff;
}
header a[href="catalog.php"] {
    background-color: #FF6600;
    color: #fff;
}
header a[href="contact.php"] {
    background-color: #FF6600;
    color: #fff;
}
header a[href="cart.php"] {
    background-color: #FF6600;
    color: #fff;
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
.product-grid {
    display: grid;
    /* เปลี่ยนจาก auto-fill เป็นการระบุเลข 4 ไปเลย */
    grid-template-columns: repeat(4, 1fr); 
    gap: 20px; /* ลดช่องว่างลงนิดนึงเพื่อให้วาง 4 ชิ้นได้สวยๆ */
    width: 100%;
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
.product-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 0; /* เปลี่ยนเป็นเหลี่ยมเพื่อให้ดูแนวสตรีท */
    padding: 15px;
    transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
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