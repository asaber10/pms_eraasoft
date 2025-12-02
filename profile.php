<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: login.php");
    exit;
}
?>
<h1>Welcome, <?php echo $_SESSION['user']; ?></h1>
<a href="logout.php">Logout</a>
