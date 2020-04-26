<div class="row">
    <div class="col-md-12">
        <!-- START MASKED INPUT PLUGIN -->
        <div class="panel panel-default">
            <div class="panel-body">
                <input type="hidden" name="user_id" id="user_id" value="0">
                <hr><h3 class="text-uppercase">uploaded documents</h3><hr>
                <form class="form-horizontal" role="form" enctype="multipart/form-data" id="main-form" method="POST">
                    <?php
                    require_once('./pages/database/main_db.php');

                    $query = "SELECT document_id, uuid, file_name FROM document WHERE status = 1";
                    $execute = mysqli_query($con, $query);
                    while($doc = mysqli_fetch_assoc($execute)){
                        $filepath = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $doc['uuid'] . "|" . $doc['file_name'];

                        echo '<div class="img-box">';
                        echo '<span>'. $doc['file_name'] . '</span><br>';
                        echo '<img class="document" id="' . $doc['document_id']. '" onclick="loadComments(this.id)" src="/assets/images/doc-icon.png" width="100"">';
                        echo '<p><a class="label label-info" href="./../pages/document-management/download.php?file=' . urlencode($filepath) . '">Download</a></p>';
                        echo '</div>';
                    }
                    mysqli_close($con);
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .img-box{
        display: inline-block;
        text-align: center;
        margin: 0 15px;
    }
</style>