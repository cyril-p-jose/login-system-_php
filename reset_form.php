<?php
include "db.php";

$token = $_GET['token'];

$sql = "SELECT * FROM users WHERE reset_token='$token' AND token_expiry > NOW()";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Invalid or expired token!");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
</head>
<body>

<h2>Reset Password</h2>

<form action="reset.php" method="POST">
  <input type="hidden" name="token" value="<?php echo $token; ?>">
  <input type="password" name="password" placeholder="New Password" required>
  <button type="submit">Reset Password</button>
</form>

</body>
</html>