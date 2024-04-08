<?php
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

// SQL query to select class information with professor and student details
$sql = "SELECT 
            c.class_name AS CLASS,
            p.last_name AS PROFESSOR_LAST_NAME,
            s.last_name AS STUDENT_LAST_NAME,
            s.first_name AS STUDENT_FIRST_NAME,
            s.email AS STUDENT_EMAIL,
            c.class_date AS DATE
        FROM 
            classes c
        JOIN 
            professors p ON c.professor_id = p.professor_id
        JOIN 
            students s ON c.student_id = s.student_id";

// Execute the query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Class: " . $row["CLASS"]. " - Professor: " . $row["PROFESSOR_LAST_NAME"]. " - Student: " . $row["STUDENT_LAST_NAME"]. ", " . $row["STUDENT_FIRST_NAME"]. " - Email: " . $row["STUDENT_EMAIL"]. " - Date: " . $row["DATE"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>