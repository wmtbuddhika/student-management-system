<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title text-uppercase">approved meetings</h3>
            </div>

            <div class="panel-body panel-body-table">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-actions">
                        <thead>
                        <tr>
                            <th>Group</th>
                            <th>Meeting Topic</th>
                            <th>Scheduled Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT m.id,a.code,m.title,m.schedule_date,m.status FROM allocation_group a,meeting m 
                                  WHERE a.id = m.allocation_id AND a.status = 1 AND m.status != 0 AND a.id IN ($allocationId)";
                        $meetings = mysqli_query($con, $query);
                        while ($meeting = mysqli_fetch_array($meetings)) {
                            ?>

                            <tr>
                                <td class="text-center"><?php echo $meeting['code']; ?></td>
                                <td><strong><?php echo $meeting['title']; ?></strong></td>
                                <td><?php echo $meeting['schedule_date']; ?></td>
                                <td><?php if($meeting['status'] == 0) {echo 'Pending';} elseif ($meeting['status'] == 1) {echo 'Scheduled';} elseif ($meeting['status'] == 2) {echo 'Canceled';} ?></td>
                                <?php
                                $userType = $_SESSION['user_type'];
                                if ($userType != 3) {
                                    ?>
                                    <td>
                                        <button id="<?php echo $meeting['id']; ?>"
                                                class="btn btn-default btn-rounded btn-condensed btn-sm"
                                                onclick="loadMeeting(this.id)"><span class="fa fa-pencil"></span>
                                        </button>
                                        <button id="<?php echo $meeting['id']; ?>"
                                                class="btn btn-default btn-rounded btn-condensed btn-sm"
                                                onclick="loadMinutes(this.id)"><span class="fa fa-book"></span>
                                        </button>
                                    </td>
                                    <?php
                                } else {
                                    ?>
                                    <td>
                                        <button id="<?php echo $meeting['id']; ?>"
                                                class="btn btn-default btn-rounded btn-condensed btn-sm"
                                                onclick="loadMinutes(this.id)"><span class="fa fa-book"></span>
                                        </button>
                                    </td>
                                    <?php
                                }
                                ?>
                            </tr>

                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>