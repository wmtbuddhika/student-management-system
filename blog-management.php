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
            <li class="active">Blogger</li>
        </ul>
        <!-- END BREADCRUMB -->

        <!-- PAGE TITLE -->
        <div class="page-title">
            <h2 class="text-uppercase">Blogger</h2>
        </div>
        <!-- END PAGE TITLE -->

        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">
            <?php require_once('pages/blog-management/add-blog.php'); ?>

            <?php require_once('pages/blog-management/all-blog.php'); ?>

            <?php require_once('pages/blog-management/blog-comments.php'); ?>
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

    $('#blog-form').on('submit', function(e){
        e.preventDefault();
        let blog_id = $('#blog_id').val();
        let allocation_id = $('#allocation_id').val();
        let blog_title = $('#title').val();
        let blog_data = $('.note-editable').html();
        if (allocation_id == null) {
            return
        }

        $.ajax({
            url : 'pages/database/save-blog.php',
            data : {'allocation_id': allocation_id, 'blog_title': blog_title, 'blog_data': blog_data, 'blog_id': blog_id},
            dataType : 'json',
            method : 'post',
            error: function(e){
                swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
            },
            success : function(r){
                if(r.message === 'success'){
                    swal({
                        title: "Success",
                        text: "Blog Saved Successfully",
                        icon: "success",
                        buttons: [null,'OK'],
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                            location.href = '../../blog-management.php';
                        }
                    });
                } else if(r.message === 'empty'){
                    swal({
                        title: "Success",
                        text: "Blog Saved Successfully",
                        icon: "success",
                        buttons: [null,'OK'],
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                            return
                        }
                    });
                } else if(r.message === 'exist'){
                    swal ("Sorry", 'This Blog Title Already Exists', 'warning');
                }
            }
        });
    });
</script>
</html>






