<?php
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email_address = trim($_POST['email_address']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        header("Location: ../index.php?status=error&message=Passwords%20do%20not%20match!&showModal=signUpModal");
        exit();
    }

    $check = $conn->prepare("SELECT * FROM users WHERE email_address = ?");
    $check->bind_param("s", $email_address);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../index.php?status=error&message=Email%20already%20registered.&showModal=signUpModal");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email_address, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first_name, $last_name, $email_address, $hashed_password);

    if ($stmt->execute()) {
        header("Location: ../index.php?status=success&message=Registration%20successful!%20You%20can%20now%20sign%20in.&showModal=signUpModal&email=" . urlencode($email_address));
    } else {
        header("Location: ../index.php?status=error&message=Error%20registering%20user.&showModal=signUpModal");
    }

    $stmt->close();
    $conn->close();
}
?>