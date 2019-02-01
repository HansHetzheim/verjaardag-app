<?php
  define('SITE_KEY', '6Lfr8o0UAAAAAGf7Rltt_C0alZ9DDfwB_qvRv5UV');
  define('SECRET_KEY', '6Lfr8o0UAAAAANIPX9CvGeS9-G3sPnKQMVcPdyMa');
  session_start();
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $_SESSION['user']=$username;
    $email = $_POST['email'];
    $_SESSION['mailAddress']=$email;
    $secretKey = "6Lfr8o0UAAAAANIPX9CvGeS9-G3sPnKQMVcPdyMa";
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $response = json_decode($response);
    if ($response->success) {
        if(!isset($username) || trim($username) == '' || !isset($email) || trim($email) == '') {
            echo "You did not fill out the required fields.";
        } else {header('Location: http://localhost/finalBirthdayApp/playlist.php/');}
    } else  {
        echo "Verification failed!";
    }
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
    <link rel="stylesheet" href="./assets/css/login.css">
    <title>Big Test Login</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="container">
        <form id='register' action='<?php $_SERVER[' PHP_SELF'] ?>' method='post' accept-charset='UTF-8'>
            <h1>Welkom!</h1>
            <p>Om jouw favoriete nummers te delen, gelieven even in te loggen!</p>
            <fieldset>
                <legend>Login</legend>
                <label for='username'>Jouw username*:</label>
                <input type='text' name='username' id='username' maxlength="50" placeholder="username.." />
                <label for='email'>Jouw email adres*:</label>
                <input type='email' name='email' id='email' maxlength="50" placeholder="email.." />
                <input type='submit' name='submit' value='Aanmelden' />
                <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY; ?>"></div>
            </fieldset>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>

</html>
<!-- End of HTML -->