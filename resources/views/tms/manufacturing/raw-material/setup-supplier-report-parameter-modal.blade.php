<div class="modal fade" id="modal-setup-supplier-report-parameter-form">
    <div class="modal-dialog modal-30">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Report Parameter (<span id="report-parameter-modal-role-name">New</span>)</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <form method="post" id="report-parameter-modal-form">
                            <span id="report-parameter-form-output"></span>

                            {{ csrf_field() }}
                            <input class="form-control" type="hidden" name="id" id="report-parameter-modal-id">
                            <input class="form-control" type="hidden" name="flag" id="report-parameter-modal-flag">
                            <input class="form-control" type="hidden" name="mode" id="report-parameter-modal-mode">
                            <input class="form-control" type="hidden" name="by_user" id="report-parameter-modal-by_user">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="report-parameter-modal-ld" class="col-form-label">Report LD Number</label>
                                        <input class="form-control" type="text" name="ld" id="report-parameter-modal-ld" placeholder="LD-PCH-XX" required>
                                        <h6 class="report-parameter-form-view" id="report-parameter-modal-ld"></h6>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="report-parameter-modal-prepared" class="col-form-label">Prepared By</label>
                                        <input class="form-control" type="text" name="prepared" id="report-parameter-modal-prepared" placeholder="pic name" required>
                                        <h6 class="report-parameter-form-view" id="report-parameter-modal-prepared"></h6>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="report-parameter-modal-checked" class="col-form-label">Checked By</label>
                                        <input class="form-control" type="text" name="checked" id="report-parameter-modal-checked" placeholder="pic name" required>
                                        <h6 class="report-parameter-form-view" id="report-parameter-modal-checked"></h6>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="report-parameter-modal-approved" class="col-form-label">Approved By</label>
                                        <input class="form-control" type="text" name="approved" id="report-parameter-modal-approved" placeholder="pic name" required>
                                        <h6 class="report-parameter-form-view" id="report-parameter-modal-approved"></h6>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="report-parameter-modal-startDate" class="col-form-label">Order Start Date</label>
                                        <input class="form-control" type="text" name="start_date" id="report-parameter-modal-startDate" placeholder="start date" required>
                                        <h6 class="report-parameter-form-view" id="report-parameter-modal-startDate"></h6>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="report-parameter-modal-endDate" class="col-form-label">Order End Date</label>
                                        <input class="form-control" type="text" name="end_date" id="report-parameter-modal-endDate" placeholder="end date" required>
                                        <h6 class="report-parameter-form-view" id="report-parameter-modal-endDate"></h6>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="report-parameter-modal-form" class="btn btn-success" id="report-parameter-modal-submit"><i class="ti-check"></i> Save</button>
            </div>
        </div>
    </div>
</div>
