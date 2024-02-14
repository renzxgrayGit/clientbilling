<?php
// Connect to your database
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = "dikoalam1!Mysql"; // Replace with your database password
$dbname = "clientbilling"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from your charges table
$sql = "SELECT month, total_cost FROM charges"; // Adjust query according to your table structure
$result = $conn->query($sql);

// Create an array to store the data
$data = array();

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Loop through each row and add it to the data array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close the connection
$conn->close();

// Set the content type to JSON
header('Content-Type: application/json');

// Output the data as JSON
echo json_encode($data);
?>
