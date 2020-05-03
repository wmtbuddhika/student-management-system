<div class="row">
    <div class="col-md-12">
        <!-- START MASKED INPUT PLUGIN -->
        <div class="panel panel-default">
            <div class="panel-body">
                <input type="hidden" name="user_id" id="user_id" value="0">
                <hr><h3 class="text-uppercase">ALL TUTORS</h3><hr>
                <table class="table table-bordered table-striped table-actions">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>CODE</th>
                        <th>NAME</th>
                        <th>DOB</th>
                        <th>NIC</th>
                        <th>MOBILE</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 

                            require_once('pages/database/main_db.php');

                            $selec_tutors = "SELECT
                                `user`.id,
                                `user`.`code`,
                                `user`.`name`,
                                `user`.date_of_birth,
                                `user`.nic_no,
                                `user`.mobile_no,
                                `user`.email,
                                login.user_name,
                                login.`password`
                            FROM
                                `user`
                            INNER JOIN login ON `user`.id = login.user_id
                            INNER JOIN role ON login.id = role.login_id AND role.permission_id = 2";

                            $tutor_query = mysqli_query($con, $selec_tutors);

                            while($row_data = mysqli_fetch_array($tutor_query)){
                         ?>
                        <tr id="trow_1">
                            <td><?php echo $row_data['id']; ?></td>
                            <td><?php echo $row_data['code']; ?></td>
                            <td><?php echo $row_data['name']; ?></td>
                            <td><?php echo $row_data['date_of_birth']; ?></td>
                            <td><?php echo $row_data['nic_no']; ?></td>
                            <td><?php echo $row_data['mobile_no']; ?></td>
                            <td>
                                <button value="<?php echo $row_data['id']; ?>" class="btn btn-default btn-rounded btn-condensed btn-sm edit"><span class="fa fa-pencil"></span></button>
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