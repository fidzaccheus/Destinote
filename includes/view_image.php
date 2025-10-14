<?php
include('db_connect.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT image, image_type FROM destinations WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($imageData, $imageType);
        $stmt->fetch();

        if (!empty($imageData)) {
            header("Content-Type: $imageType");
            echo $imageData;
            exit();
        }
    }

    header("Content-Type: image/jpeg");
    readfile("../images/no_image.jpg");
    exit();
}

http_response_code(400);
echo "Invalid request.";
exit();
?>