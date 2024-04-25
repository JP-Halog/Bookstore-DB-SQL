<?php
$servername = "sysmysql8.auburn.edu"; // or your server's IP
$username = "jdh0102";
$password = "Megabotx#1";
$dbname = "jdh0102db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Path to the .csv file
$csvFile = 'db_supplier.csv';

// Open the .csv file
$fileHandle = fopen($csvFile, 'r');

// Get the first line and use it as the column names
$columnNames = fgetcsv($fileHandle);

// Create a table with the same number of fields
$sql = "CREATE TABLE IF NOT EXISTS db_supplier (";
foreach ($columnNames as $columnName) {
  $sql .= "$columnName VARCHAR(255), ";
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
  $sql = "INSERT INTO db_supplier VALUES ($values)";
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
