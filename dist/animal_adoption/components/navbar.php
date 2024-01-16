

<?php
session_start();



$navbar = "
<nav class='navbar navbar-expand-sm bg-body-tertiary fixed-top shadow opacity-75' style='height: 4rem;'>
  <div class='container-fluid'>
    <a class='navbar-brand' href='/animal_adoption/home.php'><i class='fa-solid fa-paw fa-xl me-2'></i>Home</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
     <div class='collapse navbar-collapse' id='navbarSupportedContent'>
      <ul class='navbar-nav ms-auto mb-2 mb-lg-0'>";

if (isset($_SESSION["adm"])) {
  $navbar .= "<li class='nav-item'>
         <a class='nav-link' aria-current='page' href='/animal_adoption/animals/animals_dashboard.php'>Animals</a>
         </li>
         <li class='nav-item'>
         <a class='nav-link' href='/animal_adoption/animals/create.php'>Add</a>
         </li>";
}

if (isset($_SESSION["adm"]) || isset($_SESSION["user"])) {
  $navbar .= "<li class='nav-item'>
          <a class='nav-link' href='/animal_adoption/index.php'>My account</a>
          </li>
          <li class='nav-item'>
          <a class='nav-link' href='/animal_adoption/user/logout.php'>Logout</a>
          </li>";
} else {
  $navbar .= "<li class='nav-item'>
          <a class='nav-link' href='/animal_adoption/user/login.php'>Login</a>
          </li>
          <li class='nav-item'>
          <a class='nav-link' href='/animal_adoption/user/register.php'>Register</a>
          </li>";
}
$navbar .= "
        
        </ul>
        
        <!-- </div> -->
        </div>
        </nav>
        
        ";

        // if (isset($_SESSION["user"])) {

        // } elseif (isset($_SESSION["adm"])) {

        // }