<?php
if(isset($_POST['exportMessage'])){
  include 'config.php';
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
  }
  header('Content-Type: text/csv; charset=utf-8');
  header('Content-Disposition: attachment; filename=messages.csv');
  $output = fopen("php://output", "w");
  fputcsv($output, array('Username', 'Email', 'Message'));
  $query = "SELECT username, email, message FROM $tableName ORDER BY id asc";
  $result = $conn->query($query);
  while($row = mysqli_fetch_assoc($result)){
    fputcsv($output, $row);
  }
  fclose($output);
 }

 ?>
