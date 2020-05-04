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
        <title>SMS | Batch Registration</title>
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
                    <li class="active">Module Registration</li>
                </ul>
                <!-- END BREADCRUMB -->    

                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2 class="text-uppercase">Module Registration</h2>
                </div>
                <!-- END PAGE TITLE -->                                   
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <?php require_once('pages/module-management/module-details.php'); ?>

                    <?php require_once('pages/module-management/all-modules.php'); ?>
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
        <?php require_once('pages/plugings.php'); ?>

    </body>
    <script type="text/javascript">
        $('#search').select2({
            minimumInputLength: 2,
            ajax: {
                url: 'pages/database/select-module.php',
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
            form_data.push({name:'m_operation', value:toperation});

            $.ajax({
                url : 'pages/database/save-module.php',
                data : form_data,
                dataType : 'json',
                method : 'post',
                error: function(e){
                    swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
                },
                success : function(r){
                    if(r.message === 'success'){
                        swal({
                            title: "Success",
                            text: "Module Saved Successfully",
                            icon: "success",
                            buttons: [null,'OK'],
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                location.href = 'module-management.php';
                            }
                        });
                    } else if(r.message === 'empty'){
                        swal ("SORRY", 'FIELDS CAN NOT BE EMPTY', 'error');
                    } else if(r.message === 'exist'){
                        swal ("SORRY", 'THIS IS EXISTING MODULE', 'warning');
                    } else if(r.message === 'UPDATED'){
                        swal({
                            title: "Success",
                            text: "Module Updated Successfully",
                            icon: "success",
                            buttons: [null,'OK'],
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                location.href = 'module-management.php';
                            }
                        });
                    } else if(r.message === 'NOT UPDATED'){
                        swal ("SORRY", 'MODULE NOT UPDATED', 'error');
                    }
                }
            });
        });

        $('.edit').on('click', function(){
           let id = $(this).val();

        
            $.ajax({
                url : 'pages/database/module_data.php',
                dataType: 'json',
                data : {
                    module_id : id
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
                        //Batch Details Initiate
                        $('#operation').val('1');
                        $('#module_id').val(tdata.ID);
                        $('#module_code').val(tdata.CODE);
                        $('#module_name').val(tdata.NAME);
                        $('#remark').val(tdata.REMARKS);

                        var bool_ot_pay = (tdata.STATUS == 1) ? true : false;
                        $('#active').prop('checked',bool_ot_pay);
                    }
                }
            });

        });

        $('.delete').on('click', function(){
            let delete_id = $(this).val();

            swal({
                title: "Confirmation",
                text: "Are you sure ?",
                icon: "warning",
                buttons: ['NO', 'YES'],
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                      url : 'pages/database/save-module.php',
                      method : 'post',
                      data : {
                          delete_id : delete_id,
                          m_operation : 'DELETE'
                      },
                      dataType : 'json',
                      error : function(e){
                          alert (e);
                      },
                      success : function(r){
                          swal({
                              title: "Success",
                              text: "Module Removed Successfully",
                              icon: "success",
                              buttons: [null,'OK'],
                          }).then(function(isConfirm) {
                              if (isConfirm) {
                                  location.href = 'module-management.php';
                              }
                          });
                      }
                  });
              }
            });

        });
    </script>
</html>






