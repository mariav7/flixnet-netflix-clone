<?php
   
  require_once("config.php");
  require_once("includes/classes/PreviewProvider.php");
  require_once("includes/classes/CategoryContainers.php");
  require_once("includes/classes/Entity.php");
  require_once("includes/classes/EntityProvider.php");
  require_once("includes/classes/ErrorMessage.php");
  require_once("includes/classes/SeasonProvider.php");
  require_once("includes/classes/Season.php");
  require_once("includes/classes/Video.php");
  require_once("includes/classes/VideoProvider.php");
  require_once("includes/classes/User.php");
  
  if(!isset($_SESSION["userLoggedIn"])){
    header("Location: index.php");
  }

  $userLoggedIn = $_SESSION["userLoggedIn"] ;

?>
   
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5f47dca840.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/js/header.js" ></script>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css" >
    <title>Welcome to Flixnet</title>
  </head>
  <body>
    
    <div class="wrapper">

<!-- Navbar -->
<?php
  if(!isset($hideNav)){
    include_once("includes/navBar.php");
  }
?>  