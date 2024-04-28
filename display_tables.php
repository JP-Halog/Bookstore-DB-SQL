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
$tables_result = $conn->query($sql);

if ($tables_result->num_rows > 0) {
    // Loop through each table
    while($table_row = $tables_result->fetch_assoc()) {
        $table_name = $table_row['Tables_in_' . $dbname];
        echo "<h2>Table: $table_name</h2>";
        
        // Get table content
        $content_sql = "SELECT * FROM $table_name";
        $content_result = $conn->query($content_sql);

        if ($content_result->num_rows > 0) {
            // Start a table
            echo "<table border='1'>";
            
            // Output headers
            $fields = $content_result->fetch_fields();
            echo "<tr>";
            foreach ($fields as $field) {
                echo "<th>" . $field->name . "</th>";
            }
            echo "</tr>";
            
            // Output data of each row
            while($row = $content_result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $cell) {
                    echo "<td>" . $cell . "</td>";
                }
                echo "</tr>";
            }
            
            // End the table
            echo "</table>";
        } else {
            echo "Table is empty";
        }
        
        // Add some space between tables
        echo "<br>";
    }
} else {
    echo "No tables found";
}

// Close connection
$conn->close();
?>
