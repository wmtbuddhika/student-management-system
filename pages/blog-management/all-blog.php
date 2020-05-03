<div class="row">
    <div class="col-md-12">
        <!-- START MASKED INPUT PLUGIN -->
        <div class="panel panel-default">
            <div class="panel-body">
                <input type="hidden" name="user_id" id="user_id" value="0">
                <hr><h3 class="text-uppercase">ALL blog</h3><hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-actions">
                        <thead>
                        <tr>
                            <th>Group</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            require_once('pages/database/main_db.php');
                            $allocationId = $_SESSION['allocation_id'];
                            if ($allocationId != null) {
                                $userId = $_SESSION['user_id'];
                                $userType = $_SESSION['user_type'];

                                $query = "SELECT b.id,ag.code,b.title,b.content FROM blog b, allocation_group ag 
                                WHERE ag.id = b.allocation_id AND b.status = 1 AND b.allocation_id IN ($allocationId) ";

                                if ($userType == 3) {
                                    $query = $query . "AND (SELECT COUNT(a.id) FROM allocation a WHERE a.student_id = $userId AND a.status = 1 AND a.allocation_group_id = ag.id) > 0";
                                }

                                $query_execute = mysqli_query($con, $query);

                                while ($result = mysqli_fetch_array($query_execute)) {
                                    ?>

                                    <tr>
                                        <td><strong><?php echo $result['code']; ?></strong></td>
                                        <td><strong><?php echo $result['title']; ?></strong></td>
                                        <td><strong><?php echo $result['content']; ?></strong></td>
                                        <td>
                                            <button onclick="editBlog(<?php echo $result['id']; ?>)"
                                                    class="btn btn-default btn-rounded btn-condensed btn-sm"><span
                                                        class="fa fa-pencil"></span></button>
                                            <button onclick="loadComments(<?php echo $result['id']; ?>)"
                                                    class="btn btn-default btn-rounded btn-condensed btn-sm"><span
                                                        class="fa fa-book"></span></button>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                         ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function editBlog(blogId) {
        $.ajax({
            url : 'pages/database/load-blog.php',
            data : {'blog_id': blogId},
            dataType : 'json',
            method : 'post',
            error: function(e){
                swal ("Something Wrong", 'Please Contact Your System Administrator', 'warning');
            },
            success : function(r){
                $('#blog_id').val(r.blog[0].id);
                $('#title').val(r.blog[0].title);
                $('.note-editable').html(r.blog[0].content);
            }
        });
        $('html, body').animate({
            scrollTop: $("#blog-details").offset().top
        }, 2000);
    }
</script>