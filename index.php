<?php
require_once 'includes/User.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($user_data = $user->login($email, $password)) {
        session_start();
        $_SESSION['user'] = $user_data;

        // Redirect based on the role
        // if ($user_data['role'] == 'admin') {
            header("Location: admin_dashboard.php");  
        // }
        // } elseif ($user_data['role'] == 'teacher') {
        //     header("Location: teacher_dashboard.php");  
        // } else {
        //     header("Location: student_dashboard.php");  
        // }
        exit;
    } else {
        $message = 'Login failed. Please check your credentials.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css"> 
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if ($message) echo "<p>$message</p>"; ?>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="admin_register.php">Register here</a></p> 
    </div>
</body>
</html>
