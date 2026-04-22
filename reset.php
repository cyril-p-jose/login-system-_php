<?php
include "db.php";

$token = $_POST['token'];
$newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

// verify token
$sql = "SELECT * FROM users WHERE reset_token='$token' AND token_expiry > NOW()";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // update password + clear token
    $conn->query("UPDATE users 
        SET password='$newPassword', reset_token=NULL, token_expiry=NULL 
        WHERE reset_token='$token'");

    echo "Password updated successfully! <a href='index.html'>Login</a>";

} else {
    echo "Invalid or expired token!";
}
?>