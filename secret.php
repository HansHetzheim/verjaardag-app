<?php
include 'config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

$query = "SELECT * FROM $tableName ORDER BY id asc";
$result = $conn->query($query);

print_r($result);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Aleo" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin.css">
    <title>Admin Page</title>
  </head>
  <body>
    <div class="container">
      <div class="tablebox">
      <form class="secret" action="export.php" method="post">
        <h1>Input data for Dirk's Playlist</h1>
        <input class="export-btn" type="submit" name="export" value="Export">
        <p><em>Press the EXPORT button to download an exel file with all of the data.</em></p>
      </form>
        <table>
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
      </div>
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
           <td><?php echo $row['message']; ?></td>
           <td><?php echo $row['reg_date']; ?></td>
         </tr>
         <?php
       }

        ?>
     </table>
    </div>
  </body>
</html>
