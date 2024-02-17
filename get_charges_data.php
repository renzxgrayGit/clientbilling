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

// Check if start and end dates are provided
if(isset($_POST['start']) && isset($_POST['start']))
{
    // Get start and end dates from POST request
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];

    // Fetch data from your charges table within the specified date range
    $sql = "SELECT month, year, total_cost FROM charges WHERE STR_TO_DATE(CONCAT(year, '-', month, '-01'), '%Y-%M-%d') BETWEEN ? AND ?"; // Adjust query according to your table structure
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    // Create an array to store the data
    $data = array();

    // Check if there are any rows returned
    if ($result->num_rows > 0) 
    {
        // Loop through each row and add it to the data array
        while($row = $result->fetch_assoc()) 
        {
            $data[] = $row;
        }
    }
}
else
{
    // Fetch all data from your charges table
    $sql = "SELECT month, year, total_cost FROM charges"; // Adjust query according to your table structure
    $result = $conn->query($sql);

    // Create an array to store the data
    $data = array();

    // Check if there are any rows returned
    if ($result->num_rows > 0) 
    {
        // Loop through each row and add it to the data array
        while($row = $result->fetch_assoc()) 
        {
            $data[] = $row;
        }
    }
}

// Close the connection
$conn->close();

// Set the content type to JSON
header('Content-Type: application/json');

// Output the data as JSON
echo json_encode($data);
?>
