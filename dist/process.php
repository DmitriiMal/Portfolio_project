<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') { // Check if the User coming from a request
  $name = $_POST["name"];
  $subject = $_POST["subject"];
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); // simple validation if you insert an email
  $phone = $_POST["phone"];
  $msg = $_POST["msg"]; // simple validation if you insert a string

  // mail function in php look like this  (mail(To, subject, Message, Headers, Parameters))
  $headers = "FROM : " . $name . $email . $phone . "\r\n";
  $myEmail = "dmitrii@malyshkin.net";
  if (mail($myEmail, $subject, "message coming from the contact form", $msg, $headers)) {
    echo "sent";
  } else {
    echo "error";
  }
}
