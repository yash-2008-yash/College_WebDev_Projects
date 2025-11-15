<?php
$servername = 'localhost';  // Your database server
$username = 'root';  // Your database username
$password = '';  // Your database password
$database_name = 'test';  // Your database name

// Create a connection
$connection = new mysqli($servername, $username, $password, $database_name);

// Check the connection
if ($connection->connect_error) {
    die('Connection failed! : ' . $connection->connect_error);
}

// Check if the form data is submitted or not
if ($_SERVER['REQUEST_METHOD'] == 'post') {
    // Get the form data
    $name = $_POST['name'];
    $rollno = $_POST['rollno'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];

    // Prepare and bind the SQL statement using prepared statements for security
    $stmt = $connection->prepare('INSERT INTO table(name,rollno,age,phone) VALUES (?,?,?,?)');
    $stmt->blind_param('siii', $name, $rollno, $age, $phone);  // "siii" for string-integer-integer-integer

    // Execute the statement
    if ($stmt->execute()) {
        echo 'New Record created successfully!';
    } else {
        echo 'Error: ' . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$connection->close();
?>