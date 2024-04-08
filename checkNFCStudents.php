<?php
session_start(); // Start the session

// Get the NFC ID from the URL parameter
$nfcId = $_GET['id']; 
error_log("Received NFC ID: " . $_GET['id']);

// Database connection parameters
$servername = "localhost";
$username = "website";
$password = "website";
$database = "attendance"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement
$sql = "SELECT * FROM students WHERE nfcid='$nfcId'";

// Execute SQL query
$result = $conn->query($sql);

// Check if the NFC ID exists in the database
if ($result->num_rows > 0) {
    // Fetch result as associative array
    $row = $result->fetch_assoc();
    $_SESSION['student_id'] = $row['student_id'];
    echo json_encode(['exists' => true, 'student' => $row['student_id']]);
} else {
    echo json_encode(['exists' => false]);
}

// Close database connection
$conn->close();
?>