<?php 
    session_start();
    
    if(empty($_SESSION['user_name']) || $_SESSION['user_name'] == NULL){
        header ('Location: index.php');
        exit;
    }
 ?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from aqvatarius.com/themes/atlant/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Oct 2016 08:59:48 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
        <!-- META SECTION -->
        <title>SMS | Tutor Management</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="img/favicon.png" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="js/plugins/select2/css/select2.min.css"/>
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
                    <li class="active">Tutor Management</li>
                </ul>
                <!-- END BREADCRUMB -->    

                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2>TUTOR MANAGEMENT</h2>
                </div>
                <!-- END PAGE TITLE -->                                   
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <?php require_once('pages/tutor-management/search-tutor.php'); ?>

                    <?php require_once('pages/tutor-management/tutor-details.php'); ?>

                    <?php require_once('pages/tutor-management/all-tutors.php'); ?>
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <?php require_once('pages/dashboard/footer.php'); ?>

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                  
        
        <?php require_once('pages/plugings.php'); ?>

    </body>
    <script type="text/javascript">
        $('#search').select2({
            minimumInputLength: 2,
            ajax: {
                url: '__data_fol/employee_select_2.php',
                dataType: 'json',
                delay: 100,
                data: function (term) {
                    return term;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.crn_id
                            }
                        })
                    };
                }
            }
        });

        $('#main-form').on('submit', function(e){
            e.preventDefault();
            let form_data = $('#main-form, #main-form-other-config').serializeArray();

            $.ajax({
                url : 'pages/database/save-user.php',
                data : form_data,
                dataType : 'json',
                method : 'post',
                error: function(e){
                    swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
                },
                success : function(r){
                    if(r.message === 'success'){
                        swal ("Success", 'Congratulations. New Tutor has Registered', 'success');
                        this.submit();
                    } else if(r.message === 'empty'){
                        swal ("Sorry", 'Fields Can not be empty', 'error');
                    } else if(r.message === 'exist'){
                        swal ("Sorry", 'This Tutor is Exists', 'warning');
                    }
                }
            });
        });
    </script>
</html>






