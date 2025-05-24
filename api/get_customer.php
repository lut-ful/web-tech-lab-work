<?php
header('Content-Type: application/json');
require_once '../db/db.php';

try {
    $stmt = $conn->prepare("SELECT id, name, email, phone, created_at FROM customers ORDER BY id DESC");
    $stmt->execute();

    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'data' => $customers]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
