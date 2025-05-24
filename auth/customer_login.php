<?php
session_start();
require_once("../model/customerRegDb.php"); // make sure this file contains your mydb class

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($email) || empty($password)) {
    echo json_encode(["success" => false, "message" => "Email and password are required"]);
    exit;
}

try {
    $db = new mydb();
    $conn = $db->createConObject();

    $sql = "SELECT id, full_name, email, password FROM customers WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['customer_id'] = $user['id'];
            $_SESSION['customer_name'] = $user['full_name']; // use full_name field as name
            echo json_encode(["success" => true, "message" => "Login successful"]);
            exit;
        }
    }

    // If no user or password does not match:
    echo json_encode(["success" => false, "message" => "Invalid email or password"]);

} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Server error: " . $e->getMessage()]);
}
