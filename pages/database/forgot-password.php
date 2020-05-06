<?php header('Content-Type: application/json');

require_once('main_db.php');
require_once('mail/send.php');

$email = $_REQUEST['email'];
$users = array();

if((!empty($email) && $email != NULL)){

    $query = "SELECT u.id FROM login l, user u, role r WHERE u.id = l.user_id AND l.id = r.login_id
                        AND u.email = '$email' AND u.status = 1";

    $execute = mysqli_query($con, $query);
    $count = mysqli_num_rows($execute);

    if($count > 0){
        $message = "success";
    } else {
        $message = "empty";
    }
} else{
    $message = "empty";
}

//Connection Close
mysqli_close($con);

$response['result'] = $message;

echo json_encode($response);