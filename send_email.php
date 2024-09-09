<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Check that data was sent to the mailer.
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // If data is missing, show an error and stop the script.
        echo "Oops! There was a problem with your submission. Please complete the form and try again.";
        exit;
    }

    // Set the recipient email address.
    $recipient = "pratik@knowflowconsulting.com";

    // Set the email subject.
    $subject = "Website message from $name";

    // Build the email content.
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Redirect to a thank you page (optional).
        header("Location: thank_you.html");
    } else {
        // If mail() fails, display an error.
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }
} else {
    // If the form wasn't submitted properly, display an error.
    echo "There was a problem with your submission. Please try again.";
}
?>