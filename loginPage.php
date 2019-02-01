<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link href="./assets/css/main.css" rel="stylesheet" type="text/css">
    <title>Big Test Login</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>
  <div class="container">
    <form id='register' action='<?php $_SERVER['PHP_SELF'] ?>' method='post' accept-charset='UTF-8'>
        <fieldset class="centered">
            <legend class="text">Login</legend>
            <label class="text" for='username'>Your UserName*:</label>
            <input type='text' name='username' id='username' maxlength="50" placeholder="username" />
            <label class="text" for='email'>Your Email Address*:</label>
            <input type='email' name='email' id='email' maxlength="50" placeholder="username" />
            <input type='submit' name='login' value='Log in' />
            <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY; ?>"></div>
        </fieldset>
    </form>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>

</html>
