<!DOCTYPE html>
<html lang="en" class="body-full-height">
    
<!-- Mirrored from aqvatarius.com/themes/atlant/html/pages-login-website-light.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Oct 2016 09:28:06 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
        <?php require_once('pages/dashboard/header.php'); ?>
    </head>
    <body>
        <div class="login-container lightmode">
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Log In</strong> to your account</div>
                    <form class="form-horizontal" id="main-form" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input name="user-email" id="user-email" type="text" class="form-control" placeholder="Email or User Name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input name="password" id="password" type="password" class="form-control" placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
                        </div>
                        <div class="col-md-6">
                            <button id="login-btn" class="btn btn-info btn-block">Log In</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2020 PIBT Group Project
                    </div>
                    <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div>
                </div>
            </div>
            
        </div>

        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script type="text/javascript">

            $('#login-btn').on('click', function(e){
                e.preventDefault();

                let data = $('#main-form').serialize();

                $.ajax({
                    url : 'pages/database/login-check.php',
                    data : data,
                    method : 'post',
                    dataType: 'json',

                    error : function(e){
                        console.log(e);
                    },
                    success : function(r){
                        if (r.result === "empty"){
                            swal ("Fields Can't be empty", 'Come again with User Credentials', 'warning');
                        } else if (r.result === "error") {
                            swal ('Username or Password is Incorrect', 'Be sure with your credentials', 'error');
                        } else if (r.result === "success"){
                            window.location.replace('home.php');
                        }
                    }
                });
            });

        </script>

        <noscript><div><img src="https://mc.yandex.ru/watch/25836617" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    </body>
</html>






