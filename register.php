<?php
include "db.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, email, password) 
        VALUES ('$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful! <a href='index.html'>Login</a>";
} else {
    echo "Error: " . $conn->error;
}
?>