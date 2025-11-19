<?php
session_start();
include(__DIR__ . '/../db_connect.php');  // Correct path to DB

// Only admin can delete
if (!isset($_SESSION['email_address']) || $_SESSION['email_address'] !== 'admin@destinote.com') {
    header("Location: ../../admin.php?status=error&message=Unauthorized%20access");
    exit();
}

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: ../../admin.php?tab=destinations&status=error&message=No%20destination%20specified");
    exit();
}

// Delete destination
$sql = "DELETE FROM destinations WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../../admin.php?tab=destinations&status=success&message=Destination%20deleted%20successfully");
} else {
    header("Location: ../../admin.php?tab=destinations&status=error&message=Failed%20to%20delete%20destination");
}

exit();
