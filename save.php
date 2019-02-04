<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="./assets/css/main.css">
    <meta charset="utf-8">
    <title>Bedankt voor je nummers</title>
  </head>
  <body>
    <div class="container">
      <form id='confirm' action='<?php $_SERVER['PHP_SELF'] ?>' method='post' accept-charset='UTF-8'>
        <fieldset class="centered">
        <legend class="text">Bedankt!</legend>
        <p class="text">de liedjes zijn opgeslagen onder je naam: <?php echo $name; ?></p>
        <div class="inputBox">
          <input class="edit-btn" type='submit' name='Submit' value='Pas aan' />
        </div>
        </fieldset>
      </form>

    <form id="logout" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      <input type='submit' name='logOut' value="Log uit"/>
    </form>
    </div>
  </body>
</html>
