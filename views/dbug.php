<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = '127.0.0.1';      
$user = 'root';           
$pass = '';               
$dbname = 'webtech_project'; 

echo "<h2>Database Connection Debug</h2>";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    echo "<p style='color:red;'><strong>Connection failed:</strong> " . htmlspecialchars($conn->connect_error) . "</p>";
} else {
    echo "<p style='color:green;'><strong>Success!</strong> Connected to database: " . htmlspecialchars($dbname) . "</p>";
    
    echo "<p>Server info: " . htmlspecialchars($conn->server_info) . "</p>";
    
    echo "<p>Charset: " . htmlspecialchars($conn->character_set_name()) . "</p>";
    
    $conn->close();
}
?>
