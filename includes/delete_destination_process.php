<?php
include('db_connect.php');
session_start();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);

    $user_id = $_SESSION['id'] ?? null;

    if (!$user_id) {
        header("Location: ../index.php");
        exit();
    }

    $check = $conn->prepare("SELECT id FROM destinations WHERE id = ? AND user_id = ?");
    $check->bind_param("ii", $id, $user_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows === 0) {
        header("Location: ../destinations.php?status=error&message=" . urlencode("Destination not found or unauthorized."));
        exit();
    }

    $check->close();

    $delete = $conn->prepare("DELETE FROM destinations WHERE id = ? AND user_id = ?");
    $delete->bind_param("ii", $id, $user_id);

    if ($delete->execute()) {
        header("Location: ../destinations.php?status=success&message=" . urlencode("Destination deleted successfully."));
        exit();
    } else {
        header("Location: ../destinations.php?status=error&message=" . urlencode("Error deleting destination."));
        exit();
    }
} else {
    header("Location: ../destinations.php?status=error&message=" . urlencode("No destination specified."));
    exit();
}
?>