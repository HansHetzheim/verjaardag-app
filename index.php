<?php
define('SITE_KEY', '6Lfr8o0UAAAAAGf7Rltt_C0alZ9DDfwB_qvRv5UV');
define('SECRET_KEY', '6Lfr8o0UAAAAANIPX9CvGeS9-G3sPnKQMVcPdyMa');
session_start();

//check if logged in------------------------------------------------------------
if(!isset($_SESSION['user'])) {
  //login attemt----------------------------------------------------------------
  if (isset($_POST['login'])) {
    $name = $_POST['username'];
    $mail = $_POST['email'];
    $secretKey = "6Lfr8o0UAAAAANIPX9CvGeS9-G3sPnKQMVcPdyMa";
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];

    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $response = json_decode($response);

    if ($response->success) {
      if(!isset($name) || trim($name) == '' || !isset($mail) || trim($mail) == '') {
        echo "You did not fill out the required fields.";
      } else {//user succesfully logged in--------------------------------------
        include 'mysql.php';
        $_SESSION['user']=$name;
        $_SESSION['mailAddress']=$mail;
        //check of email al bestaat
        $stmt = $conn->prepare("SELECT * FROM $tableName WHERE email = ?");
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $result = $stmt->get_result();

        // check of een ingevoerde email al in de database staat------------------------
        if ($result->num_rows > 0) { //zoja: laad de eerder ingegeven data of update de data indien nodig
          // put the record in vars
          $stmt = $conn->prepare("SELECT * FROM $tableName WHERE email = ?");
          $stmt->bind_param("s", $mail);
          $stmt->execute();
          $result = $stmt->get_result();//dit moet nog es gebeure IK WEET NIE WAAROM
          while($row = $result->fetch_assoc()) {
            $artist1 = $row["artist1"];
            $songName1 = $row["songTitle1"];
            $artist2 = $row["artist2"];
            $songName2 = $row["songTitle2"];
            $artist3 = $row["artist3"];
            $songName3 = $row["songTitle3"];
            $message = $row["message"];
          }
        } else { //zo niet(er is een nieuw email in login.php gepost): initialiseer de data in mysql (maak een record)
          initRow($name, $mail);
        }
        include 'form.php';
      }
    } else  {
      include 'loginPage.php';
      echo "Verification failed!";
    }
  } else {
    include 'loginPage.php';
  }
} else{//logged in------------------------------------------------------------
  if(isset($_POST['logOut'])){//logout------------------------------------------
    unset($_SESSION['user']);
    unset($_SESSION['mailAddress']);
    session_destroy();
    include 'loginPage.php';
  } else {
    include 'mysql.php';
    $name = $conn->real_escape_string($_SESSION['user']);
    $mail = $conn->real_escape_string($_SESSION['mailAddress']);

    if (isset($_POST['save'])){//update teh record if nessecary-------------------
      //update record/row---------------------------------------------------------
      $artist1 = $conn->real_escape_string($_POST['artist1']);
      $songName1 = $conn->real_escape_string($_POST['songName1']);
      $artist2 = $conn->real_escape_string($_POST['artist2']);
      $songName2 = $conn->real_escape_string($_POST['songName2']);
      $artist3 = $conn->real_escape_string($_POST['artist3']);
      $songName3 = $conn->real_escape_string($_POST['songName3']);
      $message = $conn->real_escape_string($_POST['message']);
      $stmt = $conn->prepare("UPDATE $tableName
      SET username=?,
      artist1=?,
      songTitle1=?,
      artist2=?,
      songTitle2=?,
      artist3=?,
      songTitle3=?,
      message=?
      WHERE email=?");
      $stmt->bind_param("sssssssss", $name, $artist1, $songName1, $artist2, $songName2, $artist3, $songName3, $message, $mail);
      if ($stmt->execute()) {
          // echo "Record updated successfully";
      } else {
          echo "Error updated record: " . $conn->error;
      }
      include 'save.php';
    } else {
      //check of email al bestaat (altijd op dit punt)--------------------------
      $stmt = $conn->prepare("SELECT * FROM $tableName WHERE email = ?");
      $stmt->bind_param("s", $mail);
      $stmt->execute();
      $result = $stmt->get_result();
      // check of een ingevoerde email al in de database staat------------------------
      if ($result->num_rows > 0) { //zoja: laad de eerder ingegeven data of update de data indien nodig
        // put the record in vars
        $stmt = $conn->prepare("SELECT * FROM $tableName WHERE email = ?");
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $result = $stmt->get_result();//WHY pls
        while($row = $result->fetch_assoc()) {
          $artist1 = $row["artist1"];
          $songName1 = $row["songTitle1"];
          $artist2 = $row["artist2"];
          $songName2 = $row["songTitle2"];
          $artist3 = $row["artist3"];
          $songName3 = $row["songTitle3"];
          $message = $row["message"];
        }
      }
      include 'form.php';
    }
  }
}
?>
