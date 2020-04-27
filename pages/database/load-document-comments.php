<?php header('Content-Type: application/json');

require_once('main_db.php');

$documentId = $_REQUEST['document_id'];
$comments = array();

if((!empty($documentId) && $documentId != NULL)) {

    $query = "SELECT d.file_name file_name, IFNULL(u.name,'-') user_name, IFNULL(dc.comment,'-') comment, IFNULL(dc.created_date,'-') created_date, d.id document_id
                FROM document d LEFT JOIN document_comment dc ON d.id = dc.document_id LEFT JOIN user u 
                ON dc.user_id = u.id WHERE d.id = $documentId";

    $execute = mysqli_query($con, $query);
    $row_count = mysqli_num_rows($execute);

    while($comment = mysqli_fetch_assoc($execute)){
        array_push($comments, $comment);
    }
}

//Connection Close
mysqli_close($con);

$response['comments'] = $comments;

echo json_encode($response);
