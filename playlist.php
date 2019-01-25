<?php
$servername = "localhost";
$username = "tom";
$password = "DaRuler07";
$dbname = "dirkParty";
$tableName = "guestPlaylist";
$mailPattern = '/^[\w][\w.]+[\w]@[\w.]+\.[\w]{2,4}$/i';
$doubleDot = "/\.{2,}/";
$update = False;

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
print_r($result);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       echo "id: " . $row["id"]. " - Name: " . $row["username"]. " " . $row["reg_date"]. "<br>";
    }
} else {
    echo "0 results";
}

// check of een ingevoerde email al in de database staat------------------------
if ($result->num_rows > 0) {
  $sql2 = "SELECT * FROM $tableName WHERE email = '$mail'";
  $result = $conn->query($sql2);
  if ($result->num_rows > 0) {
      // put the record in vars
      while($row = $result->fetch_assoc()) {
         $artist1 = $row["artist1"];
         $songName1 = $row["songTitle1"];
         $artist2 = $row["artist2"];
         $songName2 = $row["songTitle2"];
         $artist3 = $row["artist3"];
         $songName3 = $row["songTitle3"];
         $update = True;
      }
  } else {
      echo "0 results";
  }
} else {
  $artist1 = "";
  $songName1 = "";
  $artist2 = "";
  $songName2 = "";
  $artist3 = "";
  $songName3 = "";
  // Add row----------------------------------------------------------------------

  $sql2 = "INSERT INTO $tableName (username, email, artist1, songTitle1, artist2, songTitle2, artist3, songTitle3)
  VALUES ('$name', '$mail', '$artist1', '$songName1', '$artist2', '$songName2', '$artist3', '$songName3')";

  if ($conn->query($sql2) === TRUE) {
      $last_id = $conn->insert_id;
      echo "Row created successfully<br>Last inserted ID is: " . $last_id . "<br>";
  } else {
      echo "Error creating row: " . $conn->error;
    }


}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Big Test Playlist</title>
  </head>
  <body>

    <form id='register' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post' accept-charset='UTF-8'>
      <fieldset >
      <legend>Your playlist</legend>
      <label for='username' >Your UserName*:</label>
      <input type='text' name='username' id='username' maxlength="50" value="<?php echo $name; ?>" disabled/>
      <label for='email' >Your Email Address*:</label>
      <input type='text' name='email' id='email' maxlength="50" value="<?php echo $mail; ?>" disabled/>

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
