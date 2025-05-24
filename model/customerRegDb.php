<?php
class mydb {
    private $DBHostName = "localhost";
    private $DBUserName = "root";
    private $DBPassword = "";
    private $DBName     = "webtech_project";
    private $tableName  = "customers"; 

    public function createConObject() {
        $conn = new mysqli(
            $this->DBHostName,
            $this->DBUserName,
            $this->DBPassword,
            $this->DBName
        );
        if ($conn->connect_error) {
            throw new Exception("DB connect failed: " . $conn->connect_error);
        }
        $conn->set_charset('utf8mb4');  // Set UTF-8 charset for connection
        return $conn;
    }

    public function registerCustomer($conn, $full_name, $email, $password_hash, $phone, $username, $profile_picture_path, $payment) {
        try {
            // 1) Check for duplicate email
            $sqlCheck = "SELECT email FROM `{$this->tableName}` WHERE email = ?";
            $check = $conn->prepare($sqlCheck);
            if (!$check) {
                throw new Exception("Prepare failed (check): " . $conn->error);
            }
            $check->bind_param("s", $email);
            $check->execute();
            $check->store_result();
            if ($check->num_rows > 0) {
                $check->close();
                return ["success" => false, "message" => "Email already registered."];
            }
            $check->close();

            // 2) Insert new customer
            $sqlInsert = "INSERT INTO `{$this->tableName}` 
                (full_name, email, password, phone, username, profile_picture, payment) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sqlInsert);
            if (!$stmt) {
                throw new Exception("Prepare failed (insert): " . $conn->error);
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

            $execResult = $stmt->execute();
            if (!$execResult) {
                $stmt->close();
                return ["success" => false, "message" => "Insert failed: " . $stmt->error];
            }
            $stmt->close();

            return ["success" => true];

        } catch (Exception $e) {
            return ["success" => false, "message" => "Exception: " . $e->getMessage()];
        }
    }
}
?>
