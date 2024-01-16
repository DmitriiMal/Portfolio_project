<?php

session_start();

if (isset($_SESSION["user"])) {
  header("Location: ../home.php");
} elseif (isset($_SESSION["adm"])) {
  header("Location: ../animals/animals_dashboard.php");
}



require_once "../components/db_connect.php";
require_once "../components/file_upload.php";
require_once "../components/navbar.php";
require_once "../components/clean.php";



$first_name = $last_name = $email = $phone_number = $address = $pass = $passConfirm = $picture = "";
$first_nameError = $last_nameError = $emailError = $phone_numberError = $addressError = $passError = $passConfirmError = $pictureError = "";

$error = false;

if (isset($_POST['register']) && !empty($_POST['register'])) {


  $first_name = clean($_POST['first_name']);
  $last_name = clean($_POST['last_name']);
  $email = clean($_POST['email']);
  $phone_number = clean($_POST['phone_number']);
  $address = clean($_POST['address']);
  $pass = $_POST['pass'];
  $passConfirm = $_POST['passConfirm'];

  if (empty($first_name)) {
    $error = true;
    $first_nameError = "Please, enter your first name";
  } elseif (strlen($first_name) < 2) {
    $error = true;
    $first_nameError = "First name has to contain at least 2 characters.";
  } elseif (!preg_match("/^[a-zA-Z\s]+$/", $first_name)) {
    $error = true;
    $first_nameError = "Name has to contain only letters and spaces";
  }


  if (empty($last_name)) {
    $error = true;
    $last_nameError = "Please, enter your Last name";
  } elseif (strlen($last_name) < 2) {
    $error = true;
    $last_nameError = "First name has to contain at least 2 characters";
  } elseif (!preg_match("/^[a-zA-Z\s]+$/", $last_name)) {
    $error = true;
    $last_nameError = "Name has to contain only letters and spaces";
  }

  if (empty($email)) {
    $error = true;
    $emailError = "Please, enter your email";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $emailError = "Please enter a valid email address";
  } else {

    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) !== 0) { // != ?
      $error = true;
      $emailError = "Provided Email is already in use";
    }
  }


  if (empty($phone_number)) {
    $error = true;
    $phone_numberError = "Please, enter your phone number";
  }


  if (empty($address)) {
    $error = true;
    $addressError = "Please, enter your address";
  } elseif (strlen($address) < 3) {
    $error = true;
    $addressError = "Address has to contain at least 3 characters";
  }


  if (empty($pass)) {
    $error = true;
    $passError = "Please, enter your password";
  } elseif (strlen($pass) < 6) {
    $error = true;
    $passError = "Password must have at least 6 characters";
  }

  if (empty($passConfirm)) {
    $error = true;
    $passConfirmError = "Please, confirm your password";
  } elseif ($passConfirm !== $pass) {
    $error = true;
    $passConfirmError = "Passwords must be the same";
  }

  if (!$error) {
    $pass = hash("sha256", $pass);
    $picture = fileUpload($_FILES['picture']);
    $sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `phone_number`, `address`, `pass`, `picture`) VALUES ('$first_name','$last_name','$email',$phone_number,'$address','$pass','$picture[0]')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo "
      <div class='alert alert-success mt-5' role='alert'>
      New account has been created! <i class='fa-solid fa-kiwi-bird'></i>
      </div>";
    } else {
      echo "
      <div class='alert alert-danger mt-5' role='alert'>
      Something went wrong! <i class='fa-solid fa-bugs'></i>
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
  <title>Register</title>
</head>

<body>
  <?= $navbar ?>

  <div class="container my-5 pt-5">
    <h1 class="text-center my-4">Register</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="mb-3">

        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
          <!-- <label for="first_name">First Name</label> -->
          <?= $first_nameError == "" ?  "<label for='first_name'>First Name</label>" : "<label class='text-danger' for='first_name'>$first_nameError</label>" ?>
          <!-- <label class="text-danger" for="first_name">First Name</label> -->
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
          <!-- <label for="last_name">Last Name</label> -->
          <?= $last_nameError == "" ?  "<label for='last_name'>Last Name</label>" : "<label class='text-danger' for='last_name'>$last_nameError</label>" ?>
        </div>

        <div class="form-floating mb-3">
          <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Phone">
          <!-- <label for="phone_number">Phone number</label> -->
          <?= $phone_numberError == "" ?  "<label for='phone_number'>Phone number</label>" : "<label class='text-danger' for='phone_number'>$phone_numberError</label>" ?>
        </div>

        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="address" name="address" placeholder="address">
          <!-- <label for="address">Address</label> -->
          <?= $addressError == "" ?  "<label for='address'>Address</label>" : "<label class='text-danger' for='address'>$addressError</label>" ?>
        </div>

        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="email" name="email" placeholder="email">
          <!-- <label for="email">Email address</label> -->
          <?= $emailError == "" ?  "<label for='email'>Email</label>" : "<label class='text-danger' for='email'>$emailError</label>" ?>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
          <!-- <label for="pass">Password</label> -->
          <?= $passError == "" ?  "<label for='pass'>Password</label>" : "<label class='text-danger' for='pass'>$passError</label>" ?>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="passConfirm" name="passConfirm" placeholder="Password confirm">
          <!-- <label for="passConfirm">Password confirm</label> -->
          <?= $passConfirmError == "" ?  "<label for='passConfirm'>Password confirm</label>" : "<label class='text-danger' for='passConfirm'>$passConfirmError</label>" ?>
        </div>
        <div class="form-floating mb-3">
          <input type="file" class="form-control" id="picture" name="picture" placeholder="picture">
          <label for="picture">Picture</label>
        </div>


        <input type="submit" value="Register" name="register" class="btn btn-dark">

        <small class="text-secondary ms-4">Already have an account? <a class="link-dark" href="login.php">Log in here</a></span>

    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>