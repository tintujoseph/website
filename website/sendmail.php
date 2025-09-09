<?php

// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Define your email address where you want to receive the messages
    $to = "thintujoseph98@gmail.com";

    // Sanitize and validate the form inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Simple validation to ensure fields are not empty
    if (empty($name) || empty($email) || empty($message)) {
        http_response_code(400); // Bad Request
        echo "Please fill out all the fields.";
        exit;
    }

    // Email subject
    $subject = "New Contact Form Submission from " . $name;

    // Email body
    $email_body = "You have received a new message from your website contact form.\n\n" .
                  "Name: $name\n" .
                  "Email: $email\n\n" .
                  "Message:\n$message";

    // Email headers
    $headers = "From: noreply@h2c.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($to, $subject, $email_body, $headers)) {
        // Success message and redirection
        echo "<script>alert('Thank you! Your message has been sent.'); window.location.href = 'index.html';</script>";
    } else {
        // Error message
        http_response_code(500); // Internal Server Error
        echo "Oops! Something went wrong. Please try again later.";
    }

} else {
    // Not a POST request, redirect to the form
    header("Location: index.html");
    exit;
}

?>