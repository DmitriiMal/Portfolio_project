<?php

session_start();

if (!isset($_SESSION["adm"])) {
  header("Location: ../home.php");
}

require_once "../components/db_connect.php";

if (isset($_GET["id"]) && !empty($_GET["id"])) {
  $id = $_GET["id"];
  $sql = "SELECT * FROM `animals` WHERE `id` = $id";
  $result = mysqli_query($conn, $sql);

  $row = mysqli_fetch_assoc($result);
  if ($row["picture"] !== "animal.png") {
    unlink("../pictures/$row[picture]");
  }

  $sql = "DELETE FROM `animals` WHERE `id` = $id";
  mysqli_query($conn, $sql);

  mysqli_close($conn);
  header("Location: animals_dashboard.php");
} else {
  mysqli_close($conn);
  header("Location: animals_dashboard.php");
}
