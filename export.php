<?php
if(isset($_POST['export'])){
  $servername = "localhost";
  $username = "veryCoolUser";
  $password = "unGuessable1010";
  $database = "dirkParty";
  $tableName = "guestPlaylist";
  $conn = new mysqli($servername, $username, $password, $database);
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
  }
  header('Content-Type: text/csv; charset=utf-8');
  header('Content-Disposition: attachment; filename=data.csv');
  $output = fopen("php://output", "w");
  fputcsv($output, array('Id', 'Username', 'Email', 'First artist', 'First Song', 'Second artist', 'Second Song', 'Third artist', 'Third Song', 'Registration time'));
  $query = "SELECT * FROM $tableName ORDER BY id asc";
  $result = $conn->query($query);
  while($row = mysqli_fetch_assoc($result)){
    fputcsv($output, $row);
  }
  fclose($output);
 }

 ?>
