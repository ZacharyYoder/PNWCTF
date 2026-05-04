<?php
session_start();

$conn = new mysqli("localhost", "root", "", "web2");

$flag = "PNW{V2ViMl9TUUxpX1phY2tZb2Rlcg==}";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    // VULNERABLE QUERY (SQL INJECTION HERE)
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row["is_admin"] == 1) {
            $message = "Welcome admin! $flag";
        } else {
            $message = "Login successful, but not admin.";
        }

    } else {
        $message = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Web Challenge 2 - SQLi</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body>

<div class="container">
    <h1 class="logo">Secure Web Site</h1>

    <form method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Login">
    </form>

    <div>
        <?php echo $message; ?>
    </div>

</div>

</body>
</html>