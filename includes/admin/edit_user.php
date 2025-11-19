<?php
session_start();
include('../db_connect.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST['id'] ?? null;
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email_address'] ?? '');

    if (empty($user_id) || empty($first_name) || empty($last_name) || empty($email)) {
        header("Location: ../../admin.php?tab=users&status=error&message=All fields are required");
        exit();
    }

    $check = $conn->prepare("SELECT id FROM users WHERE email_address = ? AND id != ?");
    $check->bind_param("si", $email, $user_id);
    $check->execute();
    $checkResult = $check->get_result();
    if ($checkResult->num_rows > 0) {
        header("Location: ../../admin.php?tab=users&status=error&message=Email already in use");
        exit();
    }

    $sql = "UPDATE users SET first_name = ?, last_name = ?, email_address = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $first_name, $last_name, $email, $user_id);

    if ($stmt->execute()) {
        header("Location: ../../admin.php?tab=users&status=success&message=User details updated successfully");
    } else {
        header("Location: ../../admin.php?tab=users&status=error&message=Failed to update user");
    }

    exit();
}
?>