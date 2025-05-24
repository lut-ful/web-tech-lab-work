<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    header("Location: ../Customer/customer_login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "webtech_project");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

// Handle Add Project
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_project'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO projects (title, description, customer_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $description, $_SESSION['customer_id']);
    $stmt->execute();
    $stmt->close();

    $success = "Project added successfully!";
}

// Handle Delete
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ? AND customer_id = ?");
    $stmt->bind_param("ii", $delete_id, $_SESSION['customer_id']);
    $stmt->execute();
    $stmt->close();
    header("Location: customer_dashboard.php");
    exit;
}

// Fetch Projects
$stmt = $conn->prepare("SELECT id, title, description FROM projects WHERE customer_id = ?");
$stmt->bind_param("i", $_SESSION['customer_id']);
$stmt->execute();
$result = $stmt->get_result();
$projects = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        Freelance Project Management
    </header>

    <div class="container">
        <aside class="sidebar">
            <h2>Menu</h2>
            <a href="#">Dashboard</a>
            <a href="profile.php">Profile</a>
            <a href="../customer_logout.php" class="logout-link">Logout</a>
        </aside>


        <div class="main-content">
            <h1>Welcome, <?= htmlspecialchars($_SESSION['customer_name']); ?></h1>

            <?php if (isset($success)): ?>
                <p style="color: green; font-weight: bold;"><?= htmlspecialchars($success) ?></p>
            <?php endif; ?>

            <!-- Add New Project Form -->
            <h2>Add New Project</h2>
            <form method="POST">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>

                <button type="submit" name="add_project" class="add">Add Project</button>
            </form>

            <!-- Projects List -->
            <h2>My Projects</h2>
            <?php if (count($projects) > 0): ?>
                <table class="project-list">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projects as $project): ?>
                            <tr>
                                <td><?= htmlspecialchars($project['title']) ?></td>
                                <td><?= htmlspecialchars($project['description']) ?></td>
                                <td>
                                    <a href="edit_project.php?id=<?= $project['id'] ?>" class="btn btn-primary">Edit</a>
                                    <a href="customer_dashboard.php?delete_id=<?= $project['id'] ?>" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this project?');">Delete</a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>You have no projects yet.</p>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>