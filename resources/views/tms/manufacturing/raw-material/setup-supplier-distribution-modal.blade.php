<div class="modal fade" id="modal-setup-supplier-distribution-form">
    <div class="modal-dialog modal-30">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Supplier Mapping (<span id="modal-role-name">New</span>)</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <form method="post" id="modal-form">
                            <span id="form-output"></span>

                            {{ csrf_field() }}
                            <input class="form-control" type="hidden" name="id" id="modal-id">
                            <input class="form-control" type="hidden" name="flag" id="modal-flag">
                            <input class="form-control" type="hidden" name="by_user" id="modal-by_user">

                            <div class="form-group">
                                <label for="modal-item-code" class="col-form-label">Item Code</label>
                                    <!-- <select class="form-control" style="height:10%" type="text" name="item_code" id="modal-cmbItemCode" required>
                                        <option value=''>-- Select Item Code --</option>
                                    </select> -->
                                    <select class="form-control" id="modal-item-code" name="item_code" style="width: 100%"></select>
                            </div>
                            <div class="form-group">
                                <label for="modal-supplier" class="col-form-label">Supplier</label>
                                    <!-- <select class="form-control" style="height:10%" type="text" name="supplier" id="modal-cmbSupplier" required>
                                        <option value=''>-- Select Supplier --</option>
                                    </select> -->
                                    <select class="form-control" id="modal-supplier" name="supplier" style="width: 100%"></select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="modal-distribution" class="col-form-label">% Distribution</label>
                                        <input class="form-control" type="text" name="distribution" id="modal_distribution" placeholder="E.g. 0 - 100" required>
                                        <h6 class="form-view" id="modal_distribution"></h6>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="modal-form" class="btn btn-success" id="modal-submit"><i class="ti-check"></i> Save</button>
            </div>
        </div>
    </div>
</div>
