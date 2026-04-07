<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<h1>ยินดีต้อนรับ <?php echo $_SESSION['user']; ?></h1>
<a href="logout.php">ออกจากระบบ</a>