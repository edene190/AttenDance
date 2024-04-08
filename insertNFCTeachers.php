<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Check if all required parameters are provided
if(isset($_GET['nfcid'], $_GET['fname'], $_GET['lname'], $_GET['email'])) {
    // Database connection parameters
    $servername = "localhost";
    $username = "website";
    $password = "website";
    $database = "attendance"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert professor
    $sql = "INSERT INTO professors (nfcid, first_name, last_name, email) VALUES (?, ?, ?, ?)";
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $_GET['nfcid'], $_GET['fname'], $_GET['lname'], $_GET['email']);
    
    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Professor inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If any required parameter is missing, display an error message
    echo "Error: All parameters (nfcid, first_name, last_name, email) are required.";
}
?>