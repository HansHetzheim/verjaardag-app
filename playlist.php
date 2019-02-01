<?php
session_start();
include 'config.php';
$name = $_POST['username'];
$mail = $_POST['email'];
// echo "naam: ".$name."<br> mail: ".$mail."<br>";
// Create connection------------------------------------------------------------
$conn = new mysqli($servername, $username, $password);
// Check connection-------------------------------------------------------------
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully<br>";
$name = $conn->real_escape_string($_SESSION['user']);
$mail = $conn->real_escape_string($_SESSION['mailAddress']);
echo "LOOK HERE: ".$name;
if(!isset($_SESSION['user'])) {
   header('Location: http://localhost/finalBirthdayApp/login.php/');
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
// echo "Connected successfully to database " . $dbname . "<br>";
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
       $message = $row["message"];
     }
 } else { //zo niet(er is een nieuw email in login.php gepost): initialiseer de data in mysql (maak een record)
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
  $stmt->execute();
  if ($stmt->execute()) {
      $last_id = $conn->insert_id;
      echo "Row created successfully<br>Last inserted ID is: " . $last_id . "<br>";
  } else {
      echo "Error creating row: " . $conn->error;
  }
}
if(isset($_POST['logOut'])){
  unset($_SESSION['user']);
  unset($_SESSION['mailAddress']);
  session_destroy();
  header('Location: http://localhost/finalBirthdayApp/login.php/');
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

<!-- Start of HTML -->
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Aleo" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/master.css">
    <link rel="stylesheet" href="./assets/css/playlist.css">
    <title>Birthday Songs</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Deel je muziek smaak!</h1>
            <h2>Geef hieronder je drie favoriete nummers door</h2>
        </div>

        <div class="fields">
            <form id='register' action='/finalBirthdayApp/succes.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                    <legend>Jouw playlist</legend>
                    <label for='artist1'>Artist (1)*:</label>
                    <input type='text' name='artist1' id='artist1' maxlength="50" value="<?php echo $artist1; ?>" />
                    <label for='songName1'>Eerste Liedje*:</label>
                    <input type='text' name='songName1' id='songName1' maxlength="50" value="<?php echo $songName1; ?>" />

                    <label for='artist2'>Artiest*:</label>
                    <input type='text' name='artist2' id='artist2' maxlength="50" value="<?php echo $artist2; ?>" />
                    <label for='songName2'>Tweede Liedje*:</label>
                    <input type='text' name='songName2' id='songName2' maxlength="50" value="<?php echo $songName2; ?>" />

                    <label for='artist3'>Artiest*:</label>
                    <input type='text' name='artist3' id='artist3' maxlength="50" value="<?php echo $artist3; ?>" />
                    <label for='songName'>Derde Liedje*:</label>
                    <input type='text' name='songName3' id='songName3' maxlength="50" value="<?php echo $songName3; ?>" />

                    <label for='message'>Laat een leuk berichtje achter!*</label>
                    <textarea rows="5" cols="51" id="message" name="message" placeholder="Jouw persoonlijk berichtje voor Dirk.."><?php echo $message; ?></textarea>

                    <input type='submit' name='Submit' value='Opslaan' />
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <input type='submit' name='logOut' value="Log out" />
                    </form>
                </fieldset>
            </form>
        </div>
    </div>
    </div>
    </div>

</body>

</html>
<!-- End of HTML -->