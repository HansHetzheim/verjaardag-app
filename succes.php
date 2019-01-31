<?php
session_start();

if(!isset($_SESSION['user'])) {
   header('Location: http://localhost/finalBirthdayApp/login.php/');
}

if(isset($_POST['logOut'])){
  unset($_SESSION['user']);
  unset($_SESSION['mailAddress']);
  session_destroy();
  header('Location: http://localhost/finalBirthdayApp/login.php/');
}

include 'config.php';

//Connect to relevant database--------------------------------------------------
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
   die("Connection to database failed: " . $conn->connect_error);
}
echo "Connected successfully to database " . $dbname . "<br>";

$name = $conn->real_escape_string($_SESSION['user']);
$mail = $conn->real_escape_string($_SESSION['mailAddress']);

//update record/row-----------------------------------------------------------
$artist1 = $conn->real_escape_string($_POST['artist1']);
$songName1 = $conn->real_escape_string($_POST['songName1']);
$artist2 = $conn->real_escape_string($_POST['artist2']);
$songName2 = $conn->real_escape_string($_POST['songName2']);
$artist3 = $conn->real_escape_string($_POST['artist3']);
$songName3 = $conn->real_escape_string($_POST['songName3']);
$message = $conn->real_escape_string($_POST['message']);
$stmt = $conn->prepare("UPDATE $tableName
SET username=?,
artist1=?,
songTitle1=?,
artist2=?,
songTitle2=?,
artist3=?,
songTitle3=?,
message=?
WHERE email=?");
$stmt->bind_param("sssssssss", $name, $artist1, $songName1, $artist2, $songName2, $artist3, $songName3, $message, $mail);
$stmt->execute();

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error upadting record: " . $conn->error;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Big Test Playlist</title>
  </head>
  <body>

    <form id='register' action='playlist.php' method='post' accept-charset='UTF-8'>
      <fieldset >
      <legend>Bedankt voor de vette hits yo!</legend>
      <p>de liedjes zijn opgeslagen inder je naam: <?php echo $name; ?></p>
      <!-- <label for='username' >Your UserName*:</label>
      <input type='text' name='username' id='username' maxlength="50" value="<?php echo $name; ?>" readonly="readonly"/>
      <label for='email' >Your Email Address*:</label>
      <input type='text' name='email' id='email' maxlength="50" value="<?php echo $mail; ?>" readonly="readonly"/> -->

      <input type='submit' name='Submit' value='Pas aan' />
      </fieldset>
    </form>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      <input type='submit' name='logOut' value="Log out"/>
    </form>

  </body>
</html>
