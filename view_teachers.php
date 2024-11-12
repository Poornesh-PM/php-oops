<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$user = $_SESSION['user']; 


include('includes/User.php');
$userObj = new User();

$teachers = $userObj->getTeachers(); 

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';

unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Teachers</title>
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
                    <li><a href="#">Manage Subjects</a></li>
                    <li><a href="#">Reports</a></li>
                    <li><a href="view_students.php">View Students</a></li>
                    <li><a href="admin_add_students.php">Add Students</a></li>
                    <li><a href="view_teachers.php">View Teachers</a></li>
                    <li><a href="admin_add_teachers.php">Add Teachers</a></li>
                    <li><a href="#">View Classes</a></li>
                    <li><a href="#">Add Classes</a></li>

                </ul>
            </nav>
        </div>

       
        <div class="dashboard-body">
            <main class="main-content">
                <h2>View Teachers</h2>

                <?php if ($message): ?>
                    <p class="message"><?php echo $message; ?></p>
                <?php endif; ?>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($teachers): ?>
                            <?php foreach ($teachers as $teacher): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($teacher['name']); ?></td>
                                    <td><?php echo htmlspecialchars($teacher['email']); ?></td>
                                    <td><?php echo htmlspecialchars($teacher['role']); ?></td>
                                    <td><a href="edit_teacher.php?id=<?php echo $teacher['id']; ?>">Edit</a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">No teachers found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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