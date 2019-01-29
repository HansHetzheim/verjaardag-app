<?php
$servername = "localhost";
$username = "jessica";
$password = "admin";
$dbname = "birthdayplaylist";
$tableName = "guestPlaylist";
$mailPattern = '/^[\w][\w.]+[\w]@[\w.]+\.[\w]{2,4}$/i';
$doubleDot = "/\.{2,}/";

$name = $_POST['username'];
$mail = $_POST['email'];
echo "naam: ".$name."<br> mail: ".$mail."<br>";

// Create connection------------------------------------------------------------
$conn = new mysqli($servername, $username, $password);

// Check connection-------------------------------------------------------------
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

//Connect to relevant database--------------------------------------------------
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
   die("Connection to database failed: " . $conn->connect_error);
}
echo "Connected successfully to database " . $dbname . "<br>";


//check of email al bestaat
$sql = "SELECT * FROM $tableName WHERE email = '$mail'";
$result = $conn->query($sql);
//check
echo "email check: ";
print_r($result);
echo "<br>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       echo "id: " . $row["id"]. " - Name: " . $row["username"]. " " . $row["reg_date"]. $row["artist1"]. "<br>";
    }
} else {
    echo "0 results";
}

// check of een ingevoerde email al in de database staat------------------------
if ($result->num_rows > 0) { //zoja: laad de eerder ingegeven data of update de data indien nodig
  //als playlist.php in gePOST moet een update worden uitgevoerd
  if ($_POST['artist1'] != NUll) {
    //update record/row-----------------------------------------------------------
    echo "Email exists.<br>";
    $artist1 = $_POST['artist1'];
    $songName1 = $_POST['songName1'];
    $artist2 = $_POST['artist2'];
    $songName2 = $_POST['songName2'];
    $artist3 = $_POST['artist3'];
    $songName3 = $_POST['songName3'];
    $sql2 = "UPDATE $tableName
    SET artist1='$artist1',
    songTitle1='$songName1',
    artist2='$artist2',
    songTitle2='$songName2',
    artist3='$artist3',
    songTitle3='$songName3'
    WHERE email='$mail'";

    if ($conn->query($sql2) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error upadting record: " . $conn->error;
    }
  } else { //als login.php gePOST was moet enkel de vorige info opgehaald worden
    // put the record in vars
    echo "update check: ";
    print_r($result);
    echo "<br>";
    $sql = "SELECT * FROM $tableName WHERE email = '$mail'";//dit moet nog eens gebeuren, IK HEB GEEN IDEE WAAROM print_r($result); GEEFT HETZELFDE
    $result = $conn->query($sql);
    echo "update check: ";
    print_r($result);
    echo "<br>";
    while($row = $result->fetch_assoc()) {
      echo "hallo? <br>";
       $artist1 = $row["artist1"];
       echo $row["artist1"];
       $songName1 = $row["songTitle1"];
       $artist2 = $row["artist2"];
       $songName2 = $row["songTitle2"];
       $artist3 = $row["artist3"];
       $songName3 = $row["songTitle3"];
     }
  }
 } else { //zo niet(er is een nieuw email in login.php gepost): initialiseer de data in mysql (maak een record)
  $artist1 = "";
  $songName1 = "";
  $artist2 = "";
  $songName2 = "";
  $artist3 = "";
  $songName3 = "";
  // Add row------------------------------------------------------------------
  $sql = "INSERT INTO $tableName (username, email, artist1, songTitle1, artist2, songTitle2, artist3, songTitle3)
  VALUES ('$name', '$mail', '$artist1', '$songName1', '$artist2', '$songName2', '$artist3', '$songName3')";

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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Aleo" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Birthday Songs</title>
  </head>
  <body>
    
    <div class="container">
      <div class="header">
        <h1>Welkom!</h1>
        <h2>Geef hieronder je drie favoriete nummers door</h2>
      </div>

      <div class="splitscreen">
        <div class="photo">
          <img src="./img/dirk-nobg.png" alt="foto van dirk">
        </div>

        <div class="fields">
        <form id='register' action='playlist.php' method='post' accept-charset='UTF-8'>
      <fieldset >
      <legend>Jouw playlist</legend>
      <label for='username' >Jouw Username*:</label>
      <input type='text' name='username' id='username' maxlength="50" value="<?php echo $name; ?>" disabled/>
      <label for='email' >Jouw Email Adres*:</label>
      <input type='text' name='email' id='email' maxlength="50" value="<?php echo $mail; ?>" disabled/>

      <label for='artist1' >Artiest (1)*:</label>
      <input type='text' name='artist1' id='artist1' maxlength="50" value="<?php echo $artist1; ?>"/>
      <label for='songName1' >Naam van liedje*:</label>
      <input type='text' name='songName1' id='songName1' maxlength="50"  value="<?php echo $songName1; ?>"/>

      <label for='artist2' >Artiest (2)*:</label>
      <input type='text' name='artist2' id='artist2' maxlength="50"  value="<?php echo $artist2; ?>"/>
      <label for='songName2' >Naam van liedje (2)*:</label>
      <input type='text' name='songName2' id='songName2' maxlength="50"  value="<?php echo $songName2; ?>"/>

      <label for='artist3' >Artiest (3)*:</label>
      <input type='text' name='artist3' id='artist3' maxlength="50"  value="<?php echo $artist3; ?>"/>
      <label for='songName' >Naam van liedje (3)*:</label>
      <input type='text' name='songName3' id='songName3' maxlength="50"  value="<?php echo $songName3; ?>"/>

      <input type='submit' name='Submit' value='Submit' />

      </fieldset>
    </form>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>