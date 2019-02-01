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

function initRow($name, $mail){
  $artist1 = "";
  $songName1 = "";
  $artist2 = "";
  $songName2 = "";
  $artist3 = "";
  $songName3 = "";
  $message = "";
  // Add row------------------------------------------------------------------
  $stmt = $conn->prepare("INSERT INTO $tableName (username, email, artist1, songTitle1, artist2, songTitle2, artist3, songTitle3, message)
   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssssss", $name, $mail, $artist1, $songName1, $artist2, $songName2, $artist3, $songName3, $message);
  if ($stmt->execute()) {
     $last_id = $conn->insert_id;
     //echo "Row created successfully<br>Last inserted ID is: " . $last_id . "<br>";
  } else {
     echo "Error creating row: " . $conn->error;
  }
}
?>
