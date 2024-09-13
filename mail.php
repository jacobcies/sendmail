<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$mail = new PHPMailer(true);

if ( ($_POST['name']!="") && ($_POST['email']!="")){
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

                           
try {
    //Server settings
    $mail->CharSet = "UTF-8";
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mx.yourserver.mail';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'mail@yourserver.mail';                 // SMTP username
    $mail->Password = 'Password';                           // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('email@youremail.com', 'Plany Gdańska');
    $mail->addAddress('email@youremail.com', 'Plany Gdańska');     // Add a recipient
    $mail->addReplyTo($email, $name);

    //Content 
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Message';
    $mail->Body    = "$name<br>$email<br><br>$message";


    $mail->send();
    echo 'Thank you. Your message has been sent.';
} catch (Exception $e) {
    echo 'The message could not be sent<br>Mailer Error: ', $mail->ErrorInfo;
}}
else {
    echo "The message was not sent";
}
?>
