<?php
session_start();
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['id'];
    $destination_name = trim($_POST['destination_name']);
    $country = trim($_POST['country']);
    $city = trim($_POST['city']);
    $description = trim($_POST['description']);
    $travel_date = !empty($_POST['travel_date']) ? $_POST['travel_date'] : null;
    $budget = !empty($_POST['budget']) ? $_POST['budget'] : null;
    $tag = trim($_POST['tag']);

    $imageData = null;
    $imageType = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageType = mime_content_type($imageTmpPath);

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($imageType, $allowedTypes)) {
            $imageData = file_get_contents($imageTmpPath);
        } else {
            echo "<script>alert('Invalid image format. Only JPG, PNG, and GIF are allowed.'); window.history.back();</script>";
            exit();
        }
    }

    $sql = "INSERT INTO destinations 
            (user_id, destination_name, country, city, description, travel_date, budget, tag, image, image_type)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "isssssdsss",
        $user_id,
        $destination_name,
        $country,
        $city,
        $description,
        $travel_date,
        $budget,
        $tag,
        $imageData,
        $imageType
    );

    if ($stmt->execute()) {
        header("Location: ../destinations.php?status=success&message=Destination added successfully");
        exit();
    } else {
        header("Location: ../destinations.php?status=error&message=Failed to add destination");
        exit();
    }
}
?>