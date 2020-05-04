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
                    <?php require_once('pages/meeting-management/schedule-meetings.php'); ?>

                    <?php require_once('pages/meeting-management/pending-meetings.php'); ?>

                    <?php require_once('pages/meeting-management/approved-meetings.php'); ?>

                    <?php require_once('pages/meeting-management/meeting-minutes.php'); ?>
                    
                </div>
                <!-- END students in batch table -->
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
                    $('#tom').val(r.meetings[0].schedule_time);
                    $('#meeting_message').val(r.meetings[0].comment);
                    setTimeout(function(){
                        $('#status').val(r.meetings[0].status);
                        $text = '';
                        if (r.meetings[0].status == 0) {$text = 'Pending'}
                        else if (r.meetings[0].status == 1) {$text = 'Scheduled'}
                        else if (r.meetings[0].status == 2) {$text = 'Canceled'}
                        else if (r.meetings[0].status == 3) {$text = 'Completed'}
                        $('button[data-id="status"] span:first').text($text);
                    }, 500);
                }
            });
            $('html, body').animate({
                scrollTop: $("#meeting-details").offset().top
            }, 2000);
        }
    </script>
</html>






