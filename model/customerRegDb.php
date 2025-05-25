<?php
class mydb {
    private $DBHostName;
    private $DBUserName;
    private $DBPassword;
    private $DBName;

    function __construct() {
        $this->DBHostName = "localhost";
        $this->DBUserName = "root";
        $this->DBPassword = "";
        $this->DBName = "customerdb"; 
    }

    function createConObject() {
        return new mysqli(
            $this->DBHostName,
            $this->DBUserName,
            $this->DBPassword,
            $this->DBName
        );
    }

    function registerCustomer($conn, $table, $full_name, $email, $password_hash, $phone, $username, $profile_picture_path, $payment) {
        $stmt = $conn->prepare(
            "INSERT INTO $table 
            (FullName, Email, PasswordHash, PhoneNumber, Username, ProfilePicturePath, PreferredPaymentMethod) 
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        if (!$stmt) {
            return $conn->error;
        }
        $stmt->bind_param(
            "sssssss",
            $full_name,
            $email,
            $password_hash,
            $phone,
            $username,
            $profile_picture_path,
            $payment
        );

        $exec = $stmt->execute();
        if (!$exec) {
            return $stmt->error;
        }
        $stmt->close();
        return true;
    }

    function closeCon($conn) {
        $conn->close();
    }
}
?>
