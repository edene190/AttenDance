<?php
session_start();

if (isset($_GET['test'])) {
    echo json_encode(['test' => true]);
}

// Check if all required parameters are provided
if (isset($_GET['selectedClass'], $_GET['professorid'], $_GET['studentid'])) {
    // Retrieve session variables
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

    // Prepare SQL statement to insert class
    $sql = "INSERT INTO classes (class_name, professor_id, student_id) VALUES (?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $_SESSION['selectedClass'], $_SESSION['professor_id'], $_SESSION['student_id']);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo json_encode(['attended' => true]);
    } else {
        echo json_encode(['attended' => false, 'error' => $stmt->error, 'selectedClass' => $studentId]); // Output error message
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If any required parameter is missing, display an error message
    echo "Error: All parameters (class_name, professor_id, student_id) are required.";
}

?>