<?php
// Enable full error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Your DB credentials - adjust as needed
$host = '127.0.0.1';      // Try 'localhost' or '127.0.0.1'
$user = 'root';           // Your DB username
$pass = '';               // Your DB password
$dbname = 'webtech_project'; // Your database name

echo "<h2>Database Connection Debug</h2>";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    echo "<p style='color:red;'><strong>Connection failed:</strong> " . htmlspecialchars($conn->connect_error) . "</p>";
} else {
    echo "<p style='color:green;'><strong>Success!</strong> Connected to database: " . htmlspecialchars($dbname) . "</p>";
    
    // Optional: Show server info
    echo "<p>Server info: " . htmlspecialchars($conn->server_info) . "</p>";
    
    // Optional: Check character set
    echo "<p>Charset: " . htmlspecialchars($conn->character_set_name()) . "</p>";
    
    // Close connection after test
    $conn->close();
}
?>
