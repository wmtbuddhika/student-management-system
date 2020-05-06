<?php header('Content-Type: application/json');

require_once('main_db.php');
require_once('mail/send.php');

$email = $_REQUEST['email'];
$userName = $_REQUEST['userName'];
$userType = $_REQUEST['userType'];
$password = $_REQUEST['password'];
$body = "";
$users = array();

if((!empty($email) && $email != NULL)){

    if ($userType == 1) {
        $userType = 'Admin';
    } else if ($userType == 2) {
        $userType = 'Tutor';
    } else if ($userType == 3) {
        $userType = 'Student';
    }

    $body = $body . 'Hi,<br>';
    $body = $body . 'Here is your login credentials for PIBT Student Management System.<br>';
    $body = $body . 'Make sure to change your login credentials.<br>';
    $body = $body . 'Go to: https://pibt.guruwaru.com/<br><br>';
    $body = $body . '<table><tbody>';

    $body = $body . "<tr style='width: 150px;'><td>User Type</td><td style='width: 10px;'>:</td><td>$userType</td></tr>";
    $body = $body . "<tr style='width: 150px;'><td>User Name</td><td style='width: 10px;'>:</td><td><strong>$userName</strong></td></tr>";
    $body = $body . "<tr style='width: 150px;'><td>Password</td><td style='width: 10px;'>:</td><td><strong>$password</strong></td></tr>";
    $body = $body . "<tr><td> </td></tr>";

    $body = $body . '</tbody></table>';
    $body = $body . '<br>';
    $body = $body . 'Greetings.<br>';
    $body = $body . '<strong>PIBT - SMS</strong>';

} else{
    $message = "empty";
}

mysqli_close($con);

$mail->addAddress($email);

$mail->isHTML(true);
$mail->Subject = 'New Login Credentials';
$mail->Body = $body;
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: '.$mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}