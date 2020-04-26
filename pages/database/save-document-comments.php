<?php header('Content-Type: application/json');

require_once('main_db.php');

$documentId = $_REQUEST['document_id'];
$comment = $_REQUEST['comment'];
$userId = $_REQUEST['user_id'];

if((!empty($documentId) && $documentId != NULL) && !empty($userId) && $userId != NULL) {

    $query = "INSERT INTO document_comment (comment, document_id, user_id) VALUES ('$comment', $documentId, $userId)";
    $query_execute = mysqli_query($con, $query);
}

//Connection Close
mysqli_close($con);

$response['response'] = 'success';

echo json_encode($response);
