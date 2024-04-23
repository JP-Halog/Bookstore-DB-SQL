<?php
$servername = "sysmysql8.auburn.edu"; // or your server's IP
$username = "jdh0102";
$password = "Megabotx#1";
$dbname = "jdh0102db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Path to the .csv file
$csvFile = 'db_book.csv';

// Open the .csv file
$fileHandle = fopen($csvFile, 'r');

// Get the first line and determine the number of fields
$firstLine = fgetcsv($fileHandle);
$numFields = count($firstLine);

// Create a table with the same number of fields
$sql = "CREATE TABLE IF NOT EXISTS db_book (";
for ($i = 0; $i < $numFields; $i++) {
  $sql .= "field$i VARCHAR(255), ";
}
$sql = rtrim($sql, ', ') . ")";
if ($conn->query($sql) === TRUE) {
  echo "Table created successfully\n";
} else {
  echo "Error creating table: " . $conn->error;
}

// Insert data from the .csv file into the table
while (($line = fgetcsv($fileHandle)) !== FALSE) {
  $values = "'" . implode("', '", $line) . "'";
  $sql = "INSERT INTO your_table_name VALUES ($values)";
  if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully\n";
  } else {
    echo "Error inserting record: " . $conn->error;
  }
}

// Close the .csv file
fclose($fileHandle);

// Close connection
$conn->close();
?>
