<div class="row" id="blog-details">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" id="blog-form">
                    <input type="hidden" id="blog_id" name="blog_id" value="">
                    <hr><h3 class="text-uppercase">add blog</h3><hr>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Group *</label>
                        <div class="col-md-6">
                            <select id="allocation_id" class="form-control select" data-live-search="true" required>
                                <?php
                                require_once('./pages/database/main_db.php');
                                $userId = $_SESSION['user_id'];
                                $allocationId = $_SESSION['allocation_id'];
                                $userType = $_SESSION['user_type'];
                                $query = "SELECT DISTINCT ag.id, ag.code FROM allocation_group ag, allocation a WHERE a.allocation_group_id = ag.id AND ag.status = 1 ";

                                if ($allocationId != null && $userType != 1) {
                                    $query = $query . "AND a.status = 1 AND ag.id IN ($allocationId) AND IF($userType = 3, a.student_id = $userId, ag.tutor_id = $userId)";
                                }
                                $result = mysqli_query($con, $query);

                                while($data = mysqli_fetch_array($result)){
                                    ?>
                                    <option value="<?php echo $data['id'];?>"><?php echo $data['code']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Title *</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="title" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea class="summernote_email" id="blog"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="btn-group pull-right">
                                <button class="btn btn-primary text-uppercase" type="submit">save</button>
                            </div>
                        </div>
                    </div>
                </form>
                <h4>
                </h4>
            </div>
        </div>
    </div>
</div>

<style>
    .my-file {
        border: 2px solid gray;
        color: gray;
        background-color: white;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 20px;
        font-weight: bold;
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 15px;
    }
</style>
