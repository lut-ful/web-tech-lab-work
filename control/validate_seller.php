<?php
function validateSellerForm($postData, $fileData) {
    $errors = [];
    $values = [];

    // Sanitize and validate inputs
    $values['full_name'] = trim($postData['full_name'] ?? '');
    if (empty($values['full_name'])) {
        $errors['full_name'] = "Full Name is required.";
    }

    $values['email'] = trim($postData['email'] ?? '');
    if (empty($values['email']) || !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Valid Email is required.";
    }

    $values['password'] = $postData['password'] ?? '';
    $values['confirm_password'] = $postData['confirm_password'] ?? '';
    if (empty($values['password'])) {
        $errors['password'] = "Password is required.";
    } elseif ($values['password'] !== $values['confirm_password']) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    // Validate profile picture
    $values['profile_picture'] = $fileData['profile_picture']['name'] ?? '';
    if (empty($values['profile_picture'])) {
        $errors['profile_picture'] = "Profile Picture is required.";
    } elseif (!in_array($fileData['profile_picture']['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
        $errors['profile_picture'] = "Only JPEG, PNG, and GIF images are allowed.";
    } elseif ($fileData['profile_picture']['size'] > 2 * 1024 * 1024) { // 2MB limit
        $errors['profile_picture'] = "Profile Picture must be less than 2MB.";
    }

    $values['phone'] = trim($postData['phone'] ?? '');
    if (empty($values['phone']) || !preg_match('/^\d{10}$/', $values['phone'])) {
        $errors['phone'] = "Valid 10-digit Phone Number is required.";
    }

    $values['dob'] = $postData['dob'] ?? '';
    if (empty($values['dob'])) {
        $errors['dob'] = "Date of Birth is required.";
    }

    $values['skills'] = $postData['skills'] ?? [];
    if (empty($values['skills']) || !is_array($values['skills'])) {
        $errors['skills'] = "Please select at least one skill.";
    }

    // Validate portfolio
    $values['portfolio'] = $fileData['portfolio']['name'] ?? '';
    if (empty($values['portfolio'])) {
        $errors['portfolio'] = "Portfolio is required.";
    } elseif ($fileData['portfolio']['size'] > 5 * 1024 * 1024) { // 5MB limit
        $errors['portfolio'] = "Portfolio must be less than 5MB.";
    }

    $values['hours'] = $postData['hours'] ?? '';
    if (empty($values['hours']) || $values['hours'] < 1 || $values['hours'] > 168) {
        $errors['hours'] = "Hours must be between 1 and 168.";
    }

    $values['payment'] = $postData['payment'] ?? '';
    if (empty($values['payment'])) {
        $errors['payment'] = "Please select a payment method.";
    }

    $values['about_you'] = trim($postData['about_you'] ?? '');
    if (empty($values['about_you'])) {
        $errors['about_you'] = "Please provide information about yourself.";
    }

    $values['terms'] = $postData['terms'] ?? '';
    if (empty($values['terms'])) {
        $errors['terms'] = "You must agree to the terms and conditions.";
    }

    return ['errors' => $errors, 'values' => $values];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = validateSellerForm($_POST, $_FILES);
    if (!empty($result['errors'])) {
        header('Content-Type: application/json');
        echo json_encode(['errors' => $result['errors']]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }
    exit;
}
?>
