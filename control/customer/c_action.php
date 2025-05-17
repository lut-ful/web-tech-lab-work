<?php
require_once '../../model/customerRegDb.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $payment = $_POST['payment'] ?? '';
    $terms = isset($_POST['terms']);
    $profile_picture_path = '';

    if (empty($full_name) || strlen($full_name) < 3) {
        $errors['full_name'] = 'Full Name must be at least 3 characters.';
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email address.';
    }

    if (!empty($phone) && !preg_match('/^\d+$/', $phone)) {
        $errors['phone'] = 'Phone number must contain digits only.';
    }

    if (empty($username) || strlen($username) < 4) {
        $errors['username'] = 'Username must be at least 4 characters.';
    }

    if (empty($password) || strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters.';
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match.';
    }

    if (empty($payment) || !in_array($payment, ['paypal', 'bank_transfer', 'crypto'])) {
        $errors['payment'] = 'Please select a valid payment method.';
    }

    if (!$terms) {
        $errors['terms'] = 'You must agree to the terms.';
    }

    if (!empty($errors)) {
        $errorString = urlencode(json_encode($errors));
        header("Location: ../../views/Customer/customer_Reg.php?errors=$errorString");
        exit;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $db = new mydb();
    $conn = $db->createConObject();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $db->registerCustomer(
        $conn,
        'CustomerRegistration',
        $full_name,
        $email,
        $password_hash,
        $phone,
        $username,
        $profile_picture_path,
        $payment
    );

    $db->closeCon($conn);

    if ($result === true) {
        echo("Success");
        exit;
    } else {
        $errors['database'] = $result;
        $errorString = urlencode(json_encode($errors));
        header("Location: ../../views/Customer/customer_Reg.php?errors=$errorString");
        exit;
    }
}
?>
