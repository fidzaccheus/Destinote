<?php
include('db_connect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $destination_name = trim($_POST['destination_name']);
    $country = trim($_POST['country']);
    $city = trim($_POST['city']);
    $travel_date = trim($_POST['travel_date']);
    $budget = trim($_POST['budget']);
    $tag = trim($_POST['tag']);
    $description = trim($_POST['description']);

    // Initialize variables for image
    $imageData = null;
    $imageType = null;

    // Check if new image was uploaded
    if (!empty($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
        $imageType = mime_content_type($_FILES['image']['tmp_name']);
    }

    if ($imageData !== null && $imageType !== null) {
        // Update including image
        $sql = "UPDATE destinations 
                SET destination_name=?, country=?, city=?, travel_date=?, budget=?, tag=?, description=?, image=?, image_type=? 
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssi",
            $destination_name,
            $country,
            $city,
            $travel_date,
            $budget,
            $tag,
            $description,
            $imageData,
            $imageType,
            $id
        );
    } else {
        // Update without changing image
        $sql = "UPDATE destinations 
                SET destination_name=?, country=?, city=?, travel_date=?, budget=?, tag=?, description=? 
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssi",
            $destination_name,
            $country,
            $city,
            $travel_date,
            $budget,
            $tag,
            $description,
            $id
        );
    }

    if ($stmt->execute()) {
        header("Location: ../destinations.php?status=success&message=" . urlencode("Destination updated successfully."));
        exit();
    } else {
        header("Location: ../destinations.php?status=error&message=" . urlencode("Error updating destination."));
        exit();
    }
}
$conn->close();
?>