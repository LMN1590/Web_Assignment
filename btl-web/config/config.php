<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "res_db";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>