<div class="modal fade" id="modal-setup-supplier-report-information-form">
    <div class="modal-dialog modal-30">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Supplier Information (<span id="report-information-modal-role-name">New</span>)</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <form method="post" id="report-information-modal-form">
                            <span id="report-information-form-output"></span>

                            {{ csrf_field() }}
                            <input class="form-control" type="hidden" name="id" id="report-information-modal-id">
                            <input class="form-control" type="hidden" name="flag" id="report-information-modal-flag">
                            <input class="form-control" type="hidden" name="by_user" id="report-information-modal-by_user">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="report-information-modal-vendor_code" class="col-form-label">Vendor Code</label>
                                        <input class="form-control" type="text" name="vendor_code" id="report-information-modal-vendor_code" placeholder="entry vendor code" disabled>
                                        <h6 class="report-information-form-view" id="report-information-modal-vendor_code"></h6>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="report-information-modal-contact" class="col-form-label">Contact</label>
                                        <input class="form-control" type="text" name="contact" id="report-information-modal-contact" placeholder="entry contact name" required>
                                        <h6 class="report-information-form-view" id="report-information-modal-contact"></h6>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="report-information-modal-phone" class="col-form-label">Phone Number</label>
                                        <input class="form-control" type="text" name="phone" id="report-information-modal-phone" placeholder="entry phone number" required>
                                        <h6 class="report-information-form-view" id="report-information-modal-phone"></h6>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="report-information-modal-fax" class="col-form-label">Fax Number</label>
                                        <input class="form-control" type="text" name="fax" id="report-information-modal-fax" placeholder="entry fax number" required>
                                        <h6 class="report-information-form-view" id="report-information-modal-fax"></h6>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="report-information-modal-form" class="btn btn-success" id="report-information-modal-submit"><i class="ti-check"></i> Save</button>
            </div>
        </div>
    </div>
</div>
