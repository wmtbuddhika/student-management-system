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
        <div class="widget widget-default widget-item-icon" onclick="location.href='../../all-meetings.php'">
            <div class="widget-item-left">
                <span class="fa fa-calendar"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">
                    <?php
                    require_once('./pages/database/main_db.php');
                    $userType = $_SESSION['user_type'];
                    $allocationId = $_SESSION['allocation_id'];

                    $query = "SELECT COUNT(m.id) count FROM meeting m WHERE YEAR(m.schedule_date) = YEAR(NOW())
                                AND MONTH(m.schedule_date) = MONTH(NOW())";
                    if ($userType != 1 && $allocationId != null) {
                        $query = $query . "AND m.allocation_id IN ($allocationId)";
                    }

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
                    $userType = $_SESSION['user_type'];
                    $allocationId = $_SESSION['allocation_id'];

                    $query = "SELECT COUNT(DISTINCT u.id) count FROM user u, login l, role r, allocation a WHERE u.id = l.user_id AND r.login_id = l.id 
                                AND r.permission_id = 3 AND a.student_id = u.id AND u.id NOT IN (SELECT m.user_id FROM message m WHERE m.created_date > DATE_SUB(NOW(), INTERVAL 10 DAY) GROUP BY m.user_id)";

                    if ($userType != 1 && $allocationId != null) {
                        $query = $query . "AND a.allocation_group_id IN ($allocationId)";
                    }

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
<hr>
<div class="row">
    <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" onclick="location.href='../../document-management.php'">
            <div class="widget-item-left">
                <span class="fa fa-calendar"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">
                    <?php
                    require_once('./pages/database/main_db.php');
                    $userType = $_SESSION['user_type'];
                    $allocationId = $_SESSION['allocation_id'];

                    $query = "SELECT COUNT(d.id) count FROM document d WHERE YEAR(d.created_date) = YEAR(NOW())
                                AND MONTH(d.created_date) = MONTH(NOW()) ";
                    if ($userType != 1 && $allocationId != null) {
                        $query = $query . "AND d.allocation_id IN ($allocationId)";
                    }

                    $result = mysqli_query($con, $query);

                    while($data = mysqli_fetch_array($result)){
                        ?>
                        <span><?php echo $data['count']; ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="widget-title">Documents</div>
                <div class="widget-subtitle">This month uploaded Documents</div>
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" onclick="location.href='../../blog-management.php';">
            <div class="widget-item-left">
                <span class="fa fa-chain-broken"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">
                    <?php
                    require_once('./pages/database/main_db.php');
                    $userType = $_SESSION['user_type'];
                    $allocationId = $_SESSION['allocation_id'];

                    $query = "SELECT COUNT(b.id) count FROM blog b WHERE YEAR(b.created_date) = YEAR(NOW())
                                AND MONTH(b.created_date) = MONTH(NOW())";

                    if ($userType != 1 && $allocationId != null) {
                        $query = $query . "AND b.allocation_id IN ($allocationId)";
                    }

                    $result = mysqli_query($con, $query);

                    while($data = mysqli_fetch_array($result)){
                        ?>
                        <span><?php echo $data['count']; ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="widget-title">Blogs</div>
                <div class="widget-subtitle">This month added Blogs</div>
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" onclick="location.href='../../chat-management.php';">
            <div class="widget-item-left">
                <span class="fa fa-mail-reply"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">
                    <?php
                    require_once('./pages/database/main_db.php');
                    $userType = $_SESSION['user_type'];
                    $userId = $_SESSION['user_id'];
                    $allocationId = $_SESSION['allocation_id'];

                    $query = "SELECT COUNT(m.id) count FROM message m WHERE YEAR(m.created_date) = YEAR(NOW())
                                AND MONTH(m.created_date) = MONTH(NOW()) AND m.user_id = $userId ";

                    if ($userType != 1 && $allocationId != null) {
                        $query = $query . "AND m.allocation_id IN ($allocationId)";
                    }

                    $result = mysqli_query($con, $query);

                    while($data = mysqli_fetch_array($result)){
                        ?>
                        <span><?php echo $data['count']; ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="widget-title">Chats</div>
                <div class="widget-subtitle">This month added chat messages</div>
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