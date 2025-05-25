<?php
session_start();
include '../../model/seller/db_crud.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email'])) {
    $email = $_POST['email'];
    $result = deleteSeller($email, $conn);

    if (isset($_SESSION['user']) && $_SESSION['user']['email'] === $email) {
        session_unset();
        session_destroy();
    }

    header('Location: ../index.php');
    exit();
} else {
    header('Location: dashboard.php');
    exit();
}
?>
