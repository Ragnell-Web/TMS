@extends('master')

@section('title', 'TMS | Manufacturing - Raw Material')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/Responsive-2.2.5/css/responsive.dataTables.min.css') }}">

@endsection

@section('content')

@include('tms.__layouts.tms-menuRawMaterial-horizontal')
@include('tms.manufacturing.raw-material.forecast-note-modal')


<div class="main-content-inner">

    <div id="div-unsticky">
        <div class="row" id='row-form'>
            <div class="col-12 mt-3" id="col-form">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group" style="margin: 0px 0px;">
                                    <select class="form-control" style="height:5%" type="text" name="supplier" id="cmbSupplierForecastNote" required>
                                        <option value=''>-- Select Supplier --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-auto" style="margin: 0px -5px;">
                                <div class="form-group" style="margin: 0px -5px;">
                                    <select class="form-control" style="height:5%" type="text" name="period" id="cmbPeriodForecastNote" required>
                                        <option value=''>-- Select Period --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-auto" style="margin: 0px -10px;">
                                @php echo $ViewButton @endphp
                            </div>
                            <div class="col-md-auto" style="margin: 0px -10px;">
                                @php echo $CreateButton @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id='view-rowForm' hidden>
        <div class="col-12 mt-3" id="view-colForm">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Forecast Note Data</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- header -->
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group align-right">
                                                <label for="modal-vendor-code" class="col-form-label text-bold">Rev No</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" readonly="readonly" type="text" name="rev_no" id="view-RevNo" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group align-right">
                                                <label for="modal-period" class="col-form-label text-bold">Created By</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" readonly="readonly" type="text" name="by_user" id="view-by_user" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group align-right">
                                                <label for="modal-period" class="col-form-label text-bold">Approved By</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" readonly="readonly" type="text" name="by_approve" id="view-by_approve" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group align-right">
                                                <label for="modal-vendor-code" class="col-form-label text-bold">Vendor</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" readonly="readonly" type="text" name="vendor_code" id="view-vendor_code" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group align-right">
                                                <label for="modal-period" class="col-form-label text-bold">Created Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" readonly="readonly" type="text" name="period" id="view-created_date" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group align-right">
                                                <label for="modal-period" class="col-form-label text-bold">Approved Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" readonly="readonly" type="text" name="date_approve" id="view-date_approve" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group align-right">
                                                <label for="modal-period" class="col-form-label text-bold">Period</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" readonly="readonly" type="text" name="period" id="view-period" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group align-right">
                                                <label for="modal-period" class="col-form-label text-bold">Updated By</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" readonly="readonly" type="text" name="by_update" id="view-by_update" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-md-auto" style="margin: 0px -10px 0px 30px;">
                                            @php echo $ApproveButton @endphp
                                        </div>
                                        <div class="col-md-auto" style="margin: 0px -10px;">
                                            @php echo $UnApproveButton @endphp
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-md-auto" style="margin: 0px -10px 0px 20px;">
                                            @php echo $PrintButton @endphp
                                        </div>
                                        <div class="col-md-auto" style="margin: 0px -10px;">
                                            @php echo $ExportButton @endphp
                                        </div>
                                        <div class="col-md-auto" style="margin: 0px -10px;">
                                            @php echo $DeleteButton @endphp
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group align-right">
                                                <label for="modal-period" class="col-form-label text-bold">Updated Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" readonly="readonly" type="text" name="update_date" id="view-updated_date" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of header -->

                    <hr />

                    <!-- detail -->
                    <div class="row">
                        <div class="col-12">
                            <div class="data-tables datatable-dark">
                                <table id="dtViewForecastNoteOp" class="table table-striped" style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Item Code</th>
                                            <th>ID</th>
                                            <th>Description</th>
                                            <th>Model</th>
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
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

<!-- Datatables -->
<script src="{{ asset('vendor/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/Datatables/Responsive-2.2.5/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/custom_tms_datatable.js') }}"></script>
<script src="{{ asset('js/custom_tms_cmb.js') }}"></script>

