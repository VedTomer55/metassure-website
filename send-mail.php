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

// Recipient's email address
$recipientEmail = "vedtomer@gmail.com";

// Create a PHPMailer object
$mail = new PHPMailer(true);

try {
    // SMTP server settings
    $mail->SMTPDebug = 2; // Set to 2 for debugging
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'help@namastebaba.com'; // Replace with your SMTP username
    $mail->Password = 'Ved@5592'; // Replace with your SMTP password
    $mail->SMTPSecure = 'tls'; // Use 'tls' or 'ssl' depending on your server configuration
    $mail->Port = 587; // Change to the appropriate SMTP port

    // Sender information
    $mail->setFrom("help@namastebaba.com", $userName);

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
