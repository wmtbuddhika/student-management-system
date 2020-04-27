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
                                <div class="panel-body">
                                    <form class="form-horizontal" id="main-form">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Batch *</label>
                                            <div class="col-md-9">                                                                                
                                                <select name="batch" class="form-control select" data-live-search="true">
                                                    <option selected disabled>Select Batch</option>

                                                    <?php
                                                        $allocationId = $_SESSION['allocation_id'];
                                                        $batch_query = "SELECT b.id, b.name FROM batch b, allocation a WHERE a.batch_id = b.id 
                                                            AND a.id = $allocationId AND b.status = 1 AND a.status = 1";

                                                        $batch_result = mysqli_query($con, $batch_query);

                                                        while ($bact_data = mysqli_fetch_array($batch_result)) {
                                                     ?>

                                                    <option value="<?php echo $bact_data['id']; ?>"><?php echo $bact_data['name']; ?></option>

                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>                                    
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Meeting Topic *</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="" name="meeting_toppic" id="meeting_toppic" required/>
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
                                                <select name="status" class="form-control select">
                                                    <option value="1">Active</option>
                                                    <option value="0">Disable</option>
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
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->

                <!-- START students in batch table -->
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
                                                <th>#</th>
                                                <th>Student Name</th>
                                                <th>Batch Name</th>
                                                <th>Tutoer Name</th>
                                                <th>actions</th>
                                            </tr>
                                        </thead>
                                        <!--<tbody>

                                            <?php /*
                                                $allocation_view = "SELECT
                                                    student_assign_to_batch.id,
                                                    sms_student_details.full_name AS S,
                                                    sms_batch_registration.batch_name,
                                                    sms_tutor_details.full_name AS a
                                                FROM
                                                    student_assign_to_batch
                                                INNER JOIN sms_student_details ON student_assign_to_batch.b_student_reg_id = sms_student_details.id
                                                INNER JOIN sms_batch_registration ON student_assign_to_batch.b_batch_id = sms_batch_registration.id
                                                INNER JOIN sms_tutor_details ON student_assign_to_batch.b_tutor_id = sms_tutor_details.id";

                                                $allocation_query = mysqli_query($con, $allocation_view);

                                                while ($student_data = mysqli_fetch_array($allocation_query)) {

                                            */?>

                                            <tr id="trow_3">
                                                <td class="text-center"><?php /*echo $student_data['id']; */?></td>
                                                <td><strong><?php /*echo $student_data['S']; */?></strong></td>
                                                <td><?php /*echo $student_data['batch_name']; */?></td>
                                                <td><?php /*echo $student_data['a']; */?></td>
                                                <td>
                                                    <button class="btn btn-default btn-rounded btn-condensed btn-sm"><span class="fa fa-pencil"></span></button>
                                                    <button class="btn btn-danger btn-rounded btn-condensed btn-sm" onClick="delete_row('trow_3');"><span class="fa fa-times"></span></button>
                                                </td>
                                            </tr>

                                            <?php /*
                                                }
                                            */?>
                                        </tbody>-->
                                    </table>
                                </div>                                

                            </div>
                        </div>                                                
                    </div>
                </div>
                <!-- END students in batch table -->                                             
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        
        <!-- MESSAGE BOX-->

        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
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
                url : 'pages/database/save-meeting.php',
                data : form_data,
                dataType : 'json',
                method : 'post',
                error: function(e){

                    swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
                },
                success : function(r){
                    if(r.message === 'success'){
                        swal ("message", 'Congratulations. New Tutor has Registered', 'success');
                    } else if(r.message === 'empty'){
                        swal ("Sorry", 'Fields Can not be empty', 'error');
                    } else if(r.message === 'exist'){
                        swal ("Sorry", 'This Student Already In', 'warning'); 
                    }
                }
            });
        });

    </script>
</html>






