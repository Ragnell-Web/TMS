<div class="modal fade" id="modal-role-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Role (<span id="modal-role-name">New</span>)</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <form method="post" id="role-form">
                            <span id="form-output"></span>

                            {{ csrf_field() }}
                            <input class="form-control" type="hidden" name="id" id="role-id">
                            
                            <div class="form-group">
                                <label for="role-name" class="col-form-label">Name</label>
                                <input class="form-control" type="text" name="name" id="role-name" placeholder="E.g. IT Staff" required>
                                <h6 class="form-view" id="role-view-name"></h6>
                            </div>

                            <div class="form-group">
                                <label for="role-description" class="col-form-label">Description</label>
                                <textarea class="form-control" name="description" id="role-description" placeholder="E.g. This is role for IT Staff"></textarea>
                                <h6 class="form-view" id="role-view-description"></h6>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="role-form" class="btn btn-success" id="role-submit"><i class="ti-check"></i> Save</button>
            </div>
        </div>
    </div>
</div>
