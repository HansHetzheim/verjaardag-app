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
// echo "Connected successfully to database " . $dbname . "<br>";
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
    // echo "Record updated successfully";
} else {
    echo "Error updated record: " . $conn->error;
}
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
  <title>Je nummers zijn opgeslagen!</title>
</head>

<body>
  <div class="container">
    <form id='register' action='playlist.php' method='post' accept-charset='UTF-8'>
      <fieldset>
        <legend>Bedankt het delen van je favoriete nummers!</legend>
        <p>Jouw liedjes zijn opgeslagen onder de naam:
          <?php echo $name; ?>
        </p>
        <input class="edit-btn" type='submit' name='Submit' value='Pas aan' />
      </fieldset>
    </form>
  </div>
  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <input type='submit' name='logOut' value="Log out" />
  </form>
</body>

</html>
<!-- End of HTML -->
