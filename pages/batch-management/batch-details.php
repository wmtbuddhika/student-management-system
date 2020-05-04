<div class="row">
    <div class="col-md-12">
        <!-- START MASKED INPUT PLUGIN -->
        <div class="panel panel-default">
            <div class="panel-body">
                <input type="hidden" name="operation" id="operation" value="0">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" id="main-form" method="POST">
                <input type="hidden" name="batch_id_" id="batch_id_" value="0">
                <hr><h3 class="text-uppercase">BATCH DETAILS</h3><hr>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Batch ID *</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" value="" name="batch_code" id="batch_code" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Batch Name *</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="batch_name" id="batch_name" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Remarks</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="remark" id="remark" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Starting Date *</label>
                            <div class="col-md-5">
                                <div class="input-group date">
                                    <input type="text" class="form-control datepicker" value="" name="startingDate" id="startingDate" required/>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="active_div" hidden>
                            <label class="col-md-3 control-label">Active</label>
                            <div class="col-md-9">
                                <input type="Checkbox" name="active" id="active" checked value="1"/>
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