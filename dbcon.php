<?php
  $con = "mysql:host=localhost;dbname=sound";
  $user = "root";
  $password = "";

  $pdo = new PDO($con, $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 ?>
