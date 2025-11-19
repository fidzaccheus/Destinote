<?php
include "db_connect.php";

if (!isset($_GET['token'])) {
    die("Invalid verification link.");
}

$token = $_GET['token'];

$sql = "SELECT id FROM users WHERE verification_token = ? AND is_verified = 0 LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Invalid or expired token.");
}

$user = $result->fetch_assoc();
$user_id = $user['id'];

$update = $conn->prepare("UPDATE users SET is_verified = 1, verification_token = NULL WHERE id = ?");
$update->bind_param("i", $user_id);
$update->execute();

header("Location: ../index.php?status=success&message=Email%20verified!%20You%20can%20now%20sign%20in.&showModal=signInModal");
exit();
?>