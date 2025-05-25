<?php
session_start();
require_once '../../model/seller/db_crud.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $errors = [];
    $values = [];

    $fields = [
        'full_name', 'email', 'phone', 'dob', 'hours', 'payment', 'about_you'
    ];
    foreach ($fields as $field) {
        $values[$field] = trim($_POST[$field] ?? '');
    }
    $values['skills'] = isset($_POST['skills']) ? $_POST['skills'] : [];
    $user = $_SESSION['user'];
    $values['profile_picture'] = $user['profile_picture'] ?? '';
    $values['portfolio'] = $user['portfolio'] ?? '';

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('profile_') . '.' . $ext;
        $target = '../../uploads/' . $filename;
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target)) {
            $values['profile_picture'] = $filename;
        } else {
            $errors['profile_picture'] = 'Failed to upload profile picture.';
        }
    }

    if (isset($_FILES['portfolio']) && $_FILES['portfolio']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['portfolio']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('portfolio_') . '.' . $ext;
        $target = '../../uploads/' . $filename;
        if (move_uploaded_file($_FILES['portfolio']['tmp_name'], $target)) {
            $values['portfolio'] = $filename;
        } else {
            $errors['portfolio'] = 'Failed to upload portfolio.';
        }
    }

    if ($values['full_name'] === '') $errors['full_name'] = 'Full name is required.';
    if ($values['email'] === '' || !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Valid email is required.';
    if ($values['phone'] === '') $errors['phone'] = 'Phone is required.';
    if ($values['dob'] === '') $errors['dob'] = 'Date of birth is required.';
    if (empty($values['skills'])) $errors['skills'] = 'Select at least one skill.';
    if ($values['hours'] === '' || !is_numeric($values['hours'])) $errors['hours'] = 'Hours required.';
    if ($values['payment'] === '') $errors['payment'] = 'Select a payment method.';
    if ($values['about_you'] === '') $errors['about_you'] = 'About you is required.';

    $skills_str = is_array($values['skills']) ? implode(',', $values['skills']) : $values['skills'];

    if ($errors) {
        $_SESSION['edit_errors'] = $errors;
        $_SESSION['edit_values'] = $values;
        header('Location: ../../views/seller/dashboard.php?edit=1');
        exit();
    }

    $old_email = $_POST['old_email'] ?? $values['email'];
    $updateData = [
        'full_name' => $values['full_name'],
        'phone' => $values['phone'],
        'dob' => $values['dob'],
        'skills' => $skills_str,
        'hours' => $values['hours'],
        'payment' => $values['payment'],
        'about_you' => $values['about_you'],
        'profile_picture' => $values['profile_picture'],
        'portfolio' => $values['portfolio']
    ];

    $result = updateSeller($old_email, $updateData, $conn);

    if ($result) {
        $updatedUser = getSellerByEmail($values['email'], $conn);
        $_SESSION['user'] = $updatedUser;
        header('Location: ../../views/seller/dashboard.php');
        exit();
    } else {
        $_SESSION['edit_errors'] = ['db' => 'Failed to update profile.'];
        $_SESSION['edit_values'] = $values;
        header('Location: ../../views/seller/dashboard.php?edit=1');
        exit();
    }
}
?>
