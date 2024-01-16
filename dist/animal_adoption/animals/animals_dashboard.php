<?php

session_start();

if (!isset($_SESSION["adm"])) {
  header("Location: ../home.php");
}

require_once "../components/db_connect.php";
require_once "../components/navbar.php";

$sql = "SELECT * FROM `animals` WHERE 1";
$result = mysqli_query($conn, $sql);

$rows = "";

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $rows .= "
    <tr>
    <th scope='row'>$row[id]</th>
    <td><img class='rounded img-thumbnail asp-1 object-fit-cover shadow-sm' src='../pictures/$row[picture]' alt='' width='60px'></td>
    <td>$row[name]</td>
    <td>$row[age]</td>
    <td>$row[size]</td>
    <td>$row[breed]</td>
    <td>$row[vaccinated]</td>
    <td>$row[location]</td>
    <td>$row[status]</td>
    <td>
    <div class='d-flex flex-nowrap'>
    <div class='btn-group btn-group-sm me-4 my-1' role='group' aria-label='Basic mixed styles example'>
    <a href='details.php?id=$row[id]' class='btn btn-dark'>Details</a>
    <a href='update.php?id=$row[id]' class='btn btn-outline-dark'>Edit</a>
    </div>
    <a href='delete.php?id=$row[id]' class='btn btn-sm btn-outline-danger my-1'>Delete</a>
    </div>
    </td>
  </tr>
    ";
  }
} else {
  $rows = "No data found.";
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
  <title>Animals Dashboard</title>
</head>

<body>
  <?= $navbar ?>

  <div class="container my-5 pt-5">
    <h1 class="text-center my-4">Animals Dashboard</h1>

    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Pic</th>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Size</th>
            <th scope="col">Breed</th>
            <th scope="col">Vaccinated</th>
            <th scope="col">Location</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?= $rows ?>
        </tbody>
      </table>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>