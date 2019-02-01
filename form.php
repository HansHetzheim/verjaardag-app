<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Aleo" rel="stylesheet">
  <link href="./assets/css/main.css" rel="stylesheet" type="text/css">
  <title>Birthday Songs</title>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1 class="text">Welkom!</h1>
      <h2 class="text">Geef hieronder je drie favoriete nummers door</h2>
    </div>


      <form id='updatePlaylist' action='<?php $_SERVER['PHP_SELF'] ?>' method='post' accept-charset='UTF-8'>
        <fieldset class="centered bigForm">
          <legend class="text">Jouw playlist</legend>
          <div class="inputBox">
            <label class="text" for='artist1'>Artist (1)*:</label>
            <input type='text' name='artist1' id='artist1' maxlength="50" value="<?php echo $artist1; ?>" />
          </div>
          <div class="inputBox">
          <label class="text" for='songName1'>Eerste Liedje*:</label>
          <input type='text' name='songName1' id='songName1' maxlength="50" value="<?php echo $songName1; ?>" />
          </div>
          <div class="inputBox">
          <label class="text" for='artist2'>Artiest*:</label>
          <input type='text' name='artist2' id='artist2' maxlength="50" value="<?php echo $artist2; ?>" />
          </div>
          <div class="inputBox">
          <label class="text" for='songName2'>Tweede Liedje*:</label>
          <input type='text' name='songName2' id='songName2' maxlength="50" value="<?php echo $songName2; ?>" />
          </div>
          <div class="inputBox">
          <label class="text" for='artist3'>Artiest*:</label>
          <input type='text' name='artist3' id='artist3' maxlength="50" value="<?php echo $artist3; ?>" />
          </div>
          <div class="inputBox">
          <label class="text" for='songName'>Derde Liedje*:</label>
          <input type='text' name='songName3' id='songName3' maxlength="50" value="<?php echo $songName3; ?>" />
          </div>
          <div class="inputBox">
          <label class="text" for='message'>Leave a personal message!*</label>
          <textarea rows="5" cols="51" id="message" name="message" placeholder="Leave a message here!"><?php echo $message; ?></textarea>
          </div>
          <input type='submit' name='save' value='Save' />

        </fieldset>
      </form>

      <form id="logout" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <input type='submit' name='logOut' value="Log out" />
      </form>

  </div>

</body>

</html>
