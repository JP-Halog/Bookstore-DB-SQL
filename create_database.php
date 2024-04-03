<?php
$servername = "sysmysql8.auburn.edu";
$username = "username";
$password = "password";
$dbname = "test_table";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully\n";
} else {
  echo "Error creating database: " . $conn->error;
}

// Select database
$conn->select_db($dbname);

// SQL to create tables
$sql = file_get_contents("schema.sql");

// Execute SQL to create tables
if ($conn->multi_query($sql) === TRUE) {
  echo "Tables created successfully\n";
} else {
  echo "Error creating tables: " . $conn->error;
}

// Close connection
$conn->close();
?>