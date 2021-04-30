<div class="modal fade" id="modal-permission-form">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Permission (<span id="modal-permission-name">New</span>)</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <form method="post" id="permission-form">
                            <span id="form-output"></span>

                            {{ csrf_field() }}
                            <input class="form-control" type="hidden" name="module_item_id" id="module-item-id" value="{{ $moduleItem->id }}">
                            <input class="form-control" type="hidden" name="id" id="permission-id">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="module-name" class="col-form-label">Module Name</label>
                                        <h6>{{ $module->name }}</h6>
                                    </div>
                                    <div class="col">
                                        <label for="module-item-name" class="col-form-label">Module Item Name</label>
                                        <h6>{{ $moduleItem->title }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="permission-name" class="col-form-label">Name</label>
                                        <input class="form-control" type="text" name="name" id="permission-name" placeholder="View" required>
                                        <h6 class="form-view" id="permission-view-name"></h6>
                                    </div>
                                    <div class="col">
                                        <label for="permission-key" class="col-form-label">Key</label>
                                        <input class="form-control" type="text" name="key" id="permission-key" placeholder="view_dashboard" required>
                                        <h6 class="form-view" id="permission-view-key"></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="permission-controller" class="col-form-label">Controller</label>
                                        <input class="form-control" type="text" name="controller" id="permission-controller" placeholder="DashboardController" required>    
                                        <h6 class="form-view" id="permission-view-controller"></h6>
                                    </div>
                                    <div class="col-1">
                                    <h6 id="label-at" style="position: absolute; bottom: 13px;">
                                        @
                                    </h6>
                                    </div>
                                    <div class="col-5">
                                        <label for="permission-method" class="col-form-label">Method</label>
                                        <input class="form-control" type="text" name="method" id="permission-method" placeholder="viewDashboard" required>
                                        <h6 class="form-view" id="permission-view-method"></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="permission-description" class="col-form-label">Description</label>
                                <textarea class="form-control" name="description" id="permission-description" placeholder="This permission to access dashboard page."></textarea>
                                <h6 class="form-view" id="permission-view-description"></h6>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="permission-form" class="btn btn-success" id="permission-submit"><i class="ti-check"></i> Save</button>
            </div>
        </div>
    </div>
</div>
