<div class="row">
    <div class="col-md-12">
        <!-- START MASKED INPUT PLUGIN -->
        <div class="panel panel-default">
            <div class="panel-body table-responsive">
                <input type="hidden" name="user_id" id="user_id" value="0">
                <hr><h3 class="text-uppercase">ALL modules</h3><hr>
                <table class="table table-bordered table-striped table-actions datatable">
                    <thead>
                    <tr>
                        <th>Batch Code</th>
                        <th>Batch Name</th>
                        <th>Starting Date</th>
                        <th>Remarks</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 

                            require_once('pages/database/main_db.php');

                            $tutor_main_select_query = "SELECT
                                module.id,
                                module.`code`,
                                module.`name`,
                                module.start_date,
                                module.remarks
                            FROM
                                module WHERE status = 1";

                            $query_execute = mysqli_query($con, $tutor_main_select_query);

                            while ($result = mysqli_fetch_array($query_execute)) {
                        ?>

                    <tr id="trow_1">
                        <td><strong><?php echo $result['code']; ?></strong></td>
                        <td><strong><?php echo $result['name']; ?></strong></td>
                        <td><strong><?php echo $result['start_date']; ?></strong></td>
                        <td><strong><?php echo $result['remarks']; ?></strong></td>
                        <td>
                            <button value="<?php echo $result['id']; ?>" class="btn btn-default btn-rounded btn-condensed btn-sm edit"><span class="fa fa-pencil"></span></button>
                            <button value="<?php echo $result['id']; ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete"><span class="fa fa-times"></span></button>
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