<?php header('Content-Type: application/json');

require_once('main_db.php');

$blogId = $_REQUEST['blog_id'];
$comments = array();

if((!empty($blogId) && $blogId != NULL)) {

    $query = "SELECT b.title title, IFNULL(u.name,'-') user_name, IFNULL(bc.comment,'-') comment, IFNULL(bc.created_date,'-') created_date, b.id blog_id
                FROM blog b LEFT JOIN blog_comment bc ON b.id = bc.blog_id LEFT JOIN user u 
                ON bc.user_id = u.id WHERE b.id = $blogId";

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
