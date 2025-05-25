<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$errors = [];
$values = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'validate_seller.php';
    include '../../model/seller/db_crud.php';

    if (empty($errors)) {
        // Ensure uploads directory exists
        $uploadDir = '../../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Check if directory is writable
        if (!is_writable($uploadDir)) {
            $errors['upload'] = "Upload directory is not writable. Please check permissions.";
        }

        // Handle profile picture upload
        $profile_picture = '';
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
            $profile_picture = uniqid('profile_') . '.' . $ext;
            $target = $uploadDir . $profile_picture;
            if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target)) {
                $errors['profile_picture'] = 'Failed to upload profile picture: ' . error_get_last()['message'];
            }
        }

        // Handle portfolio upload
        $portfolio = '';
        if (isset($_FILES['portfolio']) && $_FILES['portfolio']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['portfolio']['name'], PATHINFO_EXTENSION);
            $portfolio = uniqid('portfolio_') . '.' . $ext;
            $target = $uploadDir . $portfolio;
            if (!move_uploaded_file($_FILES['portfolio']['tmp_name'], $target)) {
                $errors['portfolio'] = 'Failed to upload portfolio: ' . error_get_last()['message'];
            }
        }

        // Ensure skills is always an array
        $skills = isset($values['skills']) && is_array($values['skills']) ? $values['skills'] : [];

        // Store password directly (no hashing)
        $plain_password = $values['password'];

        // Prepare data for DB
        $data = [
            'full_name' => $values['full_name'],
            'email' => $values['email'],
            'password' => $plain_password,
            'profile_picture' => $profile_picture,
            'phone' => $values['phone'],
            'dob' => $values['dob'],
            'skills' => $skills,
            'portfolio' => $portfolio,
            'hours' => $values['hours'],
            'payment' => $values['payment'],
            'about_you' => $values['about_you'],
            'terms' => isset($values['terms']) ? 1 : 0
        ];

        // Use global $conn from db_crud.php
        $result = createSeller($data, $conn);
        if ($result) {
            header("Location: ../submit.php");
            exit();
        } else {
            $errors['db'] = "Registration failed. Please try again.";
        }
    }
}
?>