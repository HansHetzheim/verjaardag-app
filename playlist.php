<?php
include 'config.php';

// Create connection------------------------------------------------------------
$conn = new mysqli($servername, $username, $password);

// Check connection-------------------------------------------------------------
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

$name = $conn->real_escape_string($_POST['username']);
$mail = $conn->real_escape_string($_POST['email']);

// Create database if needed----------------------------------------------------
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
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
  reg_date TIMESTAMP)";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

//Connect to relevant database--------------------------------------------------
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
   die("Connection to database failed: " . $conn->connect_error);
}
echo "Connected successfully to database " . $dbname . "<br>";


//check of email al bestaat
$stmt = $conn->prepare("SELECT * FROM $tableName WHERE email = ?");
$stmt->bind_param("s", $mail);
$stmt->execute();
$result = $stmt->get_result();

// check of een ingevoerde email al in de database staat------------------------
if ($result->num_rows > 0) { //zoja: laad de eerder ingegeven data of update de data indien nodig
    // put the record in vars
    $stmt = $conn->prepare("SELECT * FROM $tableName WHERE email = ?");
    $stmt->bind_param("s", $mail);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
       $artist1 = $row["artist1"];
       $songName1 = $row["songTitle1"];
       $artist2 = $row["artist2"];
       $songName2 = $row["songTitle2"];
       $artist3 = $row["artist3"];
       $songName3 = $row["songTitle3"];
     }
 } else { //zo niet(er is een nieuw email in login.php gepost): initialiseer de data in mysql (maak een record)
  $artist1 = "";
  $songName1 = "";
  $artist2 = "";
  $songName2 = "";
  $artist3 = "";
  $songName3 = "";
  // Add row------------------------------------------------------------------
  $stmt = $conn->prepare("INSERT INTO $tableName (username, email, artist1, songTitle1, artist2, songTitle2, artist3, songTitle3)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssss", $name, $mail, $artist1, $songName1, $artist2, $songName2, $artist3, $songName3);
  $stmt->execute();
  if ($conn->query($sql) === TRUE) {
      $last_id = $conn->insert_id;
      echo "Row created successfully<br>Last inserted ID is: " . $last_id . "<br>";
  } else {
      echo "Error creating row: " . $conn->error;
  }
}

function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Big Test Playlist</title>
  </head>
  <body>

    <form id='register' action='succes.php' method='post' accept-charset='UTF-8'>
      <fieldset >
      <legend>Your playlist</legend>
      <label for='username' >Your UserName*:</label>
      <input type='text' name='username' id='username' maxlength="50" value="<?php echo $name; ?>" readonly="readonly"/>
      <label for='email' >Your Email Address*:</label>
      <input type='text' name='email' id='email' maxlength="50" value="<?php echo $mail; ?>" readonly="readonly"/>

      <label for='artist1' >Artist (1)*:</label>
      <input type='text' name='artist1' id='artist1' maxlength="50" value="<?php echo $artist1; ?>"/>
      <label for='songName1' >Song Name*:</label>
      <input type='text' name='songName1' id='songName1' maxlength="50"  value="<?php echo $songName1; ?>"/>

      <label for='artist2' >Artist (2)*:</label>
      <input type='text' name='artist2' id='artist2' maxlength="50"  value="<?php echo $artist2; ?>"/>
      <label for='songName2' >Song Name (2)*:</label>
      <input type='text' name='songName2' id='songName2' maxlength="50"  value="<?php echo $songName2; ?>"/>

      <label for='artist3' >Artist (3)*:</label>
      <input type='text' name='artist3' id='artist3' maxlength="50"  value="<?php echo $artist3; ?>"/>
      <label for='songName' >Song Name (3)*:</label>
      <input type='text' name='songName3' id='songName3' maxlength="50"  value="<?php echo $songName3; ?>"/>

      <input type='submit' name='Submit' value='Submit' />

      </fieldset>
    </form>

  </body>
</html>
