<?php
// Database connection parameters
$servername = "localhost"; // Your database server
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "REGISTRATION"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize input
    $first_name = $conn->real_escape_string($_POST['first-name']);
    $last_name = $conn->real_escape_string($_POST['last-name']);
    $user_id = $conn->real_escape_string($_POST['user-id']);
    $mobile_number = $conn->real_escape_string($_POST['mobile-number']);
    $vehicle_number = $conn->real_escape_string($_POST['vehicle-number']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

    // Prepare SQL query to insert data into the database
    $sql = "INSERT INTO USERS (first_name, last_name, user_id, mobile_no, vehicle_no, create_password)
            VALUES ('$first_name', '$last_name', '$user_id', '$mobile_number', '$vehicle_number', '$password')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
