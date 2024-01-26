<?php

function clean($data)
{
  $data = trim($data);
  $data = htmlspecialchars($data);
  $data = strip_tags($data);
  return $data;
}


$name = $email = $msg = $subject = $phone = "";
$nameError = "";
$emailError = "";
$msgError = "";
$outputMessage = "";
// $response = [];
$error = false;

// if (isset($_POST['name']) && $_POST['subject'] && $_POST['email'] && $_POST['phone'] && $_POST['msg']) {
if (true) {
  $name = clean($_POST['name']);
  $subject = clean($_POST['subject']);
  $email = clean($_POST['email']);
  $phone = clean($_POST['phone']);
  $msg = clean($_POST['msg']);
  $myEmail = "dmitrii@malyshkin.net";

  // Name validation
  if (empty($name)) {
    $error = true;
    $nameError = 'Please, enter your name';
  } elseif (strlen($name) < 2) {
    $error = true;
    $nameError = 'Name has to contain at least 2 characters.';
  } elseif (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
    $error = true;
    $nameError = 'Name has to contain only letters and spaces';
  }

  // Email validation
  if (empty($email)) {
    $error = true;
    $emailError = 'Please, enter your email';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $emailError = 'Please enter a valid email address';
  }

  // Message validation
  if (empty($msg)) {
    $error = true;
    $msgError = 'Please, enter your message';
  } elseif (strlen($msg) < 5) {
    $error = true;
    $msgError = 'Message has to contain at least 5 characters';
  }

  if (!$error) {

    $msg = "From: $name\r\n $email\r\n $phone" . "\r\n" . "\r\n" . "$msg";

    if (mail($myEmail, $subject, $msg, $headers)) {
      $outputMessage = 'success';
    } else {
      $outputMessage = 'Something went wrong, please try again later';
    }
  } else {
    $outputMessage = 'Please fill in all the fields';
  }
}


// $response array
$response['outputMessage'] = $outputMessage;
$response['nameError'] = $nameError;
$response['emailError'] = $emailError;
$response['msgError'] = $msgError;

$json_response = json_encode($response);

// Outputting JSON to the client
echo $json_response;


///////////////////////////////////////////////////////////











// $name = $email = $msg = $subject = $phone = "";
// $nameError = $emailError = $msgError = "";
// $error = false;


// if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//   $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
//   $recaptcha_secret = '6LdNSVkpAAAAAL_TW7da0K7EiGlnXd5HX91NIBkv';
//   $recaptcha_response = $_POST['g-recaptcha-response'];

//   $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
//   $recaptcha = json_decode($recaptcha, true);

//   if ($recaptcha['success'] == 1 && $recaptcha['score'] >= 0.5 && $recaptcha['action'] == 'send') {

//     $name = $_POST["name"];
//     $subject = $_POST["subject"];
//     $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); // simple validation if you insert an email
//     $phone = $_POST["phone"];
//     $msg = $_POST["msg"];


//     if (!$error) {
//       $msg = "From: $name\r\n $email\r\n $phone" . "\r\n" . "\r\n" . "$msg";

//       //////// $headers = "FROM :  $name \r\n $email \r\n $phone \r\n";
//       //////// $headers = [$name, $email, $phone];
//       //////// $headers = "FROM : Test";
//       //////// $headers = "FROM : " . $name . $email . $phone . "\r\n";
//       $myEmail = "dmitrii@malyshkin.net";

//       if (mail($myEmail, $subject, $msg, $headers)) {
//         header('Refresh:5; https://malyshkin.net/contact.html');
//         echo 'Thank you for your message! You\'ll be redirected in about 5 secs. If not, click <a href="https://malyshkin.net/contact.html">here</a>.';
//       } else {
//         echo "error";
//       }
//     } else {

//       header('Refresh:30; https://malyshkin.net/contact.html');
//       echo 'Error message :( You\'ll be redirected in about 30 secs. If not, click <a href="https://malyshkin.net/contact.html">here</a>.';
//     }
//   } else {
//     header('Refresh:30; https://malyshkin.net/contact.html');
//     echo 'Something went wrong :( You\'ll be redirected in about 30 secs. If not, click <a href="https://malyshkin.net/contact.html">here</a>.';
//   }
// }
