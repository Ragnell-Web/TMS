<div class="modal fade" id="modal-item-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Module Item (<span id="modal-item-name">New</span>)</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <form method="post" id="item-form">
                            <span id="form-output"></span>

                            {{ csrf_field() }}
                            <input class="form-control" type="hidden" name="moduleId" id="module-id" value="{{ $module->id }}">
                            <input class="form-control" type="hidden" name="id" id="item-id">
                            <div class="form-group">
                                <label for="module-name" class="col-form-label">Module Name</label>
                                <h6>{{ $module->name }}</h6>
                            </div>
                            <div class="form-group">
                                <label for="item-title" class="col-form-label">Title</label>
                                <input class="form-control" type="text" name="title" id="item-title" required>
                            </div>
                            <div class="form-group">
                                <label for="item-url" class="col-form-label">URL</label>
                                <input class="form-control" type="text" name="url" id="item-url" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-8">
                                        <label for="item-icon" class="col-form-label">Icon</label>
                                        <input class="form-control" type="text" name="icon" id="item-icon">
                                        
                                    </div>
                                    <div class="col-4">
                                        <label for="icon-preview">Icon Image</label><br />
                                        <i id="icon-preview" style="font-size: 44px"></i>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="item-form" class="btn btn-success"><i class="ti-check"></i> Save</button>
            </div>
        </div>
    </div>
</div>
