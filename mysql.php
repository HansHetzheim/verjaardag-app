<?php
include 'config.php';
// Create connection------------------------------------------------------------
$conn = new mysqli($servername, $username, $password);

// Check connection-------------------------------------------------------------
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

// Create database if needed----------------------------------------------------
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    // echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}
//Connect to relevant database--------------------------------------------------
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
   die("Connection to database failed: " . $conn->connect_error);
}
//Create table if needed--------------------------------------------------------
$sql = "CREATE TABLE IF NOT EXISTS $tableName(
  id INTEGER(6) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL UNIQUE,
  artist1 VARCHAR(30),
  songTitle1 VARCHAR(30),
  artist2 VARCHAR(30),
  songTitle2 VARCHAR(30),
  artist3 VARCHAR(30),
  songTitle3 VARCHAR(30),
  message VARCHAR(255),
  reg_date TIMESTAMP)";
if ($conn->query($sql) === TRUE) {
    // echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}
?>
