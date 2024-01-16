<?php

session_start();

if (!isset($_SESSION["adm"])) {
  header("Location: ../home.php");
}


require_once "../components/db_connect.php";
require_once "../components/file_upload.php";
require_once "../components/navbar.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM `animals` WHERE `id` = $id";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['edit'])) {
  $name = $_POST['name'];
  $age = $_POST['age'];
  $size = $_POST['size'];
  $breed = $_POST['breed'];
  $vaccinated = $_POST['vaccinated'];
  $location = $_POST['location'];
  $status = $_POST['status'];
  $picture = fileUpload($_FILES['picture'], 'animal');
  $description = $_POST['description'];


  if ($_FILES["picture"]["error"] == 0) {
    if ($row["picture"] !== "animal.png") {
      unlink("../pictures/$row[picture]");
    }
    $sql = "UPDATE `animals` SET `name`='$name',`age`= $age,`size`='$size',`breed`='$breed',`vaccinated`='$vaccinated',`location`='$location',`status`='$status',`picture`='$picture[0], `description`='$description' WHERE id = $id";
  } else {
    $sql = "UPDATE `animals` SET `name`='$name',`age`= $age,`size`='$size',`breed`='$breed',`vaccinated`='$vaccinated',`location`='$location',`status`='$status',`description`='$description' WHERE id = $id";
  }


  if (mysqli_query($conn, $sql)) {
    echo "
    <div class='alert alert-success mt-5' role='alert'>
    Animal has been edited! <i class='fa-solid fa-crow'></i>
    </div>";
  } else {
    echo "
    <div class='alert alert-danger mt-5' role='alert'>
    Something went wrong! <i class='fa-solid fa-bugs'></i>
    </div>";
  }
}


// Refresh info
$sql = "SELECT * FROM `animals` WHERE `id` = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);



?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/553d5d3b41.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../style/style.css">
  <title>Update</title>
</head>

<body>
  <?= $navbar ?>

  <div class="container my-5 pt-5">
    <img src="../pictures/<?= $row['picture'] ?>" class="d-block mx-auto rounded-circle img-thumbnail asp-1 object-fit-cover shadow-sm m-auto" width='100px' alt="">
    <h1 class="text-center my-4">Edit information about <?= $row['name'] ?? "" ?></h1>
    <form method="POST" enctype="multipart/form-data">

      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" name="name" value="<?= $row['name'] ?? "" ?>" placeholder="Nane">
        <label for="name">Name</label>
      </div>

      <div class="form-floating mb-3">
        <input type="number" step="0.1" class="form-control" id="age" name="age" value="<?= $row['age'] ?? "" ?>" placeholder="Age">
        <label for="age">Age</label>
      </div>

      <div class="form-floating mb-3">
        <select class="form-select" id="size" name="size" aria-label="Floating label select example">
          <option <?= $row['size'] == "small" ? "selected" : "" ?> value="small">small</option>
          <option <?= $row['size'] == "medium" ? "selected" : "" ?> value="medium">medium</option>
          <option <?= $row['size'] == "large" ? "selected" : "" ?> value="large">large</option>
        </select>
        <label for="size">Size</label>
      </div>

      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="breed" name="breed" value="<?= $row['breed'] ?? "" ?>" placeholder="Breed">
        <label for="breed">Breed</label>
      </div>

      <div class="form-floating mb-3">
        <select class="form-select" id="vaccinated" name="vaccinated" aria-label="Floating label select example">
          <option <?= $row['vaccinated'] == "yes" ? "selected" : "" ?> value="yes">yes</option>
          <option <?= $row['vaccinated'] == "no" ? "selected" : "" ?> value="no">no</option>
        </select>
        <label for="vaccinated">Vaccinated</label>
      </div>

      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="location" name="location" value="<?= $row['location'] ?? "" ?>" placeholder="Location">
        <label for="location">Location</label>
      </div>

      <div class="form-floating mb-3">
        <select class="form-select" id="status" name="status" aria-label="Floating label select example">
          <option <?= $row['status'] == "Available" ? "selected" : "" ?> value="Available">Available</option>
          <option <?= $row['status'] == "Adopted" ? "selected" : "" ?> value="Adopted">Adopted</option>
        </select>
        <label for="status">Status</label>
      </div>

      <div class="form-floating mb-3">
        <input type="file" class="form-control" id="picture" name="picture" placeholder="picture">
        <label for="picture">Picture</label>
      </div>

      <div class="form-floating mb-3">
        <textarea class="form-control" name="description" placeholder="Description" id="description"><?= $row['description'] ?? "" ?></textarea>
        <label for="description">Description</label>
      </div>

      <button name="edit" class="btn btn-dark px-5">Edit</button>
    </form>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>