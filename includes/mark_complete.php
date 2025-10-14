<?php
include('db_connect.php');

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $sql = "UPDATE destinations SET status = 'Completed' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../destinations.php?status=success&message=Destination%20marked%20as%20completed!");
        exit();
    } else {
        header("Location: ../destinations.php?status=error&message=Failed%20to%20update%20status.");
        exit();
    }
}
?>