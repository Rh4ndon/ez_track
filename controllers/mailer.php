<?php
// Import PHPMailer classes

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

function send_email($email, $name, $message, $alt_message, $subject)
{
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();                                      // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';             // SMTP server
        $mail->SMTPAuth   = true;                             // Enable SMTP authentication
        $mail->Username   = 'eztracksystem@gmail.com';      // Your email address
        $mail->Password   = 'movt nego vofi qcxb';                // Your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('eztracksystem@gmail.com', 'EZTrack System');
        $mail->addAddress($email, $name);
        $mail->addReplyTo('eztracksystem@gmail.com', 'EZTrack System');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = $alt_message;

        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
/*
Test code

send_email(
    'daverhandon@gmail.com',
    'Sample',
    '
    <h3>Good day, Sample</h3>
    <p>Here is your OTP: <b>123456</b></p>
    <p>Thanks for using our service.</p>
    <p>EZTrack System</p>
    ',
    '
    Good day, Sample
    Here is your OTP: 123456
    Thanks for using our service.
    EZTrack System
    ',
    'EZTrack System OTP'
);
*/
