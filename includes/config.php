<?php
  ob_start(); //Turns on output buffering holds some data before it is sent to the browser
  session_start();

  date_default_timezone_set("Europe/Paris");

  try {
    $con = new PDO("mysql:dbname=netflix-clone;host=localhost", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  }
  catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
  }
?>