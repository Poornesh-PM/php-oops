<?php
session_start();
include_once 'includes/User.php'; 

$user = new User();

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'student'; 

    if ($user->checkEmailExists($email)) {
        $message = "Email is already registered!";
    } else {
        
        if ($user->register($name, $email, $password, $role)) {
            $message = "Student added successfully!";
        } else {
            $message = "Error adding student. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Add New Student</h2>
        
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        
        <?php if ($message !== "Student added successfully!"): ?>
            <form method="POST" action="admin_add_students.php">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>

                <button type="submit">Add Student</button>
            </form>
        <?php else: ?>
            <a href="admin_dashboard.php" class="back-to-dashboard-btn">Go Back to Dashboard</a>
        <?php endif; ?>

    </div>
</body>
</html>
