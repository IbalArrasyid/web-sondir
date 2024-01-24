<?php

$servername = "hostname or IP address of the MySQL server";
$username = "username";
$password = "password";
$dbname = "form_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the form was submitted
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['message'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $message = $_POST['message'];

  // Insert form data into the database
  $sql = "INSERT INTO form (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
  if ($conn->query($sql) === TRUE) {
    echo "Form data was successfully saved to the database.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Send email
  $to = "office@gamma-sc.com";
  $subject = "New Form Submission";
  $body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message";
  $headers = "From: $email";
  if (mail($to, $subject, $body, $headers)) {
    echo "Your message has been sent!";
  } else {
    echo "There was an error sending your message. Please try again";
  }
}

$conn->close();

?>
