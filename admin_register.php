<?php
require_once 'includes/User.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $existingUser = $user->checkEmailExists($email);
    if ($existingUser) {
        $message = 'Email already in use. Please choose another.';
    } else {
        if ($user->register($name, $email, $password)) {
            $message = 'Registration successful. You can now <a href="index.php">login</a>.';
        } else {
            $message = 'Registration failed. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="css/style.css"> 
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <div class="register-container">
        <h2>Register as Admin</h2>
        <?php if ($message) 
         echo "<p>$message</p>"; ?>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="index.php">Login here</a></p>
    </div>
</body>
</html>
