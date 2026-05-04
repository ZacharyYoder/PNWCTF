<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: ../login/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Web Challenge 1 - XSS</title>
</head>
<body>

<div class="container">
    <h1 class="logo">PNWCTF</h1>

    <p>Search for your name:</p>

    <form method="GET">
        <input type="text" name="name" placeholder="Enter name">
        <input type="submit" value="Search">
    </form>

    <?php
        $name = $_GET['name'] ?? 'guest'; // vuln
    ?>

    <div id="output">
        Hello <?php echo $name ?> <!-- this seems safe -->
    </div>

    <!-- Hidden admin panel  -->
    <div id="admin-panel" style="display:none;">
        <p>Admin Panel Locked</p>
        <button onclick="revealFlag()">Access Secure Data</button>
    </div>

</div>

<script>
    let isAdminView = false;

    function unlockAdmin() {
        isAdminView = true;
        document.getElementById("admin-panel").style.display = "block";
    }

    function revealFlag() {
        if (isAdminView) {
            fetch("get_flag.php", { method: "POST"})
                .then(r => r.text())
                .then(flag => alert(flag));
        } else {
            alert("Access denied.");
        }
    }
</script>

</body>
</html>