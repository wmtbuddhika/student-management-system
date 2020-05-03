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
    <title>SMS | Group Management</title>
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
            <li class="active">Group Management</li>
        </ul>
        <!-- END BREADCRUMB -->

        <!-- PAGE TITLE -->
        <div class="page-title">
            <h2 class="text-uppercase">Group Management</h2>
        </div>
        <!-- END PAGE TITLE -->

        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-uppercase">group creation</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" id="main-form">
                                <input type="hidden" name="allocation_id" id="allocation_id" value="">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Batch</label>
                                    <div class="col-md-9">
                                        <select name="batch" id="batch" class="form-control select" data-live-search="true">
                                            <option selected disabled>Select Batch</option>

                                            <?php
                                            $batch_query = "SELECT id, name FROM batch WHERE status = 1";
                                            $batch_result = mysqli_query($con, $batch_query);

                                            while ($bact_data = mysqli_fetch_array($batch_result)) {
                                                ?>

                                                <option value="<?php echo $bact_data['id']; ?>"><?php echo $bact_data['name']; ?></option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Module</label>
                                    <div class="col-md-9">
                                        <select name="module" class="form-control select" data-live-search="true">
                                            <option selected disabled>Select Module</option>

                                            <?php
                                            $batch_query = "SELECT m.id, m.name FROM module m WHERE m.status = '1'";
                                            $batch_result = mysqli_query($con, $batch_query);

                                            while ($bact_data = mysqli_fetch_array($batch_result)) {
                                                ?>

                                                <option value="<?php echo $bact_data['id']; ?>"><?php echo $bact_data['name']; ?></option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tutor</label>
                                    <div class="col-md-9">
                                        <select name="tutor" class="form-control select" data-live-search="true">
                                            <option selected disabled>Select Tutor</option>

                                            <?php
                                            $tutor_query = "SELECT u.id, u.name FROM user u, login l, role r WHERE u.id = l.user_id AND r.login_id = l.id
                                                                AND r.permission_id = 2 AND u.status = 1";
                                            $tutor_result = mysqli_query($con, $tutor_query);

                                            while($tutor_data = mysqli_fetch_array($tutor_result)){
                                                ?>

                                                <option value="<?php echo $tutor_data['id'];?>"><?php echo $tutor_data['name']; ?></option>

                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Group Code *</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="" name="code" id="code" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Group Name *</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="" name="name" id="name" required/>
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

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title text-uppercase">all groups</h3>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions dataTable">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Batch</th>
                                    <th>Module</th>
                                    <th>Tutor</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                require_once('pages/database/main_db.php');

                                $tutor_main_select_query = "SELECT a.id,a.code, a.name, b.name batch, m.name module, u.name tutor
                                            FROM user u, allocation_group a, batch b, module m WHERE u.id = a.tutor_id AND b.id = a.batch_id 
                                            AND m.id = a.module_id AND a.status = 1";

                                $query_execute = mysqli_query($con, $tutor_main_select_query);

                                while ($result = mysqli_fetch_array($query_execute)) {
                                    ?>
                                    <tr>
                                        <td><strong><?php echo $result['code']; ?></strong></td>
                                        <td><strong><?php echo $result['name']; ?></strong></td>
                                        <td><strong><?php echo $result['batch']; ?></strong></td>
                                        <td><strong><?php echo $result['module']; ?></strong></td>
                                        <td><strong><?php echo $result['tutor']; ?></strong></td>
                                        <td>
                                            <button class="btn btn-default btn-rounded btn-condensed btn-sm" onClick="loadAllocation(<?php echo $result['id']; ?>)"><span class="fa fa-pencil"></span></button>
                                            <button class="btn btn-danger btn-rounded btn-condensed btn-sm" onClick="removeAllocation(<?php echo $result['id']; ?>)"><span class="fa fa-times"></span></button>
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
        let form_data = $('#main-form').serializeArray();

        $.ajax({
            url : 'pages/database/save-group.php',
            data : form_data,
            dataType : 'json',
            method : 'post',
            error: function(e){
                swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
            },
            success : function(r){
                if(r.message === 'success'){
                    swal ("Success", 'Congratulations. New Tutor has Registered', 'success');
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
            url : 'pages/database/load-allocation.php',
            data : {'allocation_id': allocationId},
            dataType : 'json',
            method : 'post',
            error: function(e){
                swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
            },
            success : function(r){
                $('#allocation_id').val(r.allocation[0].id);
                $('#code').val(r.allocation[0].code);
                $('#name').val(r.allocation[0].name);
                $('#batch').val(r.allocation[0].batch_id).attr('selected', 'selected');
            }
        });
    }

    function removeAllocation(allocationId) {
        $.ajax({
            url : 'pages/database/remove-allocation-group.php',
            data : {'allocation_id': allocationId},
            dataType : 'json',
            method : 'post',
            error: function(e){
                swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
            },
            success : function(r){
                if(r.message === 'success'){
                    swal ("Success", 'Congratulations. New Tutor has Registered', 'success');
                } else if(r.message === 'empty'){
                    swal ("Sorry", 'Fields Can not be empty', 'error');
                } else if(r.message === 'exist'){
                    swal ("Sorry", 'This Student Already In', 'warning');
                }
            }
        });
    }

</script>
</html>






