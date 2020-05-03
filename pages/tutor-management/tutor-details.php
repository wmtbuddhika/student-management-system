<?php require_once('pages/database/main_db.php'); ?>

<form class="form-horizontal" role="form" enctype="multipart/form-data" id="main-form" method="POST">
    <input type="hidden" name="user_type" value="2">
    <div class="row">
        <div class="col-md-12">
            <!-- START MASKED INPUT PLUGIN -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <input type="hidden" id="operation" name="operation" value="0">
                    <input type="hidden" name="user_id" id="user_id" value="0">
                    <hr><h3 class="text-uppercase">TUTOR DETAILS</h3><hr>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tutor Code *</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" value="" name="code" id="code" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Full Name *</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="full_name" id="full_name" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Calling Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="calling_name" id="calling_name"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">NIC No *</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="nic_name" id="nic_name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date of Birth *</label>
                            <div class="col-md-5">
                                <div class="input-group date">
                                    <input type="date" value="" name="dob" id="dob" required/>
                                    <!-- <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nationality *</label>
                            <div class="col-md-3">
                                <select name="nationality" id="Nationality" required>
                                    <option value="" disabled selected>Select option</option>
                                    <option value="1">Sri Lankan</option>
                                    <option value="2">English</option>
                                    <option value="3">Indian</option>
                                    <option value="4">Chinese</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Marital Status</label>
                            <div class="col-md-3">
                                <select name="marital_status" id="marital_status">
                                    <option value="1">Single</option>
                                    <option value="2">Married</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Gender</label>
                            <div class="col-md-3">
                                <select name="gender" id="gender">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="active_div">
                            <label class="col-md-3 control-label">Active *</label>
                            <div class="col-md-9">
                                <input type="Checkbox" name="active" id="active" value="1" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- START MASKED INPUT PLUGIN -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <hr><h3 class="text-uppercase">CONTACT DETAILS</h3><hr>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address * </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="address" id="address" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mobile No</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="mobile_no" id="mobile_no"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">E-mail *</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="email" id="email" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Land Phone</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="land_number" id="land_number"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Office Line</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="office_number" id="office_number"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- START MASKED INPUT PLUGIN -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <hr><h3 class="text-uppercase">LOGIN DETAILS</h3><hr>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">User Name * </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="user_name" id="user_name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password *</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password" id="password" required/>
                            </div>
                        </div>
                        <div class="btn-group pull-right">
                            <button class="btn btn-primary text-uppercase" type="submit">save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>