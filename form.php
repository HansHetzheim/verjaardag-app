<form id='register' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post' accept-charset='UTF-8'>
  <fieldset >
  <legend>Jouw Playlist</legend>
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
