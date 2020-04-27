<?php header('Content-Type: application/json');

require_once('main_db.php');

$blogId = $_REQUEST['blog_id'];
$comment = $_REQUEST['comment'];
$userId = $_REQUEST['user_id'];

if((!empty($blogId) && $blogId != NULL) && !empty($userId) && $userId != NULL) {

    $query = "INSERT INTO blog_comment (comment, blog_id, user_id) VALUES ('$comment', $blogId, $userId)";
    $query_execute = mysqli_query($con, $query);
}

//Connection Close
mysqli_close($con);

$response['response'] = 'success';

echo json_encode($response);
