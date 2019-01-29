<?php
$servername = "localhost";
$username = "veryCoolUser";
$password = "unGuessable1010";
$database = "dirkParty";
$tableName = "guestPlaylist";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

$query = "SELECT * FROM $tableName ORDER BY id asc";
$result = $conn->query($query)





?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>itsASecret</title>
  </head>
  <body>
    <form class="" action="export.php" method="post">
      <input type="submit" name="export" value="export CSV">
    </form>
    <table style="width:100%">
     <tr>
       <th>Id</th>
       <th>Username</th>
       <th>Email</th>
       <th>First artist</th>
       <th>First Song</th>
       <th>Second artist</th>
       <th>Second Song</th>
       <th>Third artist</th>
       <th>Third Song</th>
       <th>Registration time</th>
     </tr>
     <?php

     while ($row = mysqli_fetch_array($result)){
       ?>
       <tr>
         <td><?php echo $row['id']; ?></td>
         <td><?php echo $row['username']; ?></td>
         <td><?php echo $row['email']; ?></td>
         <td><?php echo $row['artist1']; ?></td>
         <td><?php echo $row['songTitle1']; ?></td>
         <td><?php echo $row['artist2']; ?></td>
         <td><?php echo $row['songTitle2']; ?></td>
         <td><?php echo $row['artist3']; ?></td>
         <td><?php echo $row['songTitle3']; ?></td>
         <td><?php echo $row['reg_date']; ?></td>
       </tr>
       <?php
     }

      ?>
   </table>
  </body>
</html>
