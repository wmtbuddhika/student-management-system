<div class="row">
    <div class="col-md-12">
        <!-- START MASKED INPUT PLUGIN -->
        <div class="panel panel-default">
            <div class="panel-body">
                <input type="hidden" name="user_id" id="user_id" value="0">
                <hr><h3 class="text-uppercase">TUTOR DETAILS</h3><hr>
                <form class="form-horizontal" role="form" enctype="multipart/form-data" id="main-form" method="POST">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tutor Code *</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" value="" name="tutor_code" id="epf_no" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Full Name *</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="full_name" id="full_name"/>
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
                                <input type="text" class="form-control" value="" name="nic_name" id="nic_name"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date of Birth *</label>
                            <div class="col-md-5">
                                <div class="input-group date">
                                    <input type="text" class="form-control datepicker" value="" name="dob" id="dob"/>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nationality *</label>
                            <div class="col-md-3">
                                <select name="nationality" id="Nationality">
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
                                    <option value="" disabled>Choose option</option>
                                    <option value="1">Single</option>
                                    <option value="2">Married</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Gender</label>
                            <div class="col-md-3">
                                <select name="gender" id="gender">
                                    <option value="" disabled>Choose option</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="active_div">
                            <label class="col-md-3 control-label">Active *</label>
                            <div class="col-md-9">
                                <input type="Checkbox" checked="checked" name="active" id="active" value="1" />
                            </div>
                        </div>
                    </div>

                    <hr><h3 class="text-uppercase">CONTACT DETAILS</h3><hr>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address * </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="add_str_fist" id="add_str_fist"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Personal Phone *</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="personal_number" id="personal_number"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">E-mail *</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="other_email" id="other_email"/>
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
                        <div class="form-group" id="active_div">
                            <label class="col-md-3 control-label">Active *</label>
                            <div class="col-md-9">
                                <input type="Checkbox" checked="checked" name="active" id="active" value="1" />
                            </div>
                        </div>
                        <div class="btn-group pull-right">
                            <button class="btn btn-primary text-uppercase" type="submit">save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>