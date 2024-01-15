<?php
if (isset($_POST["send"]) && $_SERVER['REQUEST_METHOD'] == 'POST') { // Check if the User coming from a request
  echo "send is set" . "<br>";
  $name = $_POST["name"];
  $subject = $_POST["subject"];
  // $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); // simple validation if you insert an email
  // $email = $_POST["email"]; // simple validation if you insert an email
  // $phone = $_POST["phone"];
  $msg = $_POST["msg"];


  $msg = "From $name, $msg";

  // $headers = "FROM : " . $name . $email . $phone . "\r\n";
  $myEmail = "dmitrii@malyshkin.net";

  if (mail($myEmail, $subject, $msg, $headers)) {
    echo "sent";
  } else {
    echo "error";
  }
}
