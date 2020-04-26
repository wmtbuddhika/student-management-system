
<div id="document-comments" style="visibility: hidden" class="row">
    <div class="col-md-12">
        <!-- START MASKED INPUT PLUGIN -->
        <div class="panel panel-default">
            <div class="panel-body">
                <input type="hidden" name="user_id" id="user_id" value="0">
                <hr><h3 class="text-uppercase">document comments</h3><hr>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Document Name</label>
                        <label id="file-name" class="col-md-5 control-label"></label>
                    </div>
                </div>
                <br/><br/>
                <form class="form-horizontal" role="form" enctype="multipart/form-data" id="main-form" method="POST">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-1 control-label">Comment</label>
                            <div class="col-md-10">
                                <textarea type="text" class="form-control comment-value" value="" ></textarea>
                            </div>
                            <div class="btn-group pull-right">
                                <button class="btn btn-primary text-uppercase" name="submit" type="button" onclick="saveComments()">save</button>
                            </div>
                        </div>
                    </div>
                </form>
                <br/>
                <hr>
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

<script type="text/javascript">

    function saveComments() {
        var documentId = $(".comment-value").attr('id');
        var comment = $(".comment-value").val();
        var userId = '<?php echo $_SESSION['user_id']?>';
        $.ajax({
            url : 'pages/database/save-document-comments.php',
            data : {'user_id': userId, 'document_id': documentId, 'comment': comment},
            method : 'post',
            dataType: 'json',

            error : function(e){
                console.log(e);
            },
            success : function(r){
                if (r.response == 'success') {
                    $(".comment-value").val("");
                    loadComments(documentId);
                }
            }
        });
    }

    function loadComments(documentId) {
        $("#document-comments").css("visibility", "visible");

        $.ajax({
            url : 'pages/database/load-document-comments.php',
            data : {'document_id': documentId},
            method : 'post',
            dataType: 'json',

            error : function(e){
                console.log(e);
            },
            success : function(r){
                if (r.comments.length > 0) {
                    $("#document-comments").css("visibility", "visible");
                    $("#file-name").text(r.comments[0].file_name);
                    $(".comment-value").attr('id', r.comments[0].document_id);
                    $("#comments").find("tr:gt(0)").remove();

                    for (var i = 0; i < r.comments.length; i++) {
                        $('#comments > tbody:last-child').append('<tr>' +
                            '<td>' + r.comments[i].user_name + '</td>' +
                            '<td>' + r.comments[i].comment + '</td>' +
                            '<td>' + r.comments[i].created_date + '</td>' +
                            '</tr>');
                    }
                    $('html, body').animate({
                        scrollTop: $("#document-comments").offset().top
                    }, 2000);
                }
            }
        });
    }

</script>