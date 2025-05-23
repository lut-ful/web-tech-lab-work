<?php
session_start();
require_once '../../model/seller/db_crud.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email'])) {
    $email = $_POST['email'];
    $result = deleteSeller($email, $conn);

    // Destroy session if the deleted user is logged in
    if (isset($_SESSION['user']) && $_SESSION['user']['email'] === $email) {
        session_unset();
        session_destroy();
    }

    // Redirect to home page after deletion
    header('Location: ../index.php');
    exit();
} else {
    // Invalid access
    header('Location: dashboard.php');
    exit();
}
?>
