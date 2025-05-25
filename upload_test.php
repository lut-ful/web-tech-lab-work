<?php
// This file helps test if the uploads directory is correctly configured
// Put this at the root of your web project

echo "<h1>Upload Directory Test</h1>";

$uploadDir = "uploads/";

// Directory existence check
echo "<h3>Directory Check:</h3>";
if (is_dir($uploadDir)) {
    echo "<p style='color:green'>✓ The upload directory exists at: " . realpath($uploadDir) . "</p>";
} else {
    echo "<p style='color:red'>✗ Upload directory does not exist at: " . realpath(dirname(__FILE__) . "/" . $uploadDir) . "</p>";
    echo "<p>Trying to create it...</p>";
    if (mkdir($uploadDir, 0777, true)) {
        echo "<p style='color:green'>✓ Successfully created directory</p>";
    } else {
        echo "<p style='color:red'>✗ Failed to create directory</p>";
    }
}

// Permission check
echo "<h3>Permission Check:</h3>";
if (is_writable($uploadDir)) {
    echo "<p style='color:green'>✓ The upload directory is writable</p>";
} else {
    echo "<p style='color:red'>✗ Upload directory is NOT writable. Need to set permissions.</p>";
    echo "<p>You can try: <code>chmod -R 777 " . realpath($uploadDir) . "</code></p>";
}

// Test file creation
echo "<h3>Test File Creation:</h3>";
$testFile = $uploadDir . "test_" . time() . ".txt";
if (file_put_contents($testFile, "Test content")) {
    echo "<p style='color:green'>✓ Successfully created test file at: " . realpath($testFile) . "</p>";
    unlink($testFile);
    echo "<p style='color:green'>✓ Successfully deleted test file</p>";
} else {
    echo "<p style='color:red'>✗ Failed to create test file</p>";
}

// Show full server path for reference
echo "<h3>Server Path Information:</h3>";
echo "<p>Server document root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p>Current script path: " . __FILE__ . "</p>";
echo "<p>Recommended absolute path to uploads: " . realpath(dirname(__FILE__) . "/" . $uploadDir) . "</p>";

// Configuration suggestions
echo "<h3>Configuration Suggestions:</h3>";
echo "<pre>
// For registration process
\$uploadDir = '../../uploads/'; // Relative from control/seller/reg_process.php

// For profile viewing
&lt;img src=\"../../uploads/<?= htmlspecialchars(\$user['profile_picture']) ?>\" alt=\"Profile Picture\">

// For direct access from web root
&lt;img src=\"/web-tech-lab/uploads/<?= htmlspecialchars(\$user['profile_picture']) ?>\" alt=\"Profile Picture\">
</pre>";
?>
