
<div id="blog-comments" style="visibility: hidden" class="row">
    <div class="col-md-12">
        <!-- START MASKED INPUT PLUGIN -->
        <div class="panel panel-default">
            <div class="panel-body">
                <input type="hidden" name="user_id" id="user_id" value="0">
                <hr><h3 class="text-uppercase">blog comments</h3><hr>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Blog Title</label>
                        <label id="blog-title" class="col-md-5 control-label"></label>
                    </div>
                </div>
                <br/><br/>
                <form class="form-horizontal" role="form" enctype="multipart/form-data" id="main-form" method="POST">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-1 control-label">Comment</label>
                            <div class="col-md-8">
                                <textarea type="text" class="form-control comment-value" value="" ></textarea>
                            </div>
                            <div class="btn-group pull-right">
                                <button class="btn btn-primary text-uppercase" name="submit" type="button" onclick="saveComments()">save</button>
                                <button class="btn btn-warning text-uppercase" name="submit" type="button" onclick="removeBlog()">remove blog</button>
                            </div>
                        </div>
                    </div>
                </form>
                <br/>
                <hr>
                <div class="table-responsive">
                    <table id="comments" class="table table-bordered table-striped table-actions">
                        <thead>
                        <tr>
                            <th>name</th>
                            <th>comment</th>
                            <th width="200">date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function saveComments() {
        var blogId = $(".comment-value").attr('id');
        var comment = $(".comment-value").val();
        var userId = '<?php echo $_SESSION['user_id']?>';
        $.ajax({
            url : 'pages/database/save-blog-comments.php',
            data : {'user_id': userId, 'blog_id': blogId, 'comment': comment},
            method : 'post',
            dataType: 'json',

            error : function(e){
                console.log(e);
            },
            success : function(r){
                if (r.response == 'success') {
                    $(".comment-value").val("");
                    loadComments(blogId);
                }
            }
        });
    }

    function loadComments(blogId) {
        $("#blog-comments").css("visibility", "visible");

        $.ajax({
            url : 'pages/database/load-blog-comments.php',
            data : {'blog_id': blogId},
            method : 'post',
            dataType: 'json',

            error : function(e){
                console.log(e);
            },
            success : function(r){
                if (r.comments.length > 0) {
                    $("#blog-comments").css("visibility", "visible");
                    $("#blog-title").text(r.comments[0].title);
                    $(".comment-value").attr('id', r.comments[0].blog_id);
                    $("#comments").find("tr:gt(0)").remove();

                    for (var i = 0; i < r.comments.length; i++) {
                        $('#comments > tbody:last-child').append('<tr>' +
                            '<td>' + r.comments[i].user_name + '</td>' +
                            '<td>' + r.comments[i].comment + '</td>' +
                            '<td>' + r.comments[i].created_date + '</td>' +
                            '</tr>');
                    }
                    $('html, body').animate({
                        scrollTop: $("#blog-comments").offset().top
                    }, 2000);
                }
            }
        });
    }

    function removeBlog() {
        var blogId = $(".comment-value").attr('id');

        swal({
            title: "Confirmation",
            text: "Are you sure ?",
            icon: "warning",
            buttons: ['NO', 'YES'],
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : 'pages/database/remove-blog.php',
                    data : {'blog_id': blogId},
                    dataType : 'json',
                    method : 'post',
                    error: function(e){
                        swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
                    },
                    success : function(r){
                        swal({
                            title: "Success",
                            text: "Blog Removed Successfully",
                            icon: "success",
                            buttons: [null,'OK'],
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                location.href = '../../blog-management.php';
                            }
                        });
                    }
                });
            }
        });
    }

</script>