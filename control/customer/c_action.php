<?php
require_once '../../model/customerRegDb.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['register'])) {
    header("HTTP/1.1 400 Bad Request");
    exit("Invalid access");
}

$errors = [];

// 1) Collect & validate inputs
$full_name        = trim($_POST['full_name']        ?? '');
$email            = trim($_POST['email']            ?? '');
$phone            = trim($_POST['phone']            ?? '');
$username         = trim($_POST['username']         ?? '');
$password         = $_POST['password']              ?? '';
$confirm_password = $_POST['confirm_password']      ?? '';
$payment          = $_POST['payment']               ?? '';
$terms_agreed     = isset($_POST['terms']);
$profile_picture_path = "";

// Basic field validations
if (strlen($full_name) < 3)       $errors['full_name']       = "Name must be ≥3 chars.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email']    = "Valid email required.";
if ($phone !== "" && !preg_match('/^\d+$/', $phone)) $errors['phone']   = "Digits only.";
if (strlen($username) < 4)        $errors['username']        = "Username ≥4 chars.";
if (strlen($password) < 6)        $errors['password']        = "Password ≥6 chars.";
if ($password !== $confirm_password) $errors['confirm_password'] = "Passwords mismatch.";
if (!$terms_agreed)               $errors['terms']           = "You must agree to terms.";

// Handle image upload
if (!empty($_FILES['profile_picture']['name'])) {
    $upload_dir = "../../uploads/";
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
    $target = $upload_dir . basename($_FILES['profile_picture']['name']);
    if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target)) {
        $errors['profile_picture'] = "Image upload failed.";
    } else {
        $profile_picture_path = $target;
    }
}

// 2) If any validation errors, redirect back
if (count($errors) > 0) {
    $errs = urlencode(json_encode($errors));
    header("Location: ../../views/customer/customer_Reg.php?errors={$errs}");
    exit;
}

// 3) Call model to register
$db   = new mydb();
$conn = null;
try {
    $conn = $db->createConObject();
} catch (Exception $e) {
    exit("DB connection error: " . $e->getMessage());
}

$hashed = password_hash($password, PASSWORD_DEFAULT);
$result = $db->registerCustomer(
    $conn,
    $full_name,
    $email,
    $hashed,
    $phone,
    $username,
    $profile_picture_path,
    $payment
);

// 4) Handle model response
if ($result['success']) {
    header("Location: ../../views/customer/registration_success.php");
    exit;
} else {
    $errors['general'] = $result['message'];
    $errs = urlencode(json_encode($errors));
    header("Location: ../../views/customer/customer_Reg.php?errors={$errs}");
    exit;
}
