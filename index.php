<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Aleo" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <title>Birthday Songs</title>
  </head>
  <body>

    <div class="container">
      <div class="header">
        <h1>Fijn dat je aanwezig bent op mijn 50ste verjaardag!</h1>
        <h2>Zou je alvast je drie favoriete liedjes willen doorgeven aan onze DJ?</h2>
      </div>
      <div class="splitscreen">
        <div class="photo">
          <img src="./img/dirk-nobg.png" alt="">
        </div>
        <form method="POST" action="playlist.php" class="fields">
          <h3>Jouw Username: </h3>
          <input id="username" type="text" name="" value="<?php echo $name ?>" maxlength="50" placeholder="Jouw username hier..">
          <h3>Jouw Email Adres: </h3>
          <input id="email" type="text" name="" value="<?php echo $email ?>" maxlength="50" placeholder="Jouw email adres hier..">
          <div class="g-recaptcha" data-sitekey="6LdciY0UAAAAAJfp3TbaD4r-Ayurhnl8dc2dcgLz"></div>
          <button class="continue" type="button" name="button">Aanmelden</button>
        </form>
      </div>
    </div>
    
  </body>
</html>