<script>
    var crud_url = "{{ route('tms.manufacturing.raw-material.forecast-note.control_forecastNoteRawMaterial') }}";
    var approve_url = "{{ route('tms.manufacturing.raw-material.forecast-note.approve_forecastNoteRawMaterial') }}";

    var user = "{{ Auth::user()->FullName }}";
    var periodNow = new Date().toISOString().slice(0,7);
    var dateNow = new Date().toISOString().slice(0,10);

    $(document).ready(function() {
        // dummy init
        //var supplierSelected = 'B002';
        var supplierSelected = null;
        //periodNow = '2020-04';

        var cmbPeriod_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code'=>':vend_code', 'period'=>':period', 'flag'=>':flag']) }}";
            cmbPeriod_url  = cmbPeriod_url.replace(':vend_code', null);
            cmbPeriod_url  = cmbPeriod_url.replace(':period', null);
            cmbPeriod_url  = cmbPeriod_url.replace(':flag', 'cmbPeriodRawMaterial');
        var cmbSupplier_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code'=>':vend_code', 'period'=>':period', 'flag'=>':flag']) }}";
            cmbSupplier_url  = cmbSupplier_url.replace(':vend_code', null);
            cmbSupplier_url  = cmbSupplier_url.replace(':period', null);
            cmbSupplier_url  = cmbSupplier_url.replace(':flag', 'cmbMappedSupplierRawMaterial');

        populate_cmbSupplierRawMaterial('#cmbSupplierForecastNote', cmbSupplier_url, supplierSelected);
        populate_cmbPeriodRawMaterial('#cmbPeriodForecastNote', cmbPeriod_url, periodNow);
    });

    // 2. View Button
    $('#view-btn').click(function() {
        var periodSelected = $('#cmbPeriodForecastNote').val();
        var supplierSelected = $('#cmbSupplierForecastNote').val();
        var tmp_check = checkHeaderForecastNote(periodSelected, supplierSelected);
        var flag = tmp_check.flag;

        if(flag == 1){
            /* POPULATE VIEW FORECAST NOTE */
            populateViewForecastNote(periodSelected, supplierSelected);
        }
    });

    // 3. Create Button
    $('#create-btn').click(function() {
        var periodSelected = $('#cmbPeriodForecastNote').val();
        var supplierSelected = $('#cmbSupplierForecastNote').val();
        var tmp_check = checkHeaderForecastNote(periodSelected, supplierSelected);
        var flag = tmp_check.flag;

        if(flag == 1){
            // CHECK VERSION NUMBER
            var txtForecastNoteVerNo_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code'=>':vend_code', 'period'=>':period', 'flag'=>':flag']) }}";
            txtForecastNoteVerNo_url  = txtForecastNoteVerNo_url.replace(':vend_code', supplierSelected);
            txtForecastNoteVerNo_url  = txtForecastNoteVerNo_url.replace(':period', periodSelected);
            txtForecastNoteVerNo_url  = txtForecastNoteVerNo_url.replace(':flag', 'FORECAST_NOTE_VER_NO');
            $.ajax({
                url: txtForecastNoteVerNo_url,
                method: 'get',
                dataType: 'json',
                success:function(response){
                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }

                    if(len > 0){
                        flag = 2;
                        ver_no = response['data'][0].ver_no;

                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-info'
                            },
                            buttonsStyling: true
                        })

                        swalWithBootstrapButtons.fire({
                            title: 'What do you want to do?',
                            text: "Forecast note version "+ ver_no +" is available!",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ver UP!',
                            cancelButtonText: 'Update!',
                            reverseButtons: true
                        })
                        .then((result) => {
                            if (result.value) {
                                /* Version UP Forecast Note */
                                /* CHECK APPROVAL */
                                var datForecastNote_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code' => ':vend_code', 'period' => ':period', 'flag' => ':flag' ]) }}";
                                datForecastNote_url  = datForecastNote_url.replace(':vend_code', supplierSelected);
                                datForecastNote_url  = datForecastNote_url.replace(':period', periodSelected);
                                datForecastNote_url  = datForecastNote_url.replace(':flag', 'APPROVAL');
                                $.ajax({
                                    url: datForecastNote_url,
                                    method: 'get',
                                    dataType: 'json',
                                    success:function(response){
                                        var len = 0;
                                        if(response['data'] != null){
                                            len = response['data'].length;
                                        }

                                        if(len > 0){
                                            approve_flag = response['data'][0].approve_flag;

                                            if(approve_flag==0){
                                                // IF NOT APPROVED YET
                                                Swal.fire({
                                                icon: 'warning',
                                                title: 'Warning',
                                                text: 'Forecast Note not approved yet, cannot do VER UP!',
                                                })

                                            } else {
                                                /* DO VERSION UP */
                                                ver_no = parseInt(ver_no) + 1

                                                if ( ver_no < 10 ){
                                                    ver_no = "0" + ver_no.toString()
                                                }

                                                resetForm('VERSION UP');
                                                $('#modal-forecast-note-create-form').modal('show');
                                                $('#modal-id').val(0);
                                                $('#modal-flag').val('VER_UP');
                                                $('#modal-by_user').val(user);
                                                $('#modal-create_date').val(dateNow);
                                                $('#modal-period').val(periodSelected);
                                                $('#modal-vendor_code').val(supplierSelected);
                                                $('#modal-RevNo').val(ver_no);

                                                var dtForecastNoteOp_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code'=>':vend_code', 'period'=>':period', 'flag'=>':flag']) }}";
                                                dtForecastNoteOp_url  = dtForecastNoteOp_url.replace(':vend_code', supplierSelected);
                                                dtForecastNoteOp_url  = dtForecastNoteOp_url.replace(':period', periodSelected);
                                                dtForecastNoteOp_url  = dtForecastNoteOp_url.replace(':flag', 'FORECAST_NOTE_dtOP');
                                                get_dtForecastNoteOp('#dtForecastNoteOp', dtForecastNoteOp_url, periodSelected);
                                            }
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: 'You have no available forecast note!',
                                            })
                                        }
                                    }
                                })

                            } else if (
                                /* Read more about handling dismissals below */
                                result.dismiss === Swal.DismissReason.cancel
                            ) {
                                /* Update Current Forecast Note */
                                /* CHECK APPROVAL */
                                var datForecastNote_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code' => ':vend_code', 'period' => ':period', 'flag' => ':flag' ]) }}";
                                datForecastNote_url  = datForecastNote_url.replace(':vend_code', supplierSelected);
                                datForecastNote_url  = datForecastNote_url.replace(':period', periodSelected);
                                datForecastNote_url  = datForecastNote_url.replace(':flag', 'APPROVAL');
                                $.ajax({
                                    url: datForecastNote_url,
                                    method: 'get',
                                    dataType: 'json',
                                    success:function(response){
                                        var len = 0;
                                        if(response['data'] != null){
                                            len = response['data'].length;
                                        }

                                        if(len > 0){
                                            approve_flag = response['data'][0].approve_flag;

                                            if(approve_flag==0){
                                                // IF NOT APPROVED YET
                                                /* DO UPDATE */
                                                resetForm('UPDATE');
                                                $('#modal-forecast-note-create-form').modal('show');
                                                $('#modal-id').val(0);
                                                $('#modal-flag').val('EDIT');
                                                $('#modal-by_user').val(user);
                                                $('#modal-create_date').val(dateNow);
                                                $('#modal-period').val(periodSelected);
                                                $('#modal-vendor_code').val(supplierSelected);
                                                $('#modal-RevNo').val(ver_no);

                                                var dtForecastNoteOp_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code' => ':vend_code', 'period' => ':period', 'flag'=>':flag']) }}";
                                                dtForecastNoteOp_url  = dtForecastNoteOp_url.replace(':vend_code', supplierSelected);
                                                dtForecastNoteOp_url  = dtForecastNoteOp_url.replace(':period', periodSelected);
                                                dtForecastNoteOp_url  = dtForecastNoteOp_url.replace(':flag', 'FORECAST_NOTE_dtOP');
                                                get_dtForecastNoteOp('#dtForecastNoteOp', dtForecastNoteOp_url, periodSelected);

                                            } else {
                                                // IF ALREADY APPROVED
                                                Swal.fire({
                                                    icon: 'warning',
                                                    title: 'Warning',
                                                    text: 'Forecast Note already approved, cannot do Update!',
                                                })
                                            }
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: 'You have no available forecast note!',
                                            })
                                        }
                                    }
                                })
                            }
                        })

                    } else {
                        /* NEW Version of forecast note */
                        var ver_no = '00';
                        resetForm('New');
                        $('#modal-forecast-note-create-form').modal('show');
                        $('#modal-id').val(0);
                        $('#modal-flag').val('ADD');
                        $('#modal-by_user').val(user);
                        $('#modal-create_date').val(dateNow);
                        $('#modal-period').val(periodSelected);
                        $('#modal-vendor_code').val(supplierSelected);
                        $('#modal-RevNo').val(ver_no);

                        var dtForecastNoteOp_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code'=>':vend_code', 'period'=>':period', 'flag'=>':flag']) }}";
                        dtForecastNoteOp_url  = dtForecastNoteOp_url.replace(':vend_code', supplierSelected);
                        dtForecastNoteOp_url  = dtForecastNoteOp_url.replace(':period', periodSelected);
                        dtForecastNoteOp_url  = dtForecastNoteOp_url.replace(':flag', 'FORECAST_NOTE_dtOP');
                        get_dtForecastNoteOp('#dtForecastNoteOp', dtForecastNoteOp_url, periodSelected);
                    }
                }
            });
        }
    });

    // 4. Delete Button
    $('#delete-btn').click(function(){
        var periodSelected = $('#cmbPeriodForecastNote').val();
        var supplierSelected = $('#cmbSupplierForecastNote').val();
        var tmp_check = checkHeaderForecastNote(periodSelected, supplierSelected);
        var flag = tmp_check.flag;

        if(flag == 1){
            //CHECK APPROVAL DATA
            var datForecastNote_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code' => ':vend_code', 'period' => ':period', 'flag' => ':flag' ]) }}";
            datForecastNote_url  = datForecastNote_url.replace(':vend_code', supplierSelected);
            datForecastNote_url  = datForecastNote_url.replace(':period', periodSelected);
            datForecastNote_url  = datForecastNote_url.replace(':flag', 'APPROVAL');
            $.ajax({
                url: datForecastNote_url,
                method: 'get',
                dataType: 'json',
                success:function(response){
                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }

                    if(len > 0){
                        approve_flag = response['data'][0].approve_flag;
                        if(approve_flag==0){
                            // IF NOT APPROVED YET
                            /* DO DELETE DATA */
                            var txtForecastNoteVerNo_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code'=>':vend_code', 'period'=>':period', 'flag'=>':flag']) }}";
                            txtForecastNoteVerNo_url  = txtForecastNoteVerNo_url.replace(':vend_code', supplierSelected);
                            txtForecastNoteVerNo_url  = txtForecastNoteVerNo_url.replace(':period', periodSelected);
                            txtForecastNoteVerNo_url  = txtForecastNoteVerNo_url.replace(':flag', 'FORECAST_NOTE_VER_NO');
                            $.ajax({
                                url: txtForecastNoteVerNo_url,
                                method: 'get',
                                dataType: 'json',
                                success:function(response){
                                    var len = 0;
                                    if(response['data'] != null){
                                        len = response['data'].length;
                                    }

                                    if(len > 0){
                                        ver_no = response['data'][0].ver_no;
                                        Swal.fire({
                                            title: 'Are you sure?',
                                            text: "You will delete forecast note version "+ ver_no +" !",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes, delete it!'
                                        })
                                        .then((result) => {
                                            if (result.value) {
                                                var $objItem = {};

                                                $.ajax({
                                                    url: crud_url,
                                                    method: 'POST',
                                                    data: {
                                                        "_token": "{{ csrf_token() }}",
                                                        'item': $objItem,
                                                        'id': '',
                                                        'flag': 'DELETE',
                                                        'rev_no': ver_no,
                                                        'by_user': user,
                                                        'vendor_code': supplierSelected,
                                                        'period': periodSelected,
                                                        'create_date': dateNow,
                                                    },
                                                    dataType: "json",
                                                    success:function(data){
                                                        if(data.status == 1){
                                                            Swal.fire("Forecast note version " + ver_no + " is deleted", "", "success");
                                                            /* HIDE VIEW FORECAST NOTE */
                                                            $("#view-rowForm").attr("hidden", true);
                                                        } else {
                                                            Swal.fire("Failed to delete forecast note version " + ver_no, "", "warning");
                                                        }

                                                    }
                                                });
                                            }
                                        })
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'You have no available forecast note!',
                                        })
                                    }
                                }
                            })
                        } else {
                            // IF ALREADY APPROVED
                            Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Forecast Note already approved!',
                        })
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'You have no available forecast note!',
                        })
                    }
                }
            })
        }
    });

    // 5. Approve Button
    $('#approve-btn').click(function(){
        var periodSelected = $('#cmbPeriodForecastNote').val();
        var supplierSelected = $('#cmbSupplierForecastNote').val();
        var tmp_check = checkHeaderForecastNote(periodSelected, supplierSelected);
        var flag = tmp_check.flag;

        if(flag == 1){
            //CHECK APPROVAL DATA
            var datForecastNote_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code' => ':vend_code', 'period' => ':period', 'flag' => ':flag' ]) }}";
            datForecastNote_url  = datForecastNote_url.replace(':vend_code', supplierSelected);
            datForecastNote_url  = datForecastNote_url.replace(':period', periodSelected);
            datForecastNote_url  = datForecastNote_url.replace(':flag', 'APPROVAL');
            $.ajax({
                url: datForecastNote_url,
                method: 'get',
                dataType: 'json',
                success:function(response){
                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }

                    if(len > 0){
                        approve_flag = response['data'][0].approve_flag;
                        if(approve_flag==0){
                            // IF NOT APPROVED YET
                            Swal.fire({
                                title: 'Approve forecast note?',
                                icon: 'info',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, approve it!'
                            })
                            .then((result) => {
                                if (result.value) {
                                    $.ajax({
                                        url: approve_url,
                                        method: "POST",
                                        data: {
                                            "_token": "{{ csrf_token() }}",
                                            'flag': 'APPROVE',
                                            'vendor_code': supplierSelected,
                                            'period': periodSelected,
                                            'by_user': user,
                                            'create_date': dateNow,
                                        },
                                        dataType: "json",
                                        success:function(data){
                                            resetForm();
                                            if(data.status == 1){
                                                Swal.fire(data.message, "", "success");
                                                /* POPULATE VIEW FORECAST NOTE */
                                                populateViewForecastNote(periodSelected, supplierSelected);
                                            } else {
                                                Swal.fire(data.message, "", "danger");
                                            }
                                        }
                                    });
                                }
                            })
                        } else {
                            Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Forecast Note already approved!',
                        })
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'You have no available forecast note!',
                        })
                    }
                }
            })
        }
    });

    //6. Un-Approve Button
    $('#unapprove-btn').click(function(){
        var periodSelected = $('#cmbPeriodForecastNote').val();
        var supplierSelected = $('#cmbSupplierForecastNote').val();
        var tmp_check = checkHeaderForecastNote(periodSelected, supplierSelected);
        var flag = tmp_check.flag;

        if(flag == 1){
            //CHECK APPROVAL DATA
            var datForecastNote_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code' => ':vend_code', 'period' => ':period', 'flag' => ':flag' ]) }}";
            datForecastNote_url  = datForecastNote_url.replace(':vend_code', supplierSelected);
            datForecastNote_url  = datForecastNote_url.replace(':period', periodSelected);
            datForecastNote_url  = datForecastNote_url.replace(':flag', 'APPROVAL');
            $.ajax({
                url: datForecastNote_url,
                method: 'get',
                dataType: 'json',
                success:function(response){
                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }

                    if(len > 0){
                        approve_flag = response['data'][0].approve_flag;
                        if(approve_flag!=0){
                            // IF NOT APPROVED YET
                            Swal.fire({
                                title: 'Un-Approve forecast note?',
                                icon: 'info',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, un-approve it!'
                            })
                            .then((result) => {
                                if (result.value) {
                                    $.ajax({
                                        url: approve_url,
                                        method: "POST",
                                        data: {
                                            "_token": "{{ csrf_token() }}",
                                            'flag': 'UNAPPROVE',
                                            'vendor_code': supplierSelected,
                                            'period': periodSelected,
                                            'by_user': user,
                                            'create_date': dateNow,
                                        },
                                        dataType: "json",
                                        success:function(data){
                                            resetForm();
                                            if(data.status == 1){
                                                Swal.fire(data.message, "", "success");
                                                /* POPULATE VIEW FORECAST NOTE */
                                                populateViewForecastNote(periodSelected, supplierSelected);
                                            } else {
                                                Swal.fire(data.message, "", "danger");
                                            }
                                        }
                                    });
                                }
                            })
                        } else {
                            Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Forecast Note not approved yet!',
                        })
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'You have no available forecast note!',
                        })
                    }
                }
            })
        }
    });

    //7. Print Button
    $('#print-btn').click(function(){
        var periodSelected = $('#cmbPeriodForecastNote').val();
        var supplierSelected = $('#cmbSupplierForecastNote').val();

        var datForecastNote_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code' => ':vend_code', 'period' => ':period', 'flag' => ':flag' ]) }}";
        datForecastNote_url  = datForecastNote_url.replace(':vend_code', supplierSelected);
        datForecastNote_url  = datForecastNote_url.replace(':period', periodSelected);
        datForecastNote_url  = datForecastNote_url.replace(':flag', 'REPORT_FORECAST_NOTE_PRINT');
        window.open(datForecastNote_url);
    });

    //8. Export Button
    $('#export-btn').click(function(){
        var periodSelected = $('#cmbPeriodForecastNote').val();
        var supplierSelected = $('#cmbSupplierForecastNote').val();

        var datForecastNote_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code' => ':vend_code', 'period' => ':period', 'flag' => ':flag' ]) }}";
        datForecastNote_url  = datForecastNote_url.replace(':vend_code', supplierSelected);
        datForecastNote_url  = datForecastNote_url.replace(':period', periodSelected);
        datForecastNote_url  = datForecastNote_url.replace(':flag', 'EXPORT_FORECAST_NOTE_EXCEL');
        window.open(datForecastNote_url);
    });

    // Modal Save Button
    $('#modal-form').on('submit', function(event){
        event.preventDefault();

        var periodSelected = $('#cmbPeriodForecastNote').val();
        var supplierSelected = $('#cmbSupplierForecastNote').val();

        Swal.fire({
            title: 'Save forecast note?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        })
        .then((result) => {
            if (result.value) {
                //var formData  = $(this).serialize();
                var url = $('#modal-form').attr('action');

                var table    = $('#dtForecastNoteOp').DataTable().rows().data();
                var $objItem = {};
                table.each(function (value, index) {
                    var $arrItem          = {};
                    $arrItem['item_code'] = value.item_code;
                    $arrItem['model'] = value.model;
                    $arrItem['tm_kg']     = value.tm_kg;
                    $arrItem['nm1_kg']    = value.nm1_kg;
                    $arrItem['nm2_kg']    = value.nm2_kg;
                    $arrItem['nm3_kg']    = value.nm3_kg;
                    $arrItem['nm4_kg']    = value.nm4_kg;
                    $arrItem['nm5_kg']    = value.nm5_kg;
                    $arrItem['nm6_kg']    = value.nm6_kg;
                    $objItem[index]       = $arrItem;
                });

                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'item': $objItem,
                        'id': $('#modal-id').val(),
                        'flag': $('#modal-flag').val(),
                        'rev_no': $('#modal-RevNo').val(),
                        'by_user': $('#modal-by_user').val(),
                        'vendor_code': $('#modal-vendor_code').val(),
                        'period': $('#modal-period').val(),
                        'create_date': $('#modal-create_date').val(),
                    },
                    dataType: "json",
                    success:function(data){
                        resetForm();
                        if(data.status == 1){
                            $notif = buildNotif('success', data.message);
                            $('#form-output').html($notif);
                            Swal.fire(data.message, "", "success");

                            var delayInMilliseconds = 250;
                            setTimeout(function() {
                                $('#modal-forecast-note-create-form').modal('hide');
                            }, delayInMilliseconds);

                            /* POPULATE VIEW FORECAST NOTE */
                            populateViewForecastNote(periodSelected, supplierSelected);

                        } else {
                            $notif = buildNotif('danger', data.message);
                            Swal.fire(data.message, "", "danger");
                        }

                    }
                });
            }
        })
    });

    function resetForm(mode){
        viewForm('HIDE');
        inputForm('SHOW');
        $('#modal-role-name').html(mode);
        $('#form-output').html('');
        $('#modal-form')[0].reset();
        $('#modal-form').attr('action', crud_url);
    }

    function inputForm(action){
        if(action == 'SHOW'){
            $('input').show();
            $('textarea').show();
            $('#modal-submit').show();
        } else if(action == 'HIDE'){
            $('input').hide();
            $('textarea').hide();
            $('#modal-submit').hide();
        }
    }

    function viewForm(action){
        if(action == 'SHOW'){
            $('.form-view').show();
        } else if(action == 'HIDE'){
            $('.form-view').hide();
        }
    }

    function checkHeaderForecastNote(periodSelected, supplierSelected){
        var cmbSupplier = $('#cmbSupplierForecastNote').val();
        var cmbPeriod = $('#cmbPeriodForecastNote').val();
        var flag = 1;

        if(!cmbSupplier) {
            alert('Select Supplier first...');
            flag = 0;
        };
        if(!cmbPeriod){
            alert('Select Period first...');
            flag = 0;
        };

        return {flag};
    }

    function populateViewForecastNote(periodSelected, supplierSelected){
        $("#view-rowForm").attr("hidden", false);
        /* POPULATE HEADER VIEW */
        var viewForecastNote_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code' => ':vend_code', 'period' => ':period', 'flag' => ':flag' ]) }}";
            viewForecastNote_url  = viewForecastNote_url.replace(':vend_code', supplierSelected);
            viewForecastNote_url  = viewForecastNote_url.replace(':period', periodSelected);
            viewForecastNote_url  = viewForecastNote_url.replace(':flag', 'VIEW_HEADER');
            $.ajax({
                url: viewForecastNote_url,
                method: 'get',
                dataType: 'json',
                success:function(response){
                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }
                    if(len > 0){
                        $('#view-RevNo').val(response['data'][0].ver_no);
                        $('#view-vendor_code').val(response['data'][0].vend_code);
                        $('#view-period').val(response['data'][0].period);
                        $('#view-by_user').val(response['data'][0].created_by);
                        $('#view-created_date').val(response['data'][0].created_date);
                        $('#view-by_update').val(response['data'][0].updated_by);
                        $('#view-updated_date').val(response['data'][0].updated_date);
                        $('#view-by_approve').val(response['data'][0].approved_by);
                        $('#view-date_approve').val(response['data'][0].approved_date);

                        /* POPULATE DETAIL VIEW */
                        var viewForecastNote_url = "{{ route('tms.manufacturing.raw-material.forecast-note.get_datForecastNote', ['vend_code' => ':vend_code', 'period' => ':period', 'flag' => ':flag' ]) }}";
                        viewForecastNote_url  = viewForecastNote_url.replace(':vend_code', supplierSelected);
                        viewForecastNote_url  = viewForecastNote_url.replace(':period', periodSelected);
                        viewForecastNote_url  = viewForecastNote_url.replace(':flag', 'VIEW_DETAIL');
                        get_dtViewForecastNoteOp('#dtViewForecastNoteOp', viewForecastNote_url, response['data'][0].period);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'You have no available forecast note!',
                        })
                        $("#view-rowForm").attr("hidden", true);
                    }
                }
            })
    }

</script>

@endpush
