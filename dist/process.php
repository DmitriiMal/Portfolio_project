<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
  $recaptcha_secret = '6LdNSVkpAAAAAL_TW7da0K7EiGlnXd5HX91NIBkv';
  $recaptcha_response = $_POST['g-recaptcha-response'];

  $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
  $recaptcha = json_decode($recaptcha, true);

  if ($recaptcha['success'] == 1 && $recaptcha['score'] >= 0.5 && $recaptcha['action'] == 'send') {


    $name = $_POST["name"];
    $subject = $_POST["subject"];
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); // simple validation if you insert an email
    $phone = $_POST["phone"];
    $msg = $_POST["msg"];

    $msg = "From: $name\r\n $email\r\n $phone" . "\r\n" . "\r\n" . "$msg";

    //////// $headers = "FROM :  $name \r\n $email \r\n $phone \r\n";
    //////// $headers = [$name, $email, $phone];
    //////// $headers = "FROM : Test";
    //////// $headers = "FROM : " . $name . $email . $phone . "\r\n";
    $myEmail = "dmitrii@malyshkin.net";

    if (mail($myEmail, $subject, $msg, $headers)) {
      // echo "sent";
      header('Refresh:5; https://malyshkin.net/contact.html');
      echo 'Thank you for your message! You\'ll be redirected in about 5 secs. If not, click <a href="https://malyshkin.net/contact.html">here</a>.';
    } else {
      echo "error";
    }
  } else {
    header('Refresh:30; https://malyshkin.net/contact.html');
    echo 'Something went wrong :( You\'ll be redirected in about 30 secs. If not, click <a href="https://malyshkin.net/contact.html">here</a>.';
  }
}
