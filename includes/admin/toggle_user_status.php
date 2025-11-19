<?php
include('../db_connect.php');

$id = $_GET['id'] ?? null;
$status = $_GET['status'] ?? null;
$tab = $_GET['tab'] ?? 'users';

if ($id && $status) {
    $newStatus = $status === 'active' ? 'suspended' : 'active';
    $sql = "UPDATE users SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newStatus, $id);
    $stmt->execute();
}

header("Location: ../../admin.php?tab=$tab&status=success&message=User status updated");
exit();
?>