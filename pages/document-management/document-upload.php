<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form role="form" class="form-horizontal" action="../../document-management.php" method="post" enctype="multipart/form-data">
                    <hr><h3 class="text-uppercase">document upload</h3><hr>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Group</label>
                        <div class="col-md-4">
                            <select name="allocation" class="form-control select" data-live-search="true">
                                <option selected disabled>Select Group</option>

                                <?php
                                require_once('./pages/database/main_db.php');
                                $allocationId = $_SESSION['allocation_id'];
                                $query = "SELECT a.id, a.code FROM allocation a WHERE a.status = 1 AND a.id IN ($allocationId)";

                                $result = mysqli_query($con, $query);

                                while($data = mysqli_fetch_array($result)){

                                    ?>

                                    <option value="<?php echo $data['id'];?>"><?php echo $data['code']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">File</label>
                        <div class="upload-btn-wrapper">
                            <input type="file" id="my-file" name="uploaded_file" class="my-file"/>
                            <div class="btn-group pull-right">
                                <button class="btn btn-primary text-uppercase" name="submit" type="submit">upload</button>
                            </div>
                        </div>
                    </div>
                </form>
                <h4>
                <?php
                require_once('./pages/database/main_db.php');

                if(isset($_POST["submit"]) && !empty($_FILES['uploaded_file']))
                {
                    $t = time();
                    $uuid = date("Ymdhms",$t);
                    $path = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
                    $fileName = basename( $_FILES['uploaded_file']['name']);
                    $userId = $_SESSION['user_id'];
                    $allocationId = $_SESSION['allocation_id'];
                    $path = $path . $uuid . "|" . $fileName;
                    $allocationId = $_POST["allocation"];

                    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
                        $query = "INSERT INTO document (uuid, file_name, status, user_id, allocation_id) VALUES ($uuid,'$fileName', 1, $userId, $allocationId);";
                        $query_execute = mysqli_query($con, $query);
                        echo "The file ".  $fileName . " has been uploaded";
                    } else{
                        echo "There was an error uploading the file, please try again!";
                    }
                }
                ?>
                </h4>
            </div>
        </div>
    </div>
</div>

<style>
    .my-file {
        border: 2px solid gray;
        color: gray;
        background-color: white;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 20px;
        font-weight: bold;
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 15px;
    }
</style>
