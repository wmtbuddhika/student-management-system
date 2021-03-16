<?php header('Content-Type: application/json');

require_once('main_db.php');
require_once('mail/send.php');

$allocationId = $_REQUEST['allocation_id'];
$students = $_REQUEST['students'];

$body = "";
$users = array();

if((!empty($students) && $students != NULL)){

    foreach ($students as $student) {
        $query = "SELECT u.email, ag.code, ag.name group_name, m.name module_name, b.name batch_name 
                    FROM allocation_group ag, allocation a, user u, module m, batch b 
                    WHERE a.student_id = u.id AND ag.module_id = m.id AND ag.batch_id = b.id AND ag.id = a.allocation_group_id 
                    AND a.allocation_group_id = $allocationId AND a.student_id = '$student' 
                    AND a.status = 1";

        $execute = mysqli_query($con, $query);
        $count = mysqli_num_rows($execute);

        if ($count > 0) {
            $body = $body . 'Hi,<br>';
            $body = $body . 'You have allocated for following Group<br>';
            $body = $body . 'Go to: https://guruwaru.com/<br><br>';
            $body = $body . '<table><tbody>';

            while ($user = mysqli_fetch_assoc($execute)) {
                $code = $user['code'];
                $name = $user['group_name'];
                $batch_name = $user['batch_name'];
                $module_name = $user['module_name'];
                $email = $user['email'];
                $body = $body . "<tr><td style='width: 150px;'>Group Name</td><td style='width: 10px;'>:</td><td>$name</td></tr>";
                $body = $body . "<tr><td style='width: 150px;'>Group Code</td><td style='width: 10px;'>:</td><td><strong>$code</strong></td></tr>";
                $body = $body . "<tr><td style='width: 150px;'>Batch Name</td><td style='width: 10px;'>:</td><td><strong>$batch_name</strong></td></tr>";
                $body = $body . "<tr><td style='width: 150px;'>Module Name</td><td style='width: 10px;'>:</td><td><strong>$module_name</strong></td></tr>";
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
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }

        } else {
            $message = "empty";
        }
    }
} else{
    $message = "empty";
}

mysqli_close($con);