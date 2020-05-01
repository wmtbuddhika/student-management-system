
<div id="edit-chat" style="visibility: hidden" class="row">
    <div class="col-md-12">
        <!-- START MASKED INPUT PLUGIN -->
        <div class="panel panel-default">
            <div class="panel-body">
                <hr><h3 class="text-uppercase">Edit chat Message</h3><hr>

                <form class="form-horizontal" role="form" enctype="multipart/form-data" id="main-form" method="POST">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-1 control-label">Message</label>
                            <div class="col-md-9">
                                <textarea type="text" class="form-control comment-value" value="" ></textarea>
                            </div>
                            <div class="btn-group pull-right">
                                <button class="btn btn-primary text-uppercase" name="submit" type="button" onclick="updateChat()">save</button>
                                <button class="btn btn-warning text-uppercase" name="submit" type="button" onclick="removeChat()">remove</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function editChat(chatId, userId, message) {
        let user_id = '<?php echo $_SESSION['user_id']?>';
        if (userId == user_id) {
            $("#edit-chat").css("visibility", "visible");
            $(".comment-value").attr('id', chatId);
            $('.comment-value').val(message)

            $('html, body').animate({
                scrollTop: $("#edit-chat").offset().top
            }, 2000);
        }
    }

    function updateChat() {
        var chatId = $(".comment-value").attr('id');
        var chatMessage = $(".comment-value").val();

        $.ajax({
            url : 'pages/database/save-chat.php',
            data : {'chat_id': chatId, 'message' : chatMessage},
            dataType : 'json',
            method : 'post',
            error: function(e){
                swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
            },
            success : function(r){
                if(r.message === 'success'){
                    $("#edit-chat").css("visibility", "hidden");
                    swal ("Success", 'Congratulations. New Tutor has Registered', 'success');
                } else if(r.message === 'empty'){
                    swal ("Sorry", 'Fields Can not be empty', 'error');
                } else if(r.message === 'exist'){
                    swal ("Sorry", 'This Student Already In', 'warning');
                }
            }
        });
        $('html, body').animate({
            scrollTop: $("#chat-form").offset().top
        }, 2000);
    }

    function removeChat() {
        var chatId = $(".comment-value").attr('id');

        $.ajax({
            url : 'pages/database/remove-chat.php',
            data : {'chat_id': chatId},
            dataType : 'json',
            method : 'post',
            error: function(e){
                swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
            },
            success : function(r){
                if(r.message === 'success'){
                    $("#edit-chat").css("visibility", "hidden");
                    swal ("Success", 'Congratulations. New Tutor has Registered', 'success');
                } else if(r.message === 'empty'){
                    swal ("Sorry", 'Fields Can not be empty', 'error');
                } else if(r.message === 'exist'){
                    swal ("Sorry", 'This Student Already In', 'warning');
                }
            }
        });
        $('html, body').animate({
            scrollTop: $("#chat-form").offset().top
        }, 2000);
    }
</script>