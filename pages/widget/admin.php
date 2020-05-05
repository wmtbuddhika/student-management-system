<!-- START WIDGETS -->                    
<div class="row">
    <div class="col-md-3">
        <div class="widget widget-danger widget-padding-sm">
            <div class="widget-big-int plugin-clock">00:00</div>
            <div class="widget-subtitle plugin-date">Loading...</div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" onclick="location.href='../../all-students.php'">
            <div class="widget-item-left">
                <span class="fa fa-users"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">
                    <?php
                    require_once('./pages/database/main_db.php');

                    $query = "SELECT COUNT(u.id) count FROM user u, login l, role r WHERE u.id = l.user_id AND r.login_id = l.id
                                AND r.permission_id = 3 AND u.status = 1";

                    $result = mysqli_query($con, $query);

                    while($data = mysqli_fetch_array($result)){
                        ?>
                        <span><?php echo $data['count']; ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="widget-title">Students</div>
                <div class="widget-subtitle">All Registered</div>
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" onclick="location.href='../../not-allocated-students.php';">
            <div class="widget-item-left">
                <span class="fa fa-user-times"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">
                    <?php
                    require_once('./pages/database/main_db.php');

                    $query = "SELECT COUNT(u.id) - (SELECT COUNT(DISTINCT a.student_id) FROM allocation a WHERE a.status = 1) count FROM user u, login l, role r WHERE u.id = l.user_id AND r.login_id = l.id
                                AND r.permission_id = 3 AND u.status = 1";

                    $result = mysqli_query($con, $query);

                    while($data = mysqli_fetch_array($result)){
                        ?>
                        <span><?php echo $data['count']; ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="widget-title">Students</div>
                <div class="widget-subtitle">Not Allocated</div>
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" onclick="location.href='../../all-tutors.php'">
            <div class="widget-item-left">
                <span class="fa fa-user"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">
                    <?php
                    require_once('./pages/database/main_db.php');

                    $query = "SELECT COUNT(u.id) count FROM user u, login l, role r WHERE u.id = l.user_id AND r.login_id = l.id
                                AND r.permission_id = 2 AND u.status = 1";

                    $result = mysqli_query($con, $query);

                    while($data = mysqli_fetch_array($result)){
                        ?>
                        <span><?php echo $data['count']; ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="widget-title">Tutors</div>
                <div class="widget-subtitle">All Registered</div>
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" onclick="location.href='../../all-meetings.php'">
            <div class="widget-item-left">
                <span class="fa fa-calendar"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">
                    <?php
                    require_once('./pages/database/main_db.php');

                    $query = "SELECT COUNT(m.id) count FROM meeting m WHERE YEAR(m.schedule_date) = YEAR(NOW())
                                AND MONTH(m.schedule_date) = MONTH(NOW())";

                    $result = mysqli_query($con, $query);

                    while($data = mysqli_fetch_array($result)){
                        ?>
                        <span><?php echo $data['count']; ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="widget-title">Meetings</div>
                <div class="widget-subtitle">This month all meetings</div>
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" onclick="location.href='../../less-interaction-students.php';">
            <div class="widget-item-left">
                <span class="fa fa-chain-broken"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">
                    <?php
                    require_once('./pages/database/main_db.php');

                    $query = "SELECT COUNT(DISTINCT u.id) count FROM user u, login l, role r WHERE u.id = l.user_id AND r.login_id = l.id 
                                AND r.permission_id = 3 AND u.status = 1 AND u.id NOT IN (SELECT m.user_id FROM message m WHERE m.created_date > DATE_SUB(NOW(), INTERVAL 10 DAY) GROUP BY m.user_id)";

                    $result = mysqli_query($con, $query);

                    while($data = mysqli_fetch_array($result)){
                        ?>
                        <span><?php echo $data['count']; ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="widget-title">Less interaction</div>
                <div class="widget-subtitle">This month less interaction students</div>
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
    </div>
</div>

<style>
    div.widget {
        cursor: pointer;
    }
</style>