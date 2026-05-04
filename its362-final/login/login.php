<?php

    session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $conn = new mysqli("localhost", "root", "", "PNWCTF");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $login = trim($_POST["login"] ?? '');
    $password = trim($_POST["password"] ?? '');

    // Using Prepared Statements to prevent SQLi 
    $stmt = $conn->prepare(
    "SELECT username, password, date_created FROM users WHERE username = ? OR email = ?"
    );
    $stmt ->bind_param("ss", $login, $login);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user["password"])) {

            $_SESSION["username"] = $user["username"];  
            $_SESSION["date_created"] = $user["date_created"];
            
            $stmt->close();
            $conn->close();

            header("Location: ../users/dashboard.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }
}
?>