<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// User-defined variables
$userName = $_POST['UserName']; 
$userEmail = $_POST['UserEmail']; 
$subject = $_POST['subject']; 
$message = $_POST['message']; 

// Page URL
$pageURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // Replace with your actual page URL

// Recipient's email address
$recipientEmail = "insurance.support@verismart.ai";

// Create a PHPMailer object
$mail = new PHPMailer(true);

try {
    // SMTP server settings
    $mail->SMTPDebug = 2; // Set to 2 for debugging
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'insurance.support@verismart.ai'; // Replace with your SMTP username
    $mail->Password = 'ihltfgyshudohzsx'; // Replace with your SMTP password
    $mail->SMTPSecure = 'ssl'; // Use 'tls' or 'ssl' depending on your server configuration
    $mail->Port = 465; // Change to the appropriate SMTP port

    // Sender information
    $mail->setFrom("insurance.support@verismart.ai");

    // Recipient
    $mail->addAddress($recipientEmail);

    // Email content
    $mail->isHTML(true); // Set to true to send HTML email
    $mail->Subject = $subject;
    
    // Build a styled HTML message
    $htmlMessage = "
        <html>
        <head>
            <title>$subject</title>
            <style>
                /* Define your CSS styles here */
                body {
                    font-family: Arial, sans-serif;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                }
                .message {
                    background-color: #f4f4f4;
                    padding: 20px;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>$subject</h1>
                <div class='message'>
                    <p>Name: $userName</p>
                    <p>Email: $userEmail</p>
                    <p>Message: $message</p>
                    <p>Page URL: <a href='$pageURL'>$pageURL</a></p>
                </div>
            </div>
        </body>
        </html>
    ";
    
    $mail->msgHTML($htmlMessage);

    // Send the email
    $mail->send();
    echo "Email sent successfully to $recipientEmail";
} catch (Exception $e) {
    echo "Email sending failed: {$mail->ErrorInfo}";
}
?>
