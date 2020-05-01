<div class="row">
    <div class="col-md-12">

        <!-- START BOOTSTRAP SELECT -->
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" id="main-form">
                    <input type="hidden" value="" id="meeting_id" name="meeting_id">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Group *</label>
                        <div class="col-md-9">
                            <select id="group" name="group" class="form-control select" data-live-search="true">
                                <?php
                                $userId = $_SESSION['user_id'];
                                $allocationId = $_SESSION['allocation_id'];
                                $userType = $_SESSION['user_type'];
                                $batch_query = "SELECT a.id, ag.code FROM allocation_group ag, allocation a WHERE a.allocation_group_id = ag.id AND ag.status = 1 
                                                AND a.status = 1 AND ag.id IN ($allocationId) AND IF($userType = 3, a.student_id = $userId, ag.tutor_id = $userId)";

                                $batch_result = mysqli_query($con, $batch_query);

                                while ($bact_data = mysqli_fetch_array($batch_result)) {
                                    ?>

                                    <option value="<?php echo $bact_data['id']; ?>"><?php echo $bact_data['code']; ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Meeting Topic *</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="" name="meeting_topic" id="meeting_topic" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Date of Meeting *</label>
                        <div class="col-md-9">
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker" name="dom" id="dom" required/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Message *</label>
                        <div class="col-md-9 col-xs-12">
                            <textarea name="meeting_message" id="meeting_message" class="form-control" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Status</label>
                        <div class="col-md-9">
                            <select name="status" id="status" class="form-control select">
                                <?php
                                $userType = $_SESSION['user_type'];
                                if ($userType != 3) {
                                    ?>
                                    <option value="1">Schedule</option>
                                    <?php
                                }
                                ?>
                                <?php
                                $userType = $_SESSION['user_type'];
                                if ($userType == 3) {
                                    ?>
                                    <option value="0">Pending</option>
                                    <?php
                                }
                                ?>
                                <?php
                                $userType = $_SESSION['user_type'];
                                if ($userType != 3) {
                                    ?>
                                    <option value="2">Cancel</option>
                                    <option value="3">Completed</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="btn-group pull-right">
                            <button class="btn btn-primary text-uppercase" type="submit">save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END OF BOOTSTRAP SELECT -->

    </div>
</div>