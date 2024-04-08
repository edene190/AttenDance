<?php
if (isset($_GET['name']) && isset($_GET['email']) && isset($_GET['id'])) {
    $name = $_GET['name'];
    $email = $_GET['email'];
    $nfcId = $_GET['id'];
// Open SQLite3 database
$db = new SQLite3('attendance.db'); // Replace 'students.db' with your database file name

// Query the database
$insertQuery("INSERT INTO students (nfc_id, student_name, student_email) VALUES ('$nfcId', '$name', '$email');
$insertResult = $db->exec($insertQuery);

if ($insertResult) {
    $response = ['success' => true, 'message' => 'Student added successfully'];
} else {
    $response = ['success' => false, 'message' => 'Error adding student: ' . $db->lastErrorMsg()];
}

// Close the database connection
$db->close();
?>