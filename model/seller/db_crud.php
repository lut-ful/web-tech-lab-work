<?php
// CRUD functions for seller (userDetails table) using procedural MySQLi and raw SQL

$DBhostname = "localhost";
$DBusername = "root";
$DBpassword = "";
$DBname = "WebTechUsers";

// Create connection
$conn = mysqli_connect($DBhostname, $DBusername, $DBpassword, $DBname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// CREATE: Add new seller
function createSeller($data, $conn): bool|mysqli_result {
    $full_name = mysqli_real_escape_string($conn, $data['full_name']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $password = mysqli_real_escape_string($conn, $data['password']);
    $profile_picture = mysqli_real_escape_string($conn, $data['profile_picture']);
    $phone = mysqli_real_escape_string($conn, $data['phone']);
    $dob = mysqli_real_escape_string($conn, $data['dob']);
    // Convert skills array to comma-separated string
    $skills = isset($data['skills']) && is_array($data['skills']) ? mysqli_real_escape_string($conn, implode(',', $data['skills'])) : '';
    $portfolio = mysqli_real_escape_string($conn, $data['portfolio']);
    $hours = intval($data['hours']);
    $payment = mysqli_real_escape_string($conn, $data['payment']);
    $about_you = mysqli_real_escape_string($conn, $data['about_you']);
    $terms = isset($data['terms']) ? intval($data['terms']) : 0;

    $sql = "INSERT INTO userDetails (full_name, email, password, profile_picture, phone, dob, skills, portfolio, hours, payment, about_you, terms)
            VALUES ('$full_name', '$email', '$password', '$profile_picture', '$phone', '$dob', '$skills', '$portfolio', $hours, '$payment', '$about_you', '$terms')";
    $result = mysqli_query($conn, $sql);
    if (!$result) error_log("Create Seller Error: " . mysqli_error($conn));
    return $result;
}

// READ: Get all sellers
function getAllSellers($conn) {
    $sql = "SELECT * FROM userDetails";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        error_log("Read Sellers Error: " . mysqli_error($conn));
        return [];
    }
    $sellers = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $sellers[] = $row;
    }
    return $sellers;
}

// READ: Get seller by email (Primary Key)
function getSellerByEmail($email, $conn): array|bool|null {
    $email = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT * FROM userDetails WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows(result: $result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}

// UPDATE: Update seller by email
function updateSeller($email, $data, $conn) {
    $email = mysqli_real_escape_string($conn, $email);
    $full_name = mysqli_real_escape_string($conn, $data['full_name']);
    $phone = mysqli_real_escape_string($conn, $data['phone']);
    $dob = mysqli_real_escape_string($conn, $data['dob']);
    $skills = mysqli_real_escape_string($conn, $data['skills']);
    $hours = intval($data['hours']);
    $payment = mysqli_real_escape_string($conn, $data['payment']);
    $about_you = mysqli_real_escape_string($conn, $data['about_you']);
    $profile_picture = mysqli_real_escape_string($conn, $data['profile_picture']);
    $portfolio = mysqli_real_escape_string($conn, $data['portfolio']);

    $sql = "UPDATE userDetails SET 
                full_name='$full_name', 
                phone='$phone', 
                dob='$dob', 
                skills='$skills', 
                hours=$hours, 
                payment='$payment', 
                about_you='$about_you',
                profile_picture='$profile_picture',
                portfolio='$portfolio'
            WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (!$result) error_log("Update Seller Error: " . mysqli_error($conn));
    return $result;
}

// DELETE: Delete seller by email
function deleteSeller($email, $conn) {
    $email = mysqli_real_escape_string($conn, $email);
    $sql = "DELETE FROM userDetails WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (!$result) error_log("Delete Seller Error: " . mysqli_error($conn));
    return $result;
}

// ...close connection elsewhere as needed...
?>
