<div class="row">
    <div class="col-md-12">
        <!-- START MASKED INPUT PLUGIN -->
        <div class="panel panel-default">
            <div class="panel-body">
                <input type="hidden" name="user_id" id="user_id" value="0">
                <hr><h3 class="text-uppercase">ALL blog</h3><hr>
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

                        $tutor_main_select_query = "SELECT a.code,b.title,b.content FROM blog b, allocation a WHERE a.id = b.allocation_id AND b.status = 1 AND b.allocation_id IN ($allocationId) ORDER BY b.title";

                        $query_execute = mysqli_query($con, $tutor_main_select_query);

                        while ($result = mysqli_fetch_array($query_execute)) {
                    ?>

                    <tr id="trow_1">
                        <td><strong><?php echo $result['code']; ?></strong></td>
                        <td><strong><?php echo $result['title']; ?></strong></td>
                        <td><strong><?php echo $result['content']; ?></strong></td>
                        <td>
                            <button class="btn btn-default btn-rounded btn-condensed btn-sm"><span class="fa fa-pencil"></span></button>
                            <button class="btn btn-danger btn-rounded btn-condensed btn-sm" onClick="delete_row('trow_1');"><span class="fa fa-times"></span></button>
                        </td>
                    </tr>

                    <?php 
                        }
                     ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>