<?php
session_start();
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email_address = trim($_POST['email_address']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email_address = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_address);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['email_address'] = $user['email_address'];

            header("Location: ../index.php?status=success&message=Welcome%20back!&showModal=signInModal&redirect=dashboard");
            exit();
        } else {
            header("Location: ../index.php?status=error&message=Incorrect%20password.&showModal=signInModal");
            exit();
        }
    } else {
        header("Location: ../index.php?status=error&message=Email%20does%20not%20exist.&showModal=signInModal");
        exit();
    }
}
$conn->close();
?>