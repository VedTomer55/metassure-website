<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'config.php';
// User-defined variables
$userName = $_POST['UserName']; 
$userEmail = $_POST['UserEmail']; 
$subject = $_POST['subject']; 
$message = $_POST['message']; 

// Page URL
$pageURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 

// Recipient's email address
$recipientEmail = "insurance.support@verismart.ai";


$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 0; 
    $mail->isSMTP();
    $mail->Host = $smtpHost; 
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUsername; 
    $mail->Password = $smtpPassword; 
    $mail->SMTPSecure = $smtpSecure; 
    $mail->Port = $smtpPort; 

    $mail->setFrom("insurance.support@verismart.ai");

    // Recipient
    $mail->addAddress($recipientEmail);

    // Email content
    $mail->isHTML(true); 
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
