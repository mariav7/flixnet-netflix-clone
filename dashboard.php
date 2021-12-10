<?php
  require_once("includes/header.php");

   $preview = new PreviewProvider($con, $userLoggedIn  );  
   echo $preview->createPreviewVideo(NULL); 

   $containers = new CategoryContainers($con, $userLoggedIn  );  
   echo $containers->showAllCategories(); 
?>

<footer class="footer">
  <p>Personal Project by <a href="https://www.linkedin.com/in/mariafvillegas" target="_blank">Maria Villegas</a></p>
</footer>