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
                    <li class="active">Tutor Registration</li>
                </ul>
                <!-- END BREADCRUMB -->    

                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2 class="text-uppercase">TUTOR Registration</h2>
                </div>
                <!-- END PAGE TITLE -->                                   
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- START MASKED INPUT PLUGIN -->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <hr><h3 class="text-uppercase">Search tutor</h3><hr>
                                        <div class="col-md-11">
                                            <select name="search" id="search" style="width:100%;">
                                                <option value="" selected disabled>Search Tutor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                url: 'pages/database/select-user.php',
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

            let operation_status = $('#operation').val();
            let toperation = "";

               if(operation_status > 0){
                    toperation = "UPDATE";
               } else {
                    toperation = "INSERT";
               }

            let form_data = $('#main-form').serializeArray();
            form_data.push({name:'t_operation', value:toperation});

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
                    } else if(r.message === 'UPDATED'){
                        swal ("UPDATED", 'TUTOR SUCCESSFULLY UPDATED', 'success');
                    } else if(r.message === 'NOT UPDATED'){
                        swal ("SORRY", 'TUTOR NOT UPDATED', 'success');
                    }
                }
            });
        });

        $('.edit').on('click', function(){
           let id = $(this).val();

        
            $.ajax({
                url : 'pages/database/tutor_data.php',
                dataType: 'json',
                data : {
                    tutor_id : id
                },
                method : 'post',
                error : function(e){
                    alert ('Somthing goes Wrong');
                },
                success : function(r){
                    var tresult = r.result;
                    var tmessege = r.messege;
                    var tdata = r.data;

                    if(tresult){
                        //User Details Initiate
                        $('#operation').val('1');
                        $('#user_id').val(tdata.ID);
                        $('#code').val(tdata.CODE);
                        $('#full_name').val(tdata.NAME);
                        $('#calling_name').val(tdata.CALLING_NAME);
                        $('#nic_name').val(tdata.NIC);
                        $('#dob').val(tdata.DOB);
                        $('#dob').val(tdata.DOB);

                        setTimeout(function(){ 
                            $('#Nationality').val(tdata.NATIONALITY); 
                        }, 500);

                        setTimeout(function(){ 
                            $('#marital_status').val(tdata.MARITIAL); 
                        }, 500);

                        setTimeout(function(){ 
                            $('#gender').val(tdata.GENDER); 
                        }, 500);

                        var bool_ot_pay = (tdata.STATUS == 1) ? true : false;
                        $('#active').prop('checked',bool_ot_pay);

                        //Contact Details
                        $('#address').val(tdata.ADDRESS);
                        $('#mobile_no').val(tdata.MOBILE);
                        $('#email').val(tdata.EMAIL);
                        $('#land_number').val(tdata.LAND_NUM);
                        $('#office_number').val(tdata.OFFICE_NUM);

                        //Login Details
                        $('#user_name').val(tdata.USER_NAME);
                        $('#password').val(tdata.PASSWORD);
                    }
                }
            });

        });
    </script>
</html>