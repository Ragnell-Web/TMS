<div class="modal fade" id="modal-setup-supplier-report-clusterization-form">
    <div class="modal-dialog modal-30">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Supplier Setup on Raw Material Mapping by Model (<span id="report-clusterization-modal-role-name">New</span>)</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <form method="post" id="report-clusterization-modal-form">
                            <span id="report-clusterization-form-output"></span>

                            {{ csrf_field() }}
                            <input class="form-control" type="hidden" name="id" id="report-clusterization-modal-id">
                            <input class="form-control" type="hidden" name="flag" id="report-clusterization-modal-flag">
                            <input class="form-control" type="hidden" name="mode" id="report-clusterization-modal-mode">
                            <input class="form-control" type="hidden" name="by_user" id="report-clusterization-modal-by_user">

                            <div class="form-group">
                                <label for="report-clusterization-modal-supplier" class="col-form-label">Supplier</label>
                                    <!-- <select class="form-control" style="height:10%" type="text" name="supplier" id="modal-cmbSupplier" required>
                                        <option value=''>-- Select Supplier --</option>
                                    </select> -->
                                    <select class="form-control" id="report-clusterization-modal-supplier" name="supplier" style="width: 100%"></select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="report-clusterization-modal-form" class="btn btn-success" id="report-clusterization-modal-submit"><i class="ti-check"></i> Save</button>
            </div>
        </div>
    </div>
</div>
