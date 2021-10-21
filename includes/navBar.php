<nav class="topBar">
  <div class="logoContainer"> 
    <a href="dashboard.php">
      <img src="assets/images/logo.png" alt="Logo">
    </a>
  </div>
  <ul class="navLinks">
    <li><a href="dashboard.php">Home</a></li>
    <li><a href="shows.php">TV Shows</a></li>
    <li><a href="movies.php">Movies</a></li>
  </ul>
  <div class="rightItems">
    <a href="search.php">
      <i class="fas fa-search"></i>
    </a>
    <a href="profile.php">
      <i class="fas fa-user"></i>
    </a>
    <a href="logout.php">
      <i class="fas fa-sign-out-alt"></i>
    </a>
    <a class="burgerMenu" onclick="menuBurger(this)">
      <i class="fa fa-bars"></i>
    </a>
  </div>

  <ul class="menuResponsive scrolled" id="menuShow" style="display: none;">
    <li><a href="dashboard.php">Home</a></li>
    <li><a href="shows.php">TV Shows</a></li>
    <li><a href="movies.php">Movies</a></li>
    <li>
      <a href="search.php">
        <i class="fas fa-search"></i>
         Search
      </a>
    </li>
    <li>
      <a href="profile.php">
        <i class="fas fa-user"></i>
         Profile
      </a>
    </li>
    <li>
      <a href="logout.php">
      <i class="fas fa-sign-out-alt"></i>
         Logout
      </a>
    </li>
  </ul>
</nav>