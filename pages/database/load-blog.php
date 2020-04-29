<?php

require_once('main_db.php');
session_start();

$enteredBy = $_SESSION['user_id'];

$blogId = $_REQUEST['blog_id'];

$blogs = array();

if((!empty($blogId) || $blogId != null)){

    $query = "SELECT b.id,b.content,b.title FROM blog b WHERE b.id = $blogId";

    $query_execute = mysqli_query($con, $query);

    while($blog = mysqli_fetch_assoc($query_execute)){
        array_push($blogs, $blog);
    }
}
mysqli_close($con);

$response['blog'] = $blogs;
echo (json_encode($response));
