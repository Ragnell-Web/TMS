<div class="modal fade" id="modal-setup-supplier-distribution-doubleMapping-form">
    <div class="modal-dialog modal-30">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="modal-role-header">New</span></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="data-tables datatable-dark">
                            <table id="dtMappingDistributionWarning" class="table table-striped" style="width:100%">
                                {{ csrf_field() }}
                                <thead class="text-center">
                                    <tr>
                                        <th>Item Code</th>
                                        <th><span id="modal-role-sub_header">Mapping Freq</span></th>
                                    </tr>
                                </thead>

                                <tbody></tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
