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
                    $allocationId = $_SESSION['allocation_id'];
                    if ($allocationId != null) {
                        $userId = $_SESSION['user_id'];
                        $userType = $_SESSION['user_type'];

                        $query = "SELECT d.id document_id, d.uuid, d.file_name, ag.code FROM document d, allocation_group ag 
                                WHERE d.allocation_id = ag.id AND d.allocation_id IN ($allocationId) AND d.status = 1 ";

                        if ($userType == 3) {
                            $query = $query . "AND (SELECT COUNT(a.id) FROM allocation a WHERE a.student_id = $userId AND a.status = 1 AND a.allocation_group_id = ag.id) > 0";
                        }

                        $execute = mysqli_query($con, $query);
                        while ($doc = mysqli_fetch_assoc($execute)) {
                            $filepath = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $doc['uuid'] . "|" . $doc['file_name'];

                            echo '<div class="img-box">';
                            echo '<span>Group : ' . $doc['code'] . '<br> ' . $doc['file_name'] . '</span><br>';
                            echo '<img class="document" id="' . $doc['document_id'] . '" onclick="loadComments(this.id)" src="/assets/images/doc-icon.png" width="100"">';
                            echo '<p><a class="label label-info" href="./../pages/document-management/download.php?file=' . urlencode($filepath) . '">Download</a></p>';
                            echo '</div>';
                        }
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