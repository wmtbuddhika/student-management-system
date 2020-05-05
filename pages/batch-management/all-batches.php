<div class="row">
    <div class="col-md-12">
        <!-- START MASKED INPUT PLUGIN -->
        <div class="panel panel-default">
            <div class="panel-body table-responsive">
                <input type="hidden" name="user_id" id="user_id" value="0">
                <hr><h3 class="text-uppercase">ALL BATCHES</h3><hr>
                <table class="table table-bordered table-striped table-actions datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>START DATE</th>
                        <th>REMARKS</th>
                        <th width="150">ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 

                        require_once('pages/database/main_db.php');

                        $batch_query = "SELECT
                            batch.id,
                            batch.`name`,
                            batch.created_date,
                            batch.`code`,
                            batch.start_date,
                            batch.remarks
                        FROM
                            `batch`
                        WHERE
                            batch.`status` = '1'";

                        $batch_execute = mysqli_query($con, $batch_query);

                        while($batch_data = mysqli_fetch_array($batch_execute)){
                     ?>
                    <tr id="trow_3">
                        <td><?php echo $batch_data['code']; ?></td>
                        <td><?php echo $batch_data['name']; ?></td>
                        <td><?php echo $batch_data['start_date']; ?></td>
                        <td><?php echo $batch_data['remarks']; ?></td>
                        <td>
                            <button value="<?php echo $batch_data['id'];?>" class="btn btn-default btn-rounded btn-condensed btn-sm edit"><span class="fa fa-pencil"></span></button>
                            <button value="<?php echo $batch_data['id'];?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete"><span class="fa fa-times"></span></button>
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