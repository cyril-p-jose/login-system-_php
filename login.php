<?php
session_start();
include "db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {
        $_SESSION['user'] = $row['username'];
        header("Location: dashboard.php");
    } else {
        echo "Wrong password!";
    }
} else {
    echo "User not found!";
}
?>