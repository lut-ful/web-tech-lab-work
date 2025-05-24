<?php
header("Content-Type: application/json");
require_once("../data/customerDB.php");

// Basic input validation
$requiredFields = ['full_name', 'email', 'password'];

foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(["success" => false, "message" => "Missing field: $field"]);
        exit;
    }
}

$fullName = trim($_POST['full_name']);
$email = trim($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Example: more fields could be added similarly
$phone = $_POST['phone'] ?? '';
$dob = $_POST['dob'] ?? '';

$conn = getConnection();
$sql = "INSERT INTO customers (full_name, email, password, phone, dob) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt->execute([$fullName, $email, $password, $phone, $dob])) {
    echo json_encode(["success" => true, "message" => "Customer added successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Database error"]);
}
?>
