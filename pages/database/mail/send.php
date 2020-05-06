<?php
$mail_host = "guruwaru.com";
$mail_security_channel = "tls";
$mail_port = 25;
$mail_user = "pibt@guruwaru.com";
$mail_password = "XCGoU=6Z(UZy";
$smtp_auth = true;

$reply_email = "noreply@guruwaru.com"; //Reply to this email ID
$sender_email = "pibt@guruwaru.com";
$sender_name = "PIBT - SMS";

require("phpmailer/PHPMailerAutoload.php");

$mail = new PHPMailer();

//$mail->SMTPDebug = 4; // Uncomment this line to enable verbose debug output

$mail->IsSMTP(); // send via SMTP
$mail->Host = $mail_host;
$mail->SMTPAuth = $smtp_auth; // turn on SMTP authentication
$mail->Username = $mail_user; // SMTP username
$mail->Password = $mail_password; // SMTP password
$mail->SMTPSecure = $mail_security_channel;
$mail->Port = $mail_port;

$mail->setFrom($sender_email, $sender_name);
//$mail->addReplyTo($reply_email, $sender_name);

//Recepient 1
//	$mail->addAddress("wmtbmail@gmail.com", "Tushara");
//Recepient 2
//	$mail->addAddress("dulanjansej@gmail.com", "Dulanjan Madusanka");
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//	$mail->isHTML(true);                                  // Set email format to HTML

//	$mail->Subject = 'THIS IS A TEST MAIL. PLEASE IGNIRE THIS';
//	$mail->Body    = 'THIS IS A TEST MAIL. <b>PLEASE IGNIRE THIS MAIL</b>.';
//	$mail->AltBody = 'This is TEST MAIL.';

//	if(!$mail->send()) {
//		echo 'Message could not be sent.';
//		echo 'Mailer Error: '.$mail->ErrorInfo;
//	} else {
//		echo 'Message has been sent';
//	}
