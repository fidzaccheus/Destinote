<?php
include('db_connect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email_address = trim($_POST['email_address']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Password mismatch
    if ($password !== $confirm_password) {
        header("Location: ../index.php?status=error&message=Passwords%20do%20not%20match!&showModal=signUpModal");
        exit();
    }

    // Check if email exists
    $check = $conn->prepare("SELECT id FROM users WHERE email_address = ?");
    $check->bind_param("s", $email_address);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../index.php?status=error&message=Email%20already%20registered.&showModal=signUpModal");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(32));

    $stmt = $conn->prepare("
        INSERT INTO users (first_name, last_name, email_address, password, is_verified, verification_token)
        VALUES (?, ?, ?, ?, 0, ?)
    ");
    $stmt->bind_param("sssss", $first_name, $last_name, $email_address, $hashed_password, $token);

    if ($stmt->execute()) {

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '';
            $mail->Password = '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('YOUR_EMAIL@gmail.com', 'Destinote');
            $mail->addAddress($email_address);

            $verifyLink = "http://localhost/Destinote/includes/verify_email.php?token=" . $token;

            $mail->isHTML(true);
            $mail->Subject = 'Verify Your Destinote Account';
            $mail->Body = "
                <h2>Welcome to Destinote, {$first_name}!</h2>
                <p>Please verify your email by clicking the link below:</p>
                <p><a href='$verifyLink'>Verify My Email</a></p>
                <br>
                <p>If you didn’t request this, you can ignore the email.</p>
            ";

            $mail->send();

        } catch (Exception $e) {
        }

        header("Location: ../index.php?status=success&message=Registration%20successful!%20Please%20verify%20your%20email.&showModal=signUpModal");
        exit();

    } else {
        header("Location: ../index.php?status=error&message=Error%20registering%20user.&showModal=signUpModal");
    }

    $stmt->close();
    $conn->close();
}
?>
