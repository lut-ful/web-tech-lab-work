<?php
session_start();
$conn = new mysqli("localhost", "root", "", "webtech_project");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

if (!isset($_SESSION['customer_id'])) {
    header("Location: ../Customer/customer_login.php");
    exit;
}

$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $username = trim($_POST['username']);
    $payment = $_POST['payment'];

    
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($full_name) && !empty($username)) {
        $stmt = $conn->prepare("UPDATE customers SET full_name=?, email=?, phone=?, username=?, payment=? WHERE id=?");
        $stmt->bind_param("sssssi", $full_name, $email, $phone, $username, $payment, $_SESSION['customer_id']);
        $stmt->execute();
        $stmt->close();

        $_SESSION['customer_name'] = $full_name;
        $message = "Profile updated successfully.";
    } else {
        $message = "Please provide a valid name, username, and email.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_profile'])) {
    $stmt = $conn->prepare("DELETE FROM customers WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['customer_id']);
    $stmt->execute();
    $stmt->close();

    
    $_SESSION = [];
    session_destroy();
    header("Location: ../Customer/customer_login.php");
    exit;
}


$stmt = $conn->prepare("SELECT full_name, email, phone, username, payment FROM customers WHERE id = ?");
$stmt->bind_param("i", $_SESSION['customer_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        Freelance Project Management
    </header>

    <div class="container">
        <aside class="sidebar">
            <h2>Menu</h2>
            <a href="customer_dashboard.php">Dashboard</a>
            <a href="profile.php" class="active">Profile</a>
            <a href="../customer_logout.php" class="logout-link">Logout</a>
        </aside>

        <main class="main-content">
            <h1>My Profile</h1>

            <?php if (!empty($message)): ?>
                <p style="color: <?= strpos($message, 'successfully') !== false ? 'green' : 'red' ?>; font-weight: bold;">
                    <?= htmlspecialchars($message) ?>
                </p>
            <?php endif; ?>

            <form method="POST" style="max-width:600px;">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required />

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required />

                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" />

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" readonly />


                <label for="payment">Payment Method:</label>
                <select id="payment" name="payment" required>
                    <option value="paypal" <?= $user['payment'] === 'paypal' ? 'selected' : '' ?>>PayPal</option>
                    <option value="bank_transfer" <?= $user['payment'] === 'bank_transfer' ? 'selected' : '' ?>>Bank Transfer</option>
                    <option value="crypto" <?= $user['payment'] === 'crypto' ? 'selected' : '' ?>>Crypto</option>
                </select>

                <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
            </form>

            <form method="POST" onsubmit="return confirm('Are you sure you want to delete your profile? This action cannot be undone.');" style="max-width:600px; margin-top:2rem;">
                <button type="submit" name="delete_profile" class="btn btn-danger">Delete My Profile</button>
            </form>
        </main>
    </div>

</body>

</html>