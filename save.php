<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="./assets/css/main.css">
    <meta charset="utf-8">
    <title>Big Test Playlist</title>
  </head>
  <body>
    <div class="container">
      <form id='confirm' action='<?php $_SERVER['PHP_SELF'] ?>' method='post' accept-charset='UTF-8'>
        <fieldset class="centered">
        <legend class="text">Bedankt voor de vette hits yo!</legend>
        <p class="text">de liedjes zijn opgeslagen inder je naam: <?php echo $name; ?></p>
        <input class="edit-btn" type='submit' name='Submit' value='Pas aan' />
        </fieldset>
      </form>

    <form id="logout" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      <input type='submit' name='logOut' value="Log uit"/>
    </form>
    </div>
  </body>
</html>
