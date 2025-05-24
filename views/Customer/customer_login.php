<?php
// BEGIN AUTH LOGIC
session_start();
require_once("../../model/customerRegDb.php"); // Adjust path as needed

$loginError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $loginError = "Both email and password are required.";
    } else {
        try {
            $db = new mydb();
            $conn = $db->createConObject();

            $sql = "SELECT id, full_name, email, password FROM customers WHERE email = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);

            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($user = $result->fetch_assoc()) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['customer_id'] = $user['id'];
                    $_SESSION['customer_name'] = $user['full_name'];
                    header("Location: Dashboard/customer_dashboard.php"); // Change to your dashboard
                    exit;
                }
            }
            $loginError = "Invalid email or password.";
        } catch (Exception $e) {
            $loginError = "Server error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Customer Login</title>
    <link rel="stylesheet" href="customer.css" />
</head>
<body>

<div class="container">
    <h2>Customer Login</h2>

    <?php if (!empty($loginError)): ?>
        <p class="error"><?= htmlspecialchars($loginError) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />

        <div class="buttons">
            <input type="submit" value="Login" />
        </div>
    </form>
</div>

</body>
</html>
