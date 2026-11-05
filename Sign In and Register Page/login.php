
<?php
session_start();
include "database.php";

$message = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];

            header("Location: dashboard.php");
            exit();

        } else {
            $message = "Incorrect password!";
        }

    } else {
        $message = "Account not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
</head>
<body>

<h2>Sign In</h2>

<form method="POST">

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Sign In</button>

</form>

<p><?php echo htmlspecialchars($message); ?></p>

<p>Don't have an account? <a href="register.php">Register</a></p>

</body>
</html>
