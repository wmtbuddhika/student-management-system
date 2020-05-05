<?php
session_start();

if(empty($_SESSION['user_name']) || $_SESSION['user_name'] == NULL){
    header ('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META SECTION -->
    <title>SMS | Student Management</title>
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
            <li class="active">Messenger</li>
        </ul>
        <!-- END BREADCRUMB -->

        <!-- PAGE TITLE -->
        <div class="page-title">
            <h2 class="text-uppercase">Messenger</h2>
        </div>
        <!-- END PAGE TITLE -->

        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">
            <?php require_once('pages/chat-management/add-chat.php'); ?>

            <?php require_once('pages/chat-management/edit-chat.php'); ?>
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

<!-- START SCRIPTS -->
<!-- START PLUGINS -->
<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
<!-- END PLUGINS -->

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>

<script type="text/javascript" src="js/plugins/select2/js/select2.full.min.js"></script>

<script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
<script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
<script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="js/plugins/moment.min.js"></script>
<script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="js/plugins/summernote/summernote.js"></script>
<!-- END THIS PAGE PLUGINS-->

<!-- START TEMPLATE -->
<script type="text/javascript" src="js/settings.js"></script>

<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/actions.js"></script>

<script type="text/javascript" src="js/demo_dashboard.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- END TEMPLATE -->
<!-- END SCRIPTS -->

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

    (function(){
        let allocationId = $('#allocation_id').val();
        loadChat(allocationId);
        setTimeout(arguments.callee, 2000);
    })();

    function loadChat(allocationId) {
        let user_id = '<?php echo $_SESSION['user_id']?>';

        $.ajax({
            url : 'pages/database/load-chat.php',
            data : {'allocation_id': allocationId},
            dataType : 'json',
            method : 'post',
            error: function(e){
                swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
            },
            success : function(r){
                $('#message-history').html("");
                if (r.messages.length > 0) {
                    for (var i = 0; i < r.messages.length; i++) {
                        $in = "";
                        if (r.messages[i].user_id === user_id) {
                            $in = 'in'
                        }

                        let message = '\'' + r.messages[i].message + '\'';

                        $('#message-history').append(
                            '<div class="item ' + $in + ' item-visible" onclick="editChat(' + r.messages[i].id + ',' + r.messages[i].user_id + ',' + message + ')">' +
                                '<div class="image"><img src="../../assets/images/users/dummy-350x350.png" alt="' + r.messages[i].name + '"></div>' +
                                '<div class="text">' +
                                    '<div class="heading">' +
                                        '<a href="#">' + r.messages[i].name + '</a>' +
                                        '<span class="date">' + r.messages[i].created_date + '</span>' +
                                    '</div>'+
                                    r.messages[i].message +
                                '</div>' +
                            '</div>'
                        );
                    }
                }
            }
        });
    }

    $('#chat-form').on('submit', function(e){
        // e.preventDefault();
        let allocation_id = $('#allocation_id').val();
        let message = $('#message').val();
        if (allocation_id == null || message == null || message === "") {
            return
        }

        $.ajax({
            url : 'pages/database/save-chat.php',
            data : {'allocation_id': allocation_id, 'message': message},
            dataType : 'json',
            method : 'post',
            error: function(e){
            },
            success : function(r){
            }
        });
    });
</script>
</html>






