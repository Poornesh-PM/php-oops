<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$user = $_SESSION['user']; 
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';

unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
       
        <header class="navbar">
            <div class="navbar-left">
                <div class="hamburger-menu" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
            <div class="navbar-center">
                <h1>Admin Dashboard</h1>
            </div>
            <div class="navbar-right">
                <span>Welcome, <?php echo htmlspecialchars($user['name']); ?></span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </header>

        
        <div class="sidebar-container">
            <nav class="sidebar" id="sidebar">
                <ul>

                    <li><a href="#">Reports</a></li>
                    <li><a href="view_students.php">View Students</a></li>
                    <li><a href="admin_add_students.php">Add Students</a></li>
                    <li><a href="view_teachers.php">View Teachers</a></li>
                    <li><a href="admin_add_teachers.php">Add Teachers</a></li>
                    <li><a href="#">View Classes</a></li>
                    <li><a href="#">Add Classes</a></li>
                    <li><a href="#">Manage Subjects</a></li>

                </ul>
            </nav>
        </div>

        
        <div class="dashboard-body">
            <main class="main-content">
                <h2>Welcome to the Admin Dashboard</h2>
                <p>This is where you can manage all aspects of the school system.</p>

                <?php if ($message): ?>
                    <p class="message"><?php echo $message; ?></p>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <script>
        
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>

</html>