<?php
$servername = "sysmysql8.auburn.edu";
$username = "jdh0102";
$password = "Megabotx#1";
$dbname = "jdh0102db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get list of tables
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start a table
    echo "<table border='1'>";
    echo "<tr><th>Table Name</th></tr>";

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['Tables_in_' . $dbname] . "</td></tr>";
    }
    
    // End the table
    echo "</table>";
} else {
    echo "No tables found";
}

// Close connection
$conn->close();
?>