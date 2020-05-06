<?php header('Content-Type: application/json');

require_once('main_db.php');
require_once('mail/send.php');

$batch = $_REQUEST['batch'];
$module = $_REQUEST['module'];
$tutor = $_REQUEST['tutor'];
$code = $_REQUEST['code'];
$name = $_REQUEST['name'];

$body = "";
$users = array();

if((!empty($tutor) && $tutor != NULL)){

    $query = "SELECT m.name module_name, b.name batch_name, u.email FROM allocation_group ag, user u, module m, batch b 
                WHERE ag.batch_id = b.id AND ag.module_id = m.id AND ag.tutor_id = u.id AND u.id = $tutor AND ag.code = '$code'
                AND u.status = 1 AND m.status = 1 AND b.status = 1 AND ag.status = 1";

    $execute = mysqli_query($con, $query);
    $count = mysqli_num_rows($execute);

    if($count > 0){
        $body = $body . 'Hi,<br>';
        $body = $body . 'You have allocated for following Group<br>';
        $body = $body . 'Go to: https://pibt.guruwaru.com/<br><br>';
        $body = $body . '<table><tbody>';

        while($user = mysqli_fetch_assoc($execute)) {
            $module_name = $user['module_name'];
            $batch_name = $user['batch_name'];
            $email = $user['email'];
            $body = $body . "<tr><td style='width: 200px;'>Group Name</td><td style='width: 10px;'>:</td><td>$name</td></tr>";
            $body = $body . "<tr><td style='width: 200px;'>Group Code</td><td style='width: 10px;'>:</td><td><strong>$code</strong></td></tr>";
            $body = $body . "<tr><td style='width: 200px;'>Batch Name</td><td style='width: 10px;'>:</td><td><strong>$batch_name</strong></td></tr>";
            $body = $body . "<tr><td style='width: 200px;'>Module Name</td><td style='width: 10px;'>:</td><td><strong>$module_name</strong></td></tr>";
            $body = $body . "<tr><td> </td></tr>";
        }

        $body = $body . '</tbody></table>';
        $body = $body . '<br>';
        $body = $body . 'Greetings.<br>';
        $body = $body . '<strong>PIBT - SMS</strong>';

        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'New Group Allocation';
        $mail->Body = $body;
        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: '.$mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }

    } else {
        $message = "empty";
    }
} else{
    $message = "empty";
}

mysqli_close($con);