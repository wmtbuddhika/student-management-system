<?php
require_once('pages/database/main_db.php');
session_start();

if(empty($_SESSION['user_name']) || $_SESSION['user_name'] == NULL){
    header ('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from aqvatarius.com/themes/atlant/html/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Oct 2016 09:28:23 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <!-- META SECTION -->
    <title>SMS | Student Allocation</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="img/favicon.png" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
    <!-- EOF CSS INCLUDE -->
</head>
<body>
<!-- START PAGE CONTAINER -->
<div class="page-container">

    <!-- START PAGE SIDEBAR -->
    <div class="page-sidebar">
        <?php require_once('pages/navigation/side_menu.php'); ?>
    </div>
    <!-- END PAGE SIDEBAR -->

    <!-- PAGE CONTENT -->
    <div class="page-content">

        <?php require_once('pages/dashboard/top-bar.php'); ?>

        <!-- START BREADCRUMB -->
        <ul class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li class="active">Student Allocation</li>
        </ul>
        <!-- END BREADCRUMB -->

        <!-- PAGE TITLE -->
        <div class="page-title">
            <h2 class="text-uppercase">Student Allocation</h2>
        </div>
        <!-- END PAGE TITLE -->

        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">

            <div class="row">
                <div class="col-md-12">

                    <!-- START BOOTSTRAP SELECT -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-uppercase">student allocation</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" id="main-form">
                                <input type="hidden" name="edit" id="edit">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Group *</label>
                                    <div class="col-md-4">
                                        <select id="allocation" name="allocation" class="form-control select" data-live-search="true">
                                            <option selected disabled>Select Group</option>

                                            <?php
                                            require_once('./pages/database/main_db.php');
                                            $allocationId = $_SESSION['allocation_id'];
                                            $query = "SELECT a.id, a.code FROM allocation_group a WHERE a.status = 1";

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
                                    <label class="col-md-3 control-label">Student *</label>
                                    <div class="col-md-9">
                                        <select id="student" name="student" class="form-control select" data-live-search="true" multiple>

                                            <?php
                                            $student_query = "SELECT u.id, u.name FROM user u, login l, role r WHERE u.id = l.user_id AND r.login_id = l.id
                                                                AND r.permission_id = 3 AND u.status = 1";

                                            $student_result = mysqli_query($con, $student_query);

                                            while($student_data = mysqli_fetch_array($student_result)){

                                                ?>
                                                <option value="<?php echo $student_data['id'];?>"><?php echo $student_data['name']; ?></option>
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

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h3 class="panel-title text-uppercase">not allocated Students</h3>
                        </div>

                        <div class="panel-body panel-body-table">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-actions dataTable">
                                    <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                        <th>NIC</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    require_once('pages/database/main_db.php');

                                    $tutor_main_select_query = "SELECT u.code,u.name,u.gender,u.date_of_birth,u.nic_no,u.mobile_no,u.email,u.address 
                                            FROM user u, login l, role r WHERE u.id = l.user_id AND r.login_id = l.id AND r.permission_id = 3 AND u.status = 1
                                            AND (SELECT COUNT(a.id) FROM allocation a WHERE a.student_id = u.id AND IFNULL(a.status,0) = 1) = 0 ORDER BY u.code";

                                    $query_execute = mysqli_query($con, $tutor_main_select_query);

                                    while ($result = mysqli_fetch_array($query_execute)) {
                                        ?>
                                        <tr>
                                            <td><strong><?php echo $result['code']; ?></strong></td>
                                            <td><strong><?php echo $result['name']; ?></strong></td>
                                            <td><strong><?php if($result['gender'] == 1){echo 'Male';} else {echo 'Female';}?></strong></td>
                                            <td><strong><?php echo $result['date_of_birth']; ?></strong></td>
                                            <td><strong><?php echo $result['nic_no']; ?></strong></td>
                                            <td><strong><?php echo $result['mobile_no']; ?></strong></td>
                                            <td><strong><?php echo $result['email']; ?></strong></td>
                                            <td><strong><?php echo $result['address']; ?></strong></td>
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

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h3 class="panel-title text-uppercase">Allocated Student</h3>
                        </div>

                        <div class="panel-body panel-body-table">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-actions">
                                    <thead>
                                    <tr>
                                        <th>Group</th>
                                        <th>Student Name</th>
                                        <th>Batch Name</th>
                                        <th>Module Name</th>
                                        <th>Tutor Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $allocation_view = "SELECT ag.code,a.id,b.name batch_name, m.name module_name, (SELECT u.name FROM user u WHERE u.id = a.student_id) student_name, 
                                                        (SELECT u.name FROM user u WHERE u.id = ag.tutor_id) tutor_name FROM allocation a, allocation_group ag, batch b, module m 
                                                        WHERE ag.batch_id = b.id AND ag.module_id = m.id AND a.allocation_group_id = ag.id AND ag.status = 1 AND a.status = 1 
                                                        AND a.student_id IS NOT NULL";

                                    $allocation_query = mysqli_query($con, $allocation_view);

                                    while ($student_data = mysqli_fetch_array($allocation_query)) {

                                        ?>

                                        <tr id="trow_3">
                                            <td><?php echo $student_data['code']; ?></td>
                                            <td><?php echo $student_data['student_name']; ?></td>
                                            <td><strong><?php echo $student_data['batch_name']; ?></strong></td>
                                            <td><strong><?php echo $student_data['module_name']; ?></strong></td>
                                            <td><?php echo $student_data['tutor_name']; ?></td>
                                            <td>
                                                <button class="btn btn-default btn-rounded btn-condensed btn-sm" onClick="loadAllocation(<?php echo $student_data['id']; ?>)"><span class="fa fa-pencil"></span></button>
                                                <button class="btn btn-danger btn-rounded btn-condensed btn-sm" onClick="removeAllocation(<?php echo $student_data['id']; ?>)"><span class="fa fa-times"></span></button>
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

        </div>
    </div>
    <!-- END PAGE CONTENT -->
</div>
<?php require_once('pages/dashboard/footer.php'); ?>

<audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
<audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
<!-- END PRELOADS -->

<!-- START SCRIPTS -->
<!-- START PLUGINS -->
<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
<!-- END PLUGINS -->

<!-- THIS PAGE PLUGINS -->
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<!-- END THIS PAGE PLUGINS -->

<!-- START TEMPLATE -->
<script type="text/javascript" src="js/settings.js"></script>

<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/actions.js"></script>
<!-- END TEMPLATE -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<noscript><div><img src="https://mc.yandex.ru/watch/25836617" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>

<script type="text/javascript">

    $('#main-form').on('submit', function(e){
        e.preventDefault();
        let allocationId = $('#allocation').val();
        let students = $('#student').val();
        let edit = $('#edit').val();

        if (allocationId == null) {swal ("", 'Select a Group', 'warning');return}
        if (students == null) {swal ("", 'Select at least one Student', 'warning');return}

        $.ajax({
            url : 'pages/database/allocate-student.php',
            data : {'allocation_id': allocationId, 'students': students, 'edit': edit},
            dataType : 'json',
            method : 'post',
            error: function(e){
                swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
            },
            success : function(r){
                if(r.message === 'success'){
                    swal("Success", 'Students Allocated Successfully', 'success').then(function(isConfirm) {
                        if (isConfirm) {
                            location.reload();
                        }
                    });
                } else if(r.message === 'empty'){
                    swal ("Sorry", 'Fields Can not be empty', 'error');
                } else if(r.message === 'exist'){
                    swal ("Sorry", 'This Student Already In', 'warning');
                }
            }
        });
    });

    function loadAllocation(allocationId) {
        $.ajax({
            url : 'pages/database/load-student-allocation.php',
            data : {'allocation_id': allocationId},
            dataType : 'json',
            method : 'post',
            error: function(e){
                swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
            },
            success : function(r){
                $('#edit').val(r.allocation[0].allocation_id);
                setTimeout(function(){
                    $('#allocation').val(r.allocation[0].id);
                    $('button[data-id="allocation"] span:first').text(r.allocation[0].code);
                }, 500);
                setTimeout(function(){
                    $('#student').val(r.allocation[0].student_ids);
                    $('button[data-id="student"] span:first').text(r.allocation[0].students);
                }, 500);
            }
        });
    }

    function removeAllocation(allocationId) {
        swal({
            title: "Confirmation",
            text: "Are you sure ?",
            icon: "warning",
            buttons: ['NO', 'YES'],
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : 'pages/database/remove-allocation.php',
                    data : {'allocation_id': allocationId},
                    dataType : 'json',
                    method : 'post',
                    error: function(e){
                        swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
                    },
                    success : function(r){
                        swal({
                            title: "Success",
                            text: "Allocation Removed Successfully",
                            icon: "success",
                            buttons: [null,'OK'],
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                    }
                });
            }
        });
    }

</script>
</html>






