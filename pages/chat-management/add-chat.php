<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" id="chat-form">
                    <hr><h3 class="text-uppercase">Messages</h3><hr>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Group *</label>
                        <div class="col-md-6">
                            <select onchange="loadChat(this.value)" id="allocation_id" class="form-control select" data-live-search="true" required>
                                <?php
                                require_once('./pages/database/main_db.php');
                                $userId = $_SESSION['user_id'];
                                $allocationId = $_SESSION['allocation_id'];
                                $userType = $_SESSION['user_type'];
                                $batch_query = "SELECT DISTINCT ag.id, ag.code FROM allocation_group ag, allocation a WHERE a.allocation_group_id = ag.id AND ag.status = 1 ";

                                if ($allocationId != null && $userType != 1) {
                                    $batch_query = $batch_query . "AND a.status = 1 AND ag.id IN ($allocationId) AND IF($userType = 3, a.student_id = $userId, ag.tutor_id = $userId)";
                                }
                                $result = mysqli_query($con, $batch_query);

                                while($data = mysqli_fetch_array($result)){
                                    ?>
                                    <option value="<?php echo $data['id'];?>"><?php echo $data['code']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="content-frame-body content-frame-body-left">
                        <div class="messages messages-img" id="message-history">
                        </div>
                        <div class="panel panel-default push-up-10">
                            <div class="panel-body panel-body-search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Your message..." id="message"/>
                                    <div class="input-group-btn">
                                        <button name="submit" type="submit" class="btn btn-default">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
