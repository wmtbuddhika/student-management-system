<div class="row">
    <div class="col-md-12">
        <!-- START MASKED INPUT PLUGIN -->
        <div class="panel panel-default">
            <div class="panel-body">
                <input type="hidden" name="user_id" id="user_id" value="0">
                <hr><h3 class="text-uppercase">MODULE DETAILS</h3><hr>
                <form class="form-horizontal" role="form" enctype="multipart/form-data" id="main-form" method="POST">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Module Code *</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" value="" name="module_code" id="module_code" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Module Name *</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="module_name" id="module_name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                            <label class="col-md-3 control-label">Remarks</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="" name="remark"/>
                            </div>
                        </div>
                        <div class="form-group" id="active_div">
                            <label class="col-md-3 control-label">Active *</label>
                            <div class="col-md-9">
                                <input type="Checkbox" checked="checked" name="active" id="active" value="1" required/>
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