<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title text-uppercase">approval pending meetings</h3>
            </div>

            <div class="panel-body panel-body-table">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-actions">
                        <thead>
                        <tr>
                            <th>Group</th>
                            <th>Meeting Topic</th>
                            <th>Scheduled Date</th>
                            <th>Scheduled By</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $allocationId = $_SESSION['allocation_id'];
                        $query = "SELECT m.id,a.code,m.title,m.schedule_date,m.status,u.name FROM allocation_group a,meeting m, user u 
                                  WHERE m.entered_by = u.id AND a.id = m.allocation_id AND a.status = 1 AND m.status = 0
                                  AND a.id IN ($allocationId)";
                        $meetings = mysqli_query($con, $query);
                        while ($meeting = mysqli_fetch_array($meetings)) {
                            ?>

                            <tr id="trow_3">
                                <td class="text-center"><?php echo $meeting['code']; ?></td>
                                <td><strong><?php echo $meeting['title']; ?></strong></td>
                                <td><?php echo $meeting['schedule_date']; ?></td>
                                <td><?php echo $meeting['name']; ?></td>
                                <td>
                                    <button id="<?php echo $meeting['id']; ?>" class="btn btn-default btn-rounded btn-condensed btn-sm"onclick="loadMeeting(this.id)"><span class="fa fa-pencil"></span></button>
                                </td>
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