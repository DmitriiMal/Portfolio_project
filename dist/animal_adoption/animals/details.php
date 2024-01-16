<?php

session_start();

require_once "../components/db_connect.php";
require_once "../components/navbar.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {

  $sql = "SELECT * FROM `animals` WHERE `id`= $_GET[id]";

  $result = mysqli_query($conn, $sql);


  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
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
  <title>Details</title>
</head>

<body>
  <?= $navbar ?>

  <div class="container my-5 pt-5">
    <h1 class="text-center my-4"><?= $row['name'] ?></h1>
    <div class="d-flex mb-4">
      <img class="w-50 rounded img-thumbnail shadow object-fit-cover me-4" src="../pictures/<?= $row['picture'] ?>" alt="">
      <div class="border-start ps-4">
        <p><strong>Age: </strong><?= $row['age'] ?> year(s)</p>
        <p><strong>Size: </strong><?= $row['size'] ?></p>
        <p><strong>Breed: </strong> <?= $row['breed'] ?></p>
        <p><strong>Vaccinated: </strong><?= $row['vaccinated'] ?></p>
        <p><strong>Location: </strong><?= $row['location'] ?></p>
        <p><strong>Status: </strong><?= $row['status'] ?></p>
        <!-- <a href='#' class='btn btn-outline-dark <?= $row['status'] == "Adopted" ? "disabled" : "" ?>'>Take me home</a> -->
      </div>
    </div>
    <p><strong>Description:</strong></p>
    <p><?= $row['description'] ?></p>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>