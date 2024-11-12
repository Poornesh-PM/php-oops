<?php
session_start();
include_once 'includes/User.php'; 
$user = new User();
if (!isset($_GET['id'])) {
    die("Student ID is required.");
}

$studentId = $_GET['id'];
$student = $user->getUserById($studentId);

if (!$student) {
    die("Student not found.");
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; 
   
    if ($user->updateStudent($studentId, $name, $email, $password)) {
        $message = "Student details updated successfully!";
    } else {
        $message = "Error updating student details.";
    }

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Student</h2>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST" action="edit_student.php?id=<?php echo $student['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>

            <label for="password">Password (Leave empty if not changing):</label>
            <input type="password" name="password" id="password">

            <button type="submit">Update Student</button>
        </form>

        <a href="view_students.php">Go Back to View Students</a>
    </div>
</body>
</html>
