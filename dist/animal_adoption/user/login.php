<?php

session_start();

if (isset($_SESSION["user"])) {
  header("Location: ../index.php");
} elseif (isset($_SESSION["adm"])) {
  header("Location: ../animals/animals_dashboard.php");
}


require_once "../components/db_connect.php";
require_once "../components/navbar.php";
require_once "../components/clean.php";

$emailError = "";
$passError = "";
$error = false;

if (isset($_POST["login"])) {
  $email = clean($_POST["email"]);
  $pass = clean($_POST["pass"]);

  if (empty($email)) {
    $error = true;
    $emailError = "Please, enter your email";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $emailError = "Please enter a valid email address";
  }

  if (empty($pass)) {
    $error = true;
    $passError = "Please, enter your password";
  }

  if (!$error) {
    $pass = hash("sha256", $pass);

    $sql = "SELECT * FROM `users` WHERE email = '$email' AND pass = '$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      if ($row["status"] === "user") {
        $_SESSION["user"] = $row["id"];
        header("Location: ../index.php");
        echo "<script>window.location.reload()</script>";
      } elseif ($row["status"] === "adm") {
        $_SESSION["adm"] = $row["id"];
        header("Location: ../animals/animals_dashboard.php");
        echo "<script>window.location.reload()</script>";
      }
    } else {
      echo "
            <div class='alert alert-danger mt-5' role='alert'>
            Incorrect email or password! <i class='fa-solid fa-bugs'></i>
            </div>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/553d5d3b41.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../style/style.css">
  <title>Login</title>
</head>

<body>
  <?= $navbar ?>

  <div class="container my-5 pt-5">
    <h1 class="text-center my-4">Login</h1>
    <form action="" method="post">
      <div class="mb-3">


        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="email" name="email" value="user@user.com" placeholder="name@example.com">
          <!-- <label for="email">Email address</label> -->
          <?= $emailError == "" ?  "<label for='email'>Email address</label>" : "<label class='text-danger' for='email'>$emailError</label>" ?>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="pass" name="pass" value="123123" placeholder="Password">
          <!-- <label for="pass">Password</label> -->
          <?= $passError == "" ?  "<label for='pass'>Password</label>" : "<label class='text-danger' for='pass'>$passError</label>" ?>
        </div>

        <small class="d-block mb-4">
          <a class="link-secondary" href="#" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="¯\_(ツ)_/¯">
            Forgotten password?
          </a>
        </small>

        <input type="submit" value="Login" name="login" class="btn btn-dark">

        <small class="text-secondary ms-4">Not registered yet? <a class="link-dark" href="register.php">Create your account here</a></small>
    </form>

    <div class="d-md-flex  justify-content-around my-5 pt-5">
      <div>
        <h6 class="text fw-lighter">Admin</h6>
        <p class="text fw-lighter mb-1">login: admin@admin.com</p>
        <p class="text fw-lighter">password: 123123</p>
      </div>
      <div>
        <h6 class="text fw-lighter">User</h6>
        <p class="text fw-lighter mb-1">login: user@user.com</p>
        <p class="text fw-lighter">password: 123123</p>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
  </script>
</body>

</html>