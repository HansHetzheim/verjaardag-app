


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/playlist.css">
    <title>Big Test Login</title>
  </head>
  <body>

    <form id='register' action='playlist.php' method='post' accept-charset='UTF-8'>
      <h1>WELKOM</h1>
      <fieldset class="col-12" >
      <legend>Login</legend>
      <label for='username' >Your UserName*:</label>
      <input type='text' name='username' id='username' maxlength="50" value="<?php echo $name ?>"/>
      <label for='email' >Your Email Address*:</label>
      <input type='email' name='email' id='email' maxlength="50" value="<?php echo $email ?>"/><span><?php echo $emailErr ?></span>

      <input type='submit' name='Submit' value='Submit' />

      </fieldset>
    </form>

  </body>
</html>
