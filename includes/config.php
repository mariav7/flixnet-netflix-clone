<?php
  ob_start(); //Turns on output buffering holds some data before it is sent to the browser
  session_start();

  date_default_timezone_set("Europe/Paris");

  $envFile = __DIR__ . '../../.env';

  if (file_exists($envFile)) {
      $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

      foreach ($lines as $line) {
          list($key, $value) = explode('=', $line, 2) + [NULL, NULL];
          if ($key !== NULL && $value !== NULL) {
              putenv("$key=$value");
              $_ENV[$key] = $value;
              $_SERVER[$key] = $value;
          }
      }
  } else {
      exit('.env file not found. Please create one.');
  }

  $db_name = getenv('DB_NAME');
  $db_host = getenv('DB_HOST');
  $db_user = getenv('DB_USER');
  $db_password = getenv('DB_PASSWORD');

  // echo "DB_NAME:" . $db_name . "<br>";
  // echo "DB_HOST:" . $db_host . "<br>";
  // echo "DB_USER:" . $db_user . "<br>";
  // echo "DB_PASSWORD:" . $db_password . "<br>";

  try {
    $con = new PDO("mysql:dbname={$db_name};host={$db_host}", $db_user, $db_password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  }
  catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
  }
?>