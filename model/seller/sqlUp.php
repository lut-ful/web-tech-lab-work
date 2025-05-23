<?php
$DBhostname = "localhost";
$DBusername = "root";
$DBpassword = "";
$DBname = "WebTechUsers";

// Create connection
$conn = mysqli_connect($DBhostname, $DBusername, $DBpassword, $DBname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password_raw = $_POST['password'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $hours = isset($_POST['hours']) ? (int)$_POST['hours'] : 'NULL';
    $payment = $_POST['payment'] ?? '';
    $about_you = $_POST['about_you'] ?? '';
    $terms = isset($_POST['terms']) ? 1 : 0;

    // Skills handling
    $skills = '';
    if (!empty($_POST['skills']) && is_array($_POST['skills'])) {
        $skills = implode(',', $_POST['skills']);
    }

    // // Hash password
    // $password = password_hash($password_raw, PASSWORD_DEFAULT);

    // Handle file uploads
    $profile_picture_path = "NULL";
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/profile_pictures/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        $profile_picture_path = $upload_dir . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture_path);
        $profile_picture_path = "'$profile_picture_path'";
    } else {
        $profile_picture_path = "NULL";
    }

    $portfolio_path = "NULL";
    if (isset($_FILES['portfolio']) && $_FILES['portfolio']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/portfolios/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        $portfolio_path = $upload_dir . basename($_FILES['portfolio']['name']);
        move_uploaded_file($_FILES['portfolio']['tmp_name'], $portfolio_path);
        $portfolio_path = "'$portfolio_path'";
    } else {
        $portfolio_path = "NULL";
    }

    // Escape strings for query safety
    $full_name = "'".mysqli_real_escape_string($conn, $full_name)."'";
    $email = "'".mysqli_real_escape_string($conn, $email)."'";
    $password = "'".mysqli_real_escape_string($conn, $password)."'";
    $phone = "'".mysqli_real_escape_string($conn, $phone)."'";
    $dob = "'".mysqli_real_escape_string($conn, $dob)."'";
    $skills = "'".mysqli_real_escape_string($conn, $skills)."'";
    $payment = "'".mysqli_real_escape_string($conn, $payment)."'";
    $about_you = "'".mysqli_real_escape_string($conn, $about_you)."'";

    // Build SQL query string
    $sql = "INSERT INTO userDetails
        (full_name, email, password, profile_picture, phone, dob, skills, portfolio, hours, payment, about_you, terms)
        VALUES ($full_name, $email, $password, $profile_picture_path, $phone, $dob, $skills, $portfolio_path, $hours, $payment, $about_you, $terms)";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
