
<div id="meeting-minutes" style="visibility: hidden" class="row">
    <div class="col-md-12">
        <!-- START MASKED INPUT PLUGIN -->
        <div class="panel panel-default">
            <div class="panel-body">
                <input type="hidden" name="user_id" id="user_id" value="0">
                <hr><h3 class="text-uppercase">meeting minutes</h3><hr>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Meeting Topic</label>
                        <label id="meeting-title" class="col-md-5 control-label"></label>
                    </div>
                </div>
                <br/><br/>
                <form class="form-horizontal" role="form" enctype="multipart/form-data" id="main-form" method="POST">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-1 control-label">Minutes</label>
                            <div class="col-md-10">
                                <textarea type="text" class="form-control comment-value" value="" ></textarea>
                            </div>
                            <div class="btn-group pull-right">
                                <button class="btn btn-primary text-uppercase" name="submit" type="button" onclick="saveMinutes()">save</button>
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
                            <th width="200">Entered By</th>
                            <th>Minutes</th>
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

    function saveMinutes() {
        var meetingId = $(".comment-value").attr('id');
        var minute = $(".comment-value").val();
        var userId = '<?php echo $_SESSION['user_id']?>';
        $.ajax({
            url : 'pages/database/save-meeting-minutes.php',
            data : {'user_id': userId, 'meeting_id': meetingId, 'minute': minute},
            method : 'post',
            dataType: 'json',

            error : function(e){
                console.log(e);
            },
            success : function(r){
                if (r.response == 'success') {
                    $(".comment-value").val("");
                    loadMinutes(meetingId);
                }
            }
        });
    }

    function loadMinutes(meetingId) {
        $("#meeting-minutes").css("visibility", "visible");

        $.ajax({
            url : 'pages/database/load-meeting-minutes.php',
            data : {'meeting_id': meetingId},
            method : 'post',
            dataType: 'json',

            error : function(e){
                console.log(e);
            },
            success : function(r){
                if (r.comments.length > 0) {
                    $("#meeting-title").text(r.comments[0].title);
                    $(".comment-value").attr('id', r.comments[0].meeting_id);
                    $("#comments").find("tr:gt(0)").remove();

                    for (var i = 0; i < r.comments.length; i++) {
                        $('#comments > tbody:last-child').append('<tr>' +
                            '<td>' + r.comments[i].user_name + '</td>' +
                            '<td>' + r.comments[i].minute + '</td>' +
                            '<td>' + r.comments[i].created_date + '</td>' +
                            '</tr>');
                    }
                    $('html, body').animate({
                        scrollTop: $("#meeting-minutes").offset().top
                    }, 2000);
                }
            }
        });
    }

</script>