<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Aleo" rel="stylesheet">
  <link href="./assets/css/main.css" rel="stylesheet" type="text/css">
  <title>Varjaardag playlist</title>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1 class="text">Welkom!</h1>
      <h2 class="text">Geef hieronder je drie favoriete nummers door</h2>
    </div>


      <form id='updatePlaylist' action='<?php $_SERVER['PHP_SELF'] ?>' method='post' accept-charset='UTF-8'>
        <fieldset>
          <legend class="text">Jouw playlist</legend>
          <div class="centered bigForm">
            <div class="inputBox box1">
              <label class="text" for='artist1'>Eerste Artiest*:</label>
              <input type='text' name='artist1' id='artist1' maxlength="50" value="<?php echo $artist1; ?>" />
            </div>
            <div class="inputBox box2">
            <label class="text" for='songName1'>Eerste Liedje*:</label>
            <input type='text' name='songName1' id='songName1' maxlength="50" value="<?php echo $songName1; ?>" />
            </div>
            <div class="inputBox box3">
            <label class="text" for='artist2'>Tweede Artiest*:</label>
            <input type='text' name='artist2' id='artist2' maxlength="50" value="<?php echo $artist2; ?>" />
            </div>
            <div class="inputBox box4">
            <label class="text" for='songName2'>Tweede Liedje*:</label>
            <input type='text' name='songName2' id='songName2' maxlength="50" value="<?php echo $songName2; ?>" />
            </div>
            <div class="inputBox box5">
            <label class="text" for='artist3'>Derde Artiest*:</label>
            <input type='text' name='artist3' id='artist3' maxlength="50" value="<?php echo $artist3; ?>" />
            </div>
            <div class="inputBox box6">
            <label class="text" for='songName'>Derde Liedje*:</label>
            <input type='text' name='songName3' id='songName3' maxlength="50" value="<?php echo $songName3; ?>" />
            </div>
            <div class="inputBox box7">
            <label class="text" for='message'>Laat een persoonlijk bericht voor Dirk na!*</label>
            <textarea rows="5" cols="51" id="message" name="message" placeholder="Leave a message here!"><?php echo $message; ?></textarea>
            </div>
            <div class="inputBox box8">
              <input type='submit' name='save' value='Save' />
            </div>
          </div>
        </fieldset>
      </form>

      <form id="logout" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <input type='submit' name='logOut' value="Log out" />
      </form>

  </div>

</body>

</html>
