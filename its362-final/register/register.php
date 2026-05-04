<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli("localhost", "root", "", "PNWCTF");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST["username"] ?? '';
    $email    = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $confirm  = $_POST["confirm_password"] ?? '';
    $date     = date("Y-m-d H:i:s");
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
    echo "Invalid email format.";
    exit();
    }
    // Check passwords match
    if ($password !== $confirm) {
        echo "Passwords do not match.";
        exit();
    }
    $hashPass = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO users (username, email, password, date_created) VALUES (?, ?, ?, ?)"
    );
    if(!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }
    $stmt->bind_param("ssss", $username, $email, $hashPass, $date);
    if ($stmt->execute()) {
        header("Location: ../login/login.html");
        exit();
    } else {
        die("Execute failed: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>