<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Big Test</title>
  </head>
  <body>

    <form id='register' action='test.php' method='post' accept-charset='UTF-8'>
      <fieldset >
      <legend>Register</legend>
      <label for='username' >Your UserName*:</label>
      <input type='text' name='username' id='username' maxlength="50" />
      <label for='email' >Your Email Address*:</label>
      <input type='text' name='email' id='email' maxlength="50" />

      <input type='submit' name='Submit' value='Submit' />

      </fieldset>
    </form>

  </body>
</html>

<?php
$servername = "localhost";
$username = "tom";
$password = "DaRuler07";
$dbname = "test2";
$tableName = "guests";
$mailPattern = '/^[\w][\w.]+[\w]@[\w.]+\.[\w]{2,4}$/i';
$doubleDot = "/\.{2,}/";
$update = False;

$name = $_POST['username'];
echo $name . "<br>";

$mail = $_POST['email'];
echo $mail . "<br>";

preg_match($mailPattern, $mail, $matches1, PREG_UNMATCHED_AS_NULL);
print_r($matches1);
echo "mail check 1<br>";
preg_match($doubleDot, $mail, $matches2, PREG_UNMATCHED_AS_NULL);
print_r($matches2);
echo "mail check 2<br>";
// Create connection------------------------------------------------------------
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";
//
// // Create database-----------------------------------------------------------
// // $sql = "CREATE DATABASE $dbname";
// // if ($conn->query($sql) === TRUE) {
// //     echo "Database created successfully<br>";
// // } else {
// //     echo "Error creating database: " . $conn->error;
// // }
//
//Connect to relevant database--------------------------------------------------
$conn = mysqli_connect($servername, $username, $password, $dbname);
echo "Connected successfully to database " . $dbname . "<br>";
//
// //Create table---------------------------------------------------------------
// // $sql = "CREATE TABLE $tableName(
// //   id INTEGER(6) AUTO_INCREMENT PRIMARY KEY,
// //   username VARCHAR(30) NOT NULL,
// //   email VARCHAR(50) NOT NULL,
// //   reg_date TIMESTAMP)";
// // if ($conn->query($sql) === TRUE) {
// //     echo "Table created successfully<br>";
// // } else {
// //     echo "Error creating table: " . $conn->error;
// // }
//
// Add row----------------------------------------------------------------------
// if ($matches1 != NULL && $matches2[0] === NULL){
//   $sql = "INSERT INTO $tableName (username, email)
//   VALUES ('$name', '$mail')";
//
//   if ($conn->query($sql) === TRUE) {
//       $last_id = $conn->insert_id;
//       echo "Row created successfully<br>Last inserted ID is: " . $last_id . "<br>";
//   } else {
//       echo "Error creating row: " . $conn->error;
//     }
// } else {
//   echo "Invalid e-mail.<br>";
// }

//
// //Add multiple rows----------------------------------------------------------
// // $sql = "INSERT INTO $tableName (username, email)
// // VALUES ('John3', 'john@example.com');";
// // $sql .= "INSERT INTO $tableName (username, email)
// // VALUES ('Mary3', 'mary@example.com');";
// // $sql .= "INSERT INTO $tableName (username, email)
// // VALUES ('TheDoes3', 'family.thedoes@example.com')";
// //
// // if ($conn->multi_query($sql) === TRUE) {
// //     echo "New records created successfully";
// // } else {
// //     echo "Error: " . $sql . "<br>" . $conn->error;
// // }
// //¡¡¡¡¡ $conn->multi_query($sql) is the line of code that actually does the communication, same for $conn->query($sql) !!!!!
//
// // prepare and bind----------------------------------------------------------
// // $stmt = $conn->prepare("INSERT INTO $tableName (username, email) VALUES (?, ?)");
// // $stmt->bind_param("ss", $username, $email);
// //
// // // set parameters and execute
// // $username = "Jack";
// // $email = "jack@example.com";
// // $stmt->execute();
// //
// // $username = "Doe";
// // $email = "doe@example.com";
// // $stmt->execute();
// //
// // echo "New records created successfully";
// //
// // $stmt->close();

//find data in database and show results----------------------------------------
// $sql = "SELECT * FROM $tableName";
// $result = $conn->query($sql);
//
// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//        echo "id: " . $row["id"]. " - Name: " . $row["username"]. " " . $row["reg_date"]. "<br>";
//     }
// } else {
//     echo "0 results";
// }
//
//Delete a record---------------------------------------------------------------
// $sql = "DELETE FROM $tableName WHERE id=16";
//
// if ($conn->query($sql) === TRUE) {
//     echo "Record deleted successfully";
// } else {
//     echo "Error deleting record: " . $conn->error;
// }
//
// $sql = "UPDATE $tableName SET username='Doe' WHERE id=2";
//
// if ($conn->query($sql) === TRUE) {
//     echo "Record updated successfully";
// } else {
//     echo "Error updating record: " . $conn->error;
// }

//check of een ingevoerde email al in de database staat-------------------------
$sql = "SELECT id FROM $tableName WHERE email = '$mail'";
$result = $conn->query($sql);
print_r($result->num_rows);
echo "<br>";

//update record/row-------------------------------------------------------------
if ($result->num_rows > 0) {
    echo "Email exists.<br>";
    $sql2 = "UPDATE $tableName SET username='AAAAAAA' WHERE email='$mail'";
    if ($conn->query($sql2) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error upadting record: " . $conn->error;
    }
} else {
    echo "Email not found.<br>";
}

//Remove database-----------------------------------------------------------
// $sql = "DROP DATABASE $dbname";
// if ($conn->query($sql) === TRUE) {
//     echo "Database removed successfully<br>";
// } else {
//     echo "Error removing database: " . $conn->error;
// }

//Close the connection to mysql database----------------------------------------
$conn->close();
?>
