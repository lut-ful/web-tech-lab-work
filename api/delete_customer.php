<?php
header("Content-Type: application/json");
require_once("../data/customerDB.php");

if (!isset($_GET['id'])) {
    echo json_encode(["success" => false, "message" => "Missing customer ID"]);
    exit;
}

$id = intval($_GET['id']);
$conn = getConnection();
$sql = "DELETE FROM customers WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt->execute([$id])) {
    echo json_encode(["success" => true, "message" => "Customer deleted"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to delete customer"]);
}
?>
