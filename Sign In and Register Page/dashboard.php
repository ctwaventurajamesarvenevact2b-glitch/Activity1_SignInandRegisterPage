
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Welcome to Your Dashboard!</h1>

<h3>Hello, <?php echo htmlspecialchars($_SESSION['fullname']); ?>!</h3>

<p>You have successfully logged in.</p>

<a href="logout.php">Logout</a>

</body>
</html>
