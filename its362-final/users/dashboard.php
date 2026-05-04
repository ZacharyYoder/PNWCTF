<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: ../login/login.html");
    exit();
}

$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PNWCTF Dashboard</title>
    <link rel="stylesheet" href="/its362-FINAL/style/style.css">
</head>
<body>

    <!-- Top Bar -->
    <div class="topbar">
        <div class="brand">PNWCTF</div>

        <div class="user-section">
            <span class="username"><?php echo htmlspecialchars($username); ?></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="dashboard-container">
        <h2>Welcome to PNWCTF</h2>

        <div class="card">
            <h3>Challenges</h3>
            <p>Test your skills across multiple categories.</p>
            <a href="../challenges/web1/web1.php">Web Challenge 1: Cross-site What!?</a><br><br>
            <a href="../challenges/web2/web2.php">Web Challenge 2: Verify Credentials</a>
        </div>


    </div>

</body>
</html>