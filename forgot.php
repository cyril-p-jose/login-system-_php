<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include "db.php";

$email = $_POST['email'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $token = bin2hex(random_bytes(50));
    $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

    $conn->query("UPDATE users SET reset_token='$token', token_expiry='$expiry' WHERE email='$email'");

    $link = "http://localhost:8080/login-system/reset_form.php?token=$token";

    $mail = new PHPMailer(true);

    try {
        // SMTP SETTINGS
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'cyrilpjose2025@gmail.com';
        $mail->Password = 'ngxcuviorxsigzly';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // EMAIL CONTENT
        $mail->setFrom('cyrilpjose2025@gmail.com', 'Login System');
        $mail->addAddress($email);

        $mail->Subject = 'Password Reset';
        $mail->Body = "Click this link to reset password: $link";

        $mail->send();
        echo "Reset link sent to your email!";

    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    echo "Email not found!";
}
?>