<?php header('Content-Type: application/json');

require_once('main_db.php');
require_once('mail/send.php');

$email = $_REQUEST['email'];
$body = "";
$users = array();

if((!empty($email) && $email != NULL)){

    $query = "SELECT p.name,l.user_name user_name, l.password FROM login l, user u, role r, permission p WHERE u.id = l.user_id AND l.id = r.login_id
                        AND p.id = r.permission_id AND u.email = '$email' AND u.status = 1";

    $execute = mysqli_query($con, $query);
    $count = mysqli_num_rows($execute);

    if($count > 0){
        $body = $body . 'Hi,<br>';
        $body = $body . 'We have received a forgot password request and here are the login credentials.<br>';
        $body = $body . 'Make sure to change your login credentials.<br>';
        $body = $body . 'Go to: https://pibt.guruwaru.com/<br><br>';
        $body = $body . '<table><tbody>';

        while($user = mysqli_fetch_assoc($execute)) {
            $userType = $user['name'];
            $userName = $user['user_name'];
            $password = $user['password'];
            $body = $body . "<tr style='width: 150px;'><td>User Type</td><td style='width: 10px;'>:</td><td>$userType</td></tr>";
            $body = $body . "<tr style='width: 150px;'><td>User Name</td><td style='width: 10px;'>:</td><td><strong>$userName</strong></td></tr>";
            $body = $body . "<tr style='width: 150px;'><td>Password</td><td style='width: 10px;'>:</td><td><strong>$password</strong></td></tr>";
            $body = $body . "<tr><td> </td></tr>";
        }

        $body = $body . '</tbody></table>';
        $body = $body . '<br>';
        $body = $body . 'Greetings.<br>';
        $body = $body . '<strong>PIBT - SMS</strong>';

    } else {
        $message = "empty";
    }
} else{
    $message = "empty";
}

mysqli_close($con);

$mail->addAddress($email);

$mail->isHTML(true);
$mail->Subject = 'Retrieve Login Credentials';
$mail->Body = $body;
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: '.$mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}