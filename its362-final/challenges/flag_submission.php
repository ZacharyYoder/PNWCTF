<?php
// further testing required

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: ../login/login.html");
    exit();
}

$username = $_SESSION["username"];

$message = "";

$flags = [
    "FLAG{reflected_xss_master}" => "Web Challenge 1",
    "FLAG{sql_injection_king}" => "Web Challenge 2"
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = trim($_POST["flag"]);

    if (array_key_exists($flag, $flags)) {
        $challenge = $flags[$flag];
        $message = "Correct! You solved: $challenge";
    } else {
        $message = "Incorrect flag. Try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PNWCTF - Submit Flag</title>
    <link rel="stylesheet" href="../style/styles.css">
</head>
<body>

<div class="container">
    <h1 class="logo">PNWCTF</h1>
    <h2>Flag Submission</h2>

    <p>Logged in as: <strong><?php echo htmlspecialchars($username); ?></strong></p>

    <form method="POST">
        <label>Enter Flag</label>
        <input type="text" name="flag" placeholder="FLAG{...}" required>
        <input type="submit" value="Submit Flag">
    </form>

    <div class="card">
        <?php echo $message; ?>
    </div>

    <br>
    <a href="../users/dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>