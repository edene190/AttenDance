<?php
session_start(); // Start the session

$nfcId = $_GET['id']; // Get the NFC ID from the URL parameter
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
$sql = "SELECT * FROM professors WHERE nfcid='$nfcId'";

// Execute SQL query
$result = $conn->query($sql);

// Check if the NFC ID exists in the database
if ($result->num_rows > 0) {
    // Fetch result as associative array
    $row = $result->fetch_assoc();
    $_SESSION['professor_id'] = $row['professor_id'];
    echo json_encode(['exists' => true, 'professor' => $row['professor_id']]);
} else {
    echo json_encode(['exists' => false]);
}

// Close database connection
$conn->close();
?>