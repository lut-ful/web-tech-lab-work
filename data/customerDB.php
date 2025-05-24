<?php
function getConnection() {
    $host = "localhost";
    $dbname = "your_database";
    $username = "your_username";
    $password = "your_password";

    try {
        return new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
?>
