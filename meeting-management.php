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
        <title>SMS | Meetings</title>
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
            <div class="page-content" id="meeting-details">
                
                <?php require_once('pages/dashboard/top-bar.php'); ?>
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li class="active">Meetings</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2 class="text-uppercase">Meeting scheduler</h2>
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
                                        <input type="hidden" value="" id="meeting_id" name="meeting_id">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Group *</label>
                                            <div class="col-md-9">                                                                                
                                                <select id="group" name="group" class="form-control select" data-live-search="true">
                                                    <?php
                                                        $allocationId = $_SESSION['allocation_id'];
                                                        $batch_query = "SELECT a.id, a.code FROM allocation a WHERE a.id IN ($allocationId) AND a.status = 1";

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
                                                    <option value="0">Pending</option>
                                                    <?php
                                                    $userType = $_SESSION['user_type'];
                                                    if ($userType != 3) {
                                                        ?>
                                                        <option value="2">Cancel</option>

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
                    
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <h3 class="panel-title text-uppercase">pending meetings</h3>
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
                                        $query = "SELECT m.id,a.code,m.title,m.schedule_date,m.status,u.name FROM allocation a,meeting m, user u 
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <h3 class="panel-title text-uppercase">scheduled meetings</h3>
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
                                                $query = "SELECT m.id,a.code,m.title,m.schedule_date,m.status FROM allocation a,meeting m 
                                                            WHERE a.id = m.allocation_id AND a.status = 1 AND m.status != 0 AND a.id IN ($allocationId)";
                                                $meetings = mysqli_query($con, $query);
                                                while ($meeting = mysqli_fetch_array($meetings)) {
                                            ?>

                                            <tr id="trow_3">
                                                <td class="text-center"><?php echo $meeting['code']; ?></td>
                                                <td><strong><?php echo $meeting['title']; ?></strong></td>
                                                <td><?php echo $meeting['schedule_date']; ?></td>
                                                <td><?php if($meeting['status'] == 0) {echo 'Pending';} elseif ($meeting['status'] == 1) {echo 'Scheduled';} elseif ($meeting['status'] == 2) {echo 'Canceled';} ?></td>
                                                <td>
                                                    <button id="<?php echo $meeting['id']; ?>" class="btn btn-default btn-rounded btn-condensed btn-sm" onclick="loadMeeting(this.id)"><span class="fa fa-pencil"></span></button>
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
            let form_data = $('#main-form').serializeArray();
            
            $.ajax({
                url : 'pages/database/save-meeting.php',
                data : form_data,
                dataType : 'json',
                method : 'post',
                error: function(e){

                },
                success : function(r){

                }
            });
        });

        function loadMeeting(meetingId) {
            $.ajax({
                url : 'pages/database/load-meeting.php',
                data : {'meeting_id': meetingId},
                dataType : 'json',
                method : 'post',
                error: function(e){
                    swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
                },
                success : function(r){
                    $('#meeting_id').val(r.meetings[0].meeting_id);
                    $('#group').val(r.meetings[0].id);
                    $('#meeting_topic').val(r.meetings[0].title);
                    $('#dom').val(r.meetings[0].schedule_date);
                    $('#meeting_message').val(r.meetings[0].comment);
                }
            });
            $('html, body').animate({
                scrollTop: $("#meeting-details").offset().top
            }, 2000);
        }
    </script>
</html>






