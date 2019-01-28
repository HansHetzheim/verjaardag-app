<?php
$name = $email = $nameErr = $emailErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["username"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      } else {
        header( "Location: http://localhost/playlist.php" );
      }
    }
}
  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Big Test Login</title>
  </head>
  <body>

    <form id='register' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post' accept-charset='UTF-8'>
      <fieldset >
      <legend>Login</legend>
      <label for='username' >Jouw Username*:</label>
      <input type='text' name='username' id='username' maxlength="50" value="<?php echo $name ?>"/>
      <label for='email' >Jouw Email Adres*:</label>
      <input type='text' name='email' id='email' maxlength="50" value="<?php echo $email ?>"/><span><?php echo $emailErr ?></span>

      <input type='submit' name='Submit' value='Submit' />

      </fieldset>
    </form>

  </body>
</html>
