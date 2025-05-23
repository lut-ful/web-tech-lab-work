<?php

session_start();

if (!isset($_SESSION['user'])) {
    echo "Access denied. Please log in first.";
    exit();
}

$user = $_SESSION['user'];
$isEditing = isset($_GET['edit']) && $_GET['edit'] == '1';

// Handle validation errors and retain values
$errors = $_SESSION['edit_errors'] ?? [];
$values = $_SESSION['edit_values'] ?? [];
unset($_SESSION['edit_errors'], $_SESSION['edit_values']);

function displayError($field, $errors)
{
    return isset($errors[$field]) ? "<div style='color: red;'>{$errors[$field]}</div>" : '';
}
function retainValue($field, $values, $user)
{
    return htmlspecialchars($values[$field] ?? $user[$field] ?? '');
}
function retainChecked($field, $value, $values, $user)
{
    $current = $values[$field] ?? $user[$field] ?? '';
    return $current === $value ? 'checked' : '';
}
function retainSelected($field, $value, $values, $user)
{
    $current = $values[$field] ?? $user[$field] ?? [];
    if (!is_array($current))
        $current = explode(',', $current);
    return in_array($value, $current) ? 'selected' : '';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Freelancer Dashboard</title>
    <?php if ($isEditing): ?>
        <link rel="stylesheet" type="text/css" href="css/seller_reg.css">
    <?php else: ?>
        <link rel="stylesheet" type="text/css" href="css/profile_view.css">
    <?php endif; ?>
</head>
<body>
    <div class="dashboard">
        <h2>Welcome, <?= htmlspecialchars($user['full_name']) ?>!</h2>
        <?php
        // Make variables available in included files
        $GLOBALS['user'] = $user;
        $GLOBALS['errors'] = $errors;
        $GLOBALS['values'] = $values;
        if ($isEditing) {
            include 'edit_form.php';
        } else {
            include 'profile_view.php';
        }
        ?>
        <div style="text-align:center;margin-top:24px;">
            <a href="logout.php" class="crud-btn cancel-btn">Logout</a>
        </div>
    </div>
</body>
</html>