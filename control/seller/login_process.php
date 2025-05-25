<?php
session_start();
include __DIR__ . '/../../model/seller/db_crud.php';

header('Content-Type: application/json');

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($email && $password) {
        $user = getSellerByEmail($email, $conn);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            $response['success'] = true;
            $response['message'] = 'Login successful';
            $response['redirect'] = '../../views/seller/dashboard.php';
        } else {
            $response['message'] = 'Invalid email or password.';
        }
    } else {
        $response['message'] = 'Please enter both email and password.';
    }
    
    echo json_encode($response);
    exit();
}
?>