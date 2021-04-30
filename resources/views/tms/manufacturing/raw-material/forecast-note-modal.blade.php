<div class="modal fade" id="modal-forecast-note-create-form">
    <div class="modal-dialog modal-80">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Forecast Note (<span id="modal-role-name">New</span>)</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- header -->
                <div class="row">
                    <div class="col">
                        <form method="post" id="modal-form">
                            <span id="form-output"></span>

                            {{ csrf_field() }}
                            <input class="form-control" type="hidden" name="id" id="modal-id">
                            <input class="form-control" type="hidden" name="flag" id="modal-flag">

                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group align-right">
                                                <label for="modal-vendor-code" class="col-form-label text-bold">Rev No</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" readonly="readonly" type="text" name="rev_no" id="modal-RevNo" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group align-right">
                                                <label for="modal-period" class="col-form-label text-bold">User</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" readonly="readonly" type="text" name="by_user" id="modal-by_user" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group align-right">
                                                <label for="modal-vendor-code" class="col-form-label text-bold">Vendor Code</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" readonly="readonly" type="text" name="vendor_code" id="modal-vendor_code" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group align-right">
                                                <label for="modal-period" class="col-form-label text-bold">Period</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" readonly="readonly" type="text" name="period" id="modal-period" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group align-right">
                                                <label for="modal-period" class="col-form-label text-bold">Create Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" readonly="readonly" type="text" name="create_date" id="modal-create_date" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end of header -->

                <hr />

                <!-- detail -->
                <div class="row">
                    <div class="col-12">
                        <div class="data-tables datatable-dark">
                            <table id="dtForecastNoteOp" class="table table-striped" style="width:100%">
                                {{ csrf_field() }}
                                <thead class="text-center">
                                    <tr>
                                        <th>Item Code</th>
                                        <th>ID</th>
                                        <th>Description</th>
                                        <th>Model</th>
                                        <th>Factor</th>
                                        <th>%Dist</th>
                                        <th>(N)</th>
                                        <th>(N+1)</th>
                                        <th>(N+2)</th>
                                        <th>(N+3)</th>
                                        <th>(N+4)</th>
                                        <th>(N+5)</th>
                                        <th>(N+6)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
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
