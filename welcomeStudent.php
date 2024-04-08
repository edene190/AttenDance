<?php
session_start(); // Start or resume a session

// Check if the form has been submitted and the selected class is set
if(isset($_POST['selectedClass'])) {
    // Store the selected class in a session variable
    $_SESSION['selectedClass'] = $_POST['selectedClass'];
}

// Redirect the user to the welcome student page
header('Location: welcomeStudent.html');
exit(); // Make sure no other code is executed after the redirect
?>