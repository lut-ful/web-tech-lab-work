<?php
session_start();
include __DIR__ . '/../../model/seller/db_crud.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($email && $password) {
        $user = getSellerByEmail($email, $conn);
        if ($user && $password === $user['password']) {
            $_SESSION['user'] = $user;
            header("Location: ../../views/seller/dashboard.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid email or password.";
            header("Location: ../../views/seller/seller_login.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Please enter both email and password.";
        header("Location: ../../views/seller/seller_login.php");
        exit();
    }
}
?>