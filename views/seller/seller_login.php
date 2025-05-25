<?php
session_start();
$error = '';
if (isset($_SESSION['login_error'])) {
    $error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Seller Login</title>
    <style>
        .error-message {
            color: red;
            margin-bottom: 10px;
        }
        .success-message {
            color: green;
            margin-bottom: 10px;
        }
        .loading {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Seller Login</h2>
    <div id="message-container">
        <?php if (!empty($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </div>
    <form id="login-form">
        <label>Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <div class="loading" id="loading">Logging in...</div>
    
    <script src="js/login_ajax.js"></script>
</body>
</html>