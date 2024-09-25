<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Basic validation for empty fields
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Please fill in all fields.";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address.";
        exit;
    }

    // Email address where the message will be sent
    $recipient = "abdealipoonawala20@gmail.com"; // Replace with your actual email address

    // Email subject
    $mail_subject = "Contact Form Submission: " . $subject;

    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($recipient, $mail_subject, $email_content, $headers)) {
        // Redirect or display success message
        echo "Thank you for contacting us, $name. We'll get back to you shortly!";
    } else {
        // Display error message if mail fails
        echo "Sorry, something went wrong. Please try again.";
    }
} else {
    // Redirect to form if not a POST request
    header("Location: contact_form.html");
    exit();
}
?>
