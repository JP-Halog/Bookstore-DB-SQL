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

// Get the submitted query
$query = $_POST["query"];

// Check if the query is a DROP statement
if (stripos($query, "DROP") !== false) {
  echo "DROP statements are not allowed.";
} else {
  // Execute the query
  if ($result = $conn->query($query)) {
    if ($result->num_rows > 0) {
      // Start a table
      echo "<table>";
      
      // Output headers
      $fields = $result->fetch_fields();
      echo "<tr>";
      foreach ($fields as $field) {
        echo "<th>| " . $field->name . "</th>";
      }
      echo "</tr>";
      
      // Output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $cell) {
          echo "<td>| " . $cell . "</td>";
        }
        echo "</tr>";
      }
      
      // End the table
      echo "</table>";
      
      echo "Number of rows retrieved: " . $result->num_rows;
    } else {
      echo "Table created/updated. Rows affected: " . $conn->affected_rows;
    }
  } else {
    echo "Error executing query: " . $conn->error;
  }
}

// Close connection
$conn->close();
?>