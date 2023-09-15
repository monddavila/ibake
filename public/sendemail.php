<?php
if (isset($_POST["username"])) {
    // Read the form values
    $userName = isset($_POST['username']) ? sanitizeInput($_POST['username']) : "";
    $senderEmail = isset($_POST['email']) ? sanitizeInput($_POST['email']) : "";
    $message = isset($_POST['contact_message']) ? sanitizeInput($_POST['contact_message']) : "";

    // Validate email format
    if (!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="failed">Error: Invalid email format.</div>';
        exit;
    }

    // Recipient
    $to = "teammed.amauonline@gmail.com"; // Your email address goes here
    $subject = 'Contact Us';
    
    // Headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    
    // Body message
    $messageBody = "Name: " . $userName . "<br>";
    $messageBody .= "Email: " . $senderEmail . "<br>";
    $messageBody .= "Message: " . $message;
    
    // Email Send Function
    $send_email = mail($to, $subject, $messageBody, $headers);
    
    if ($send_email) {
        echo '<div class="success">Email has been sent successfully.</div>';
    } else {
        echo '<div class="failed">Error: Failed to send. Please try again later.</div>';
    }
} else {
    echo '<div class="failed">Error: Form fields are not set.</div>';
}

// Function to sanitize user input
function sanitizeInput($input)
{
    return preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $input);
}
?>
