<?php

$host = "213.165.242.4";
$user = "nffc8c5_dmal_not_del";
$pass = "JwgSmw3@kff6zcY";
$dbName = "nffc8c5_BE20_CR5_animal_adoption_DmitriiMalyshkin";

$conn = mysqli_connect($host, $user, $pass, $dbName);

if (!$conn) {
  echo "No connection";
}
