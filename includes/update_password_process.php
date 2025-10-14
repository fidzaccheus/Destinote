<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

include_once 'db_connect.php';

$user_id = $_SESSION['id'];
$current = $_POST['current_password'] ?? '';
$new = $_POST['new_password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

// Fetch current password hash
$sql = "SELECT password FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$hash = $stmt->get_result()->fetch_assoc()['password'];

if (!password_verify($current, $hash)) {
    header("Location: ../profile.php?status=error&message=Current password incorrect");
    exit();
}

if ($new !== $confirm) {
    header("Location: ../profile.php?status=error&message=New passwords do not match");
    exit();
}

$hashed_new = password_hash($new, PASSWORD_DEFAULT);
$sql_update = "UPDATE users SET password = ? WHERE id = ?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("si", $hashed_new, $user_id);
$stmt_update->execute();

header("Location: ../profile.php?status=success&message=Password updated successfully");
exit();
?>