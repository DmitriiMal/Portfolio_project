<?php

session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
  header("Location: home.php");
}

require_once "components/db_connect.php";
require_once "components/navbar.php";

$userId = 0;

if (isset($_SESSION["adm"])) {
  $userId = $_SESSION["adm"];
} else {
  $userId = $_SESSION["user"];
}

$userSql = "SELECT * FROM `users` WHERE `id` = $userId";
$userResult = mysqli_query($conn, $userSql);
$user = mysqli_fetch_assoc($userResult);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/553d5d3b41.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style/style.css">
  <title>Home</title>
</head>

<body>
  <?= $navbar ?>

  <div class="container my-5 pt-5">
    <img src="pictures/<?= $user['picture'] ?>" class="d-block mx-auto my-4 rounded-circle img-thumbnail asp-1 object-fit-cover shadow-sm m-auto" width='150px' alt="">
    <h1 class="text-center">Welcome, <?= $user['first_name'] ?>!</h1>
    <div class="border-start ps-4">
      <p><strong>Id: </strong><?= $user['id'] ?></p>
      <p><strong>First name: </strong><?= $user['first_name'] ?></p>
      <p><strong>Last name: </strong> <?= $user['last_name'] ?></p>
      <p><strong>Email: </strong><?= $user['email'] ?></p>
      <p><strong>Phone number: </strong><?= $user['phone_number'] ?></p>
      <p><strong>Address: </strong><?= $user['address'] ?></p>
    </div>



  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>