<?php
if (isset($_POST["send"]) && $_SERVER['REQUEST_METHOD'] == 'POST') { // Check if the User coming from a request
  $name = $_POST["name"];
  $subject = $_POST["subject"];
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); // simple validation if you insert an email
  $phone = $_POST["phone"];
  $msg = $_POST["msg"];


  $msg = "From: $name\r\n $email\r\n $phone" . "\r\n" . "\r\n" . "$msg";

  // $headers = "FROM :  $name \r\n $email \r\n $phone \r\n";
  // $headers = [$name, $email, $phone];
  // $headers = "FROM : Test";
  // $headers = "FROM : " . $name . $email . $phone . "\r\n";
  $myEmail = "dmitrii@malyshkin.net";

  if (mail($myEmail, $subject, $msg, $headers)) {
    echo "sent";
    header('Location: ' . 'contact.html');
  } else {
    echo "error";
  }
}
