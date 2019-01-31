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
        } else {header('Location: http://localhost/playlist.php/');}
    } else  {
        echo "Verification failed!";
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Big Test Login</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>

    <form id='register' action='login.php' method='post' accept-charset='UTF-8'>
        <fieldset>
            <legend>Login</legend>
            <label for='username'>Your UserName*:</label>
            <input type='text' name='username' id='username' maxlength="50" value="<?php echo $name ?>" />
            <label for='email'>Your Email Address*:</label>
            <input type='email' name='email' id='email' maxlength="50"
                value="<?php echo $email ?>" /><span><?php echo $emailErr ?></span>

            <input type='submit' name='submit' value='submit' />
            <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY; ?>"></div>
        </fieldset>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="./assets/js/script.js"></script>
</body>

</html>