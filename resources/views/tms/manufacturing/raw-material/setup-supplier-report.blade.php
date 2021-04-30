@extends('master')

@section('title', 'TMS | Manufacturing - Raw Material - Setup Supplier Report')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/Responsive-2.2.5/css/responsive.dataTables.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/select2/css/select2.min.css') }}">

@endsection

@section('content')

@include('tms.__layouts.tms-menuRawMaterial-horizontal')
@include('tms.manufacturing.raw-material.setup-supplier-report-parameter-modal')
@include('tms.manufacturing.raw-material.setup-supplier-report-information-modal')
@include('tms.manufacturing.raw-material.setup-supplier-report-clusterization-modal')

<div class="main-content-inner">

    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Report Parameter</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="data-tables datatable-dark">
                                <table id="dtReportParameter" class="table table-striped" style="width:100%">
                                    {{ csrf_field() }}
                                    <thead class="text-center">
                                        <tr>
                                            <th>LD Number</th>
                                            <th>ID</th>
                                            <th>Prepared By</th>
                                            <th>Checked By</th>
                                            <th>Approved By</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
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

    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Supplier Setup on Raw Material Mapping by Model</h4>
                    </div>
                </div>
                <div class="col-md-auto" style="margin: 10px 0px;">
                    @php echo $AddButton @endphp
                </div>
                <div class="card-body mt-0.5">
                    <div class="row">
                        <div class="col">
                            <div class="data-tables datatable-dark">
                                <table id="dtRawMaterialMappingByModel" class="table table-striped" style="width:100%">
                                    {{ csrf_field() }}
                                    <thead class="text-center">
                                        <tr>
                                            <th>Id</th>
                                            <th>Vendor</th>
                                            <th>Company</th>
                                            <th>Action</th>
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

    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Supplier Information</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="data-tables datatable-dark">
                                <table id="dtSupplierInformation" class="table table-striped" style="width:100%">
                                    {{ csrf_field() }}
                                    <thead class="text-center">
                                        <tr>
                                            <th>Vendor</th>
                                            <th>Company</th>
                                            <th>Contact</th>
                                            <th>Phone</th>
                                            <th>Fax</th>
                                            <th>Action</th>
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
<script src="{{ asset('/vendor/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/vendor/Datatables/Responsive-2.2.5/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/custom_tms_datatable.js') }}"></script>
<script src="{{ asset('js/custom_tms_cmb.js') }}"></script>
<script src="{{ asset('js/custom-select2.js') }}"></script>

<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var user = "{{ Auth::user()->FullName }}";
    var datSupplierReport_url = "{{ route('tms.manufacturing.raw-material.setup-supplier-report.get_datSupplierReport', ':flag') }}";
    var crudSupplierReport_url = "{{ route('tms.manufacturing.raw-material.setup-supplier-report.control_setupSupplierReportRawMaterial') }}";
    var select2Supplier_url = "{{ route('tms.manufacturing.supplier-distribution.supplier.select2', 'ALL') }}";

    $(document).ready(function() {
        initializeSelect2('#report-clusterization-modal-supplier', select2Supplier_url, "Select Supplier");

        // @@ Load Datatable
        var datSupplierReport_url = "{{ route('tms.manufacturing.raw-material.setup-supplier-report.get_datSupplierReport', ':flag') }}";
        datSupplierReport_url = datSupplierReport_url.replace(':flag', 3);
        get_datRawMaterialMappingByModel('#dtRawMaterialMappingByModel', datSupplierReport_url);
        var datSupplierReport_url = "{{ route('tms.manufacturing.raw-material.setup-supplier-report.get_datSupplierReport', ':flag') }}";
        datSupplierReport_url = datSupplierReport_url.replace(':flag', 2);
        get_datSupplierReportParameter('#dtReportParameter', datSupplierReport_url);
        var datSupplierReport_url = "{{ route('tms.manufacturing.raw-material.setup-supplier-report.get_datSupplierReport', ':flag') }}";
        datSupplierReport_url = datSupplierReport_url.replace(':flag', 1);
        get_datSupplierInformation('#dtSupplierInformation', datSupplierReport_url);

        // 1. Edit Report Parameter
        $('#dtReportParameter').on('click', '.edit', function(){
            var id = $(this).attr('row-id');
            var ld = $(this).attr('row-ld');
            var prepared = $(this).attr('row-prepared');
            var checked = $(this).attr('row-checked');
            var approved = $(this).attr('row-approved');
            var startDate = $(this).attr('row-start_date');
            var endDate = $(this).attr('row-end_date');

            resetFormReportParameter('Edit');
            setTimeout(function(){
                $('#modal-setup-supplier-report-parameter-form').modal('show');
            }, 1000);

            $('#report-parameter-modal-id').val(id);
            $('#report-parameter-modal-flag').val('EDIT');
            $('#report-parameter-modal-mode').val('PARAMETER');
            $('#report-parameter-modal-by_user').val(user);
            $('#report-parameter-modal-ld').val(ld);
            $('#report-parameter-modal-prepared').val(prepared);
            $('#report-parameter-modal-checked').val(checked);
            $('#report-parameter-modal-approved').val(approved);
            $('#report-parameter-modal-startDate').val(startDate);
            $('#report-parameter-modal-endDate').val(endDate);
        });

        // 2. Edit Report Information
        $('#dtSupplierInformation').on('click', '.edit', function(){
            var vendor_code = $(this).attr('row-vendor_code');
            var contact = $(this).attr('row-contact');
            var phone = $(this).attr('row-phone');
            var fax = $(this).attr('row-fax');

            resetFormReportInformation('Edit');
            setTimeout(function(){
                $('#modal-setup-supplier-report-information-form').modal('show');
            }, 1000);

            $('#report-information-modal-id').val(0);
            $('#report-information-modal-flag').val('EDIT');
            $('#report-information-modal-mode').val('INFORMATION');
            $('#report-information-modal-by_user').val(user);
            $('#report-information-modal-vendor_code').val(vendor_code);
            $('#report-information-modal-contact').val(contact);
            $('#report-information-modal-phone').val(phone);
            $('#report-information-modal-fax').val(fax);
        });

        //3. Add Supplier Setup on Raw Material Mapping by Model
        $('#create-btn').click(function() {
            resetFormReportClusterization('New');
            $('#modal-setup-supplier-report-clusterization-form').modal('show');
            $('#report-clusterization-modal-id').val(0);
            $('#report-clusterization-modal-flag').val('ADD');
            $('#report-clusterization-modal-mode').val('CLUSTERIZATION');
            $('#report-clusterization-modal-by_user').val(user);
        });

        //4. Edit Report Clusterization
        $('#dtRawMaterialMappingByModel').on('click', '.edit', function(){
            var id = $(this).attr('row-id');
            var vendor_code = $(this).attr('row-vendor_code');

            resetFormReportClusterization('Edit', vendor_code);
            $('#modal-setup-supplier-report-clusterization-form').modal('show');
            $('#report-clusterization-modal-id').val(id);
            $('#report-clusterization-modal-flag').val('EDIT');
            $('#report-clusterization-modal-mode').val('CLUSTERIZATION');
            $('#report-clusterization-modal-by_user').val(user);
        });

        //5. Delete Report Clusterization
        $('#dtRawMaterialMappingByModel').on('click', '.delete', function(){
            var id = $(this).attr('row-id');
            var vendor_code = $(this).attr('row-vendor_code');

            Swal.fire({
                title: 'Delete Clusterization ' + vendor_code,
                text: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then((result) => {
                if(result.value) {
                    $.ajax({
                        url: crudSupplierReport_url,
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                            "flag":"DELETE",
                            "mode":"CLUSTERIZATION",
                            "by_user":user,
                            "supplier":vendor_code,
                        },
                        success:function(data){
                            if(data.status == 1){
                                $('#dtRawMaterialMappingByModel').DataTable().ajax.reload();
                                Swal.fire("Clusterization " + vendor_code + " is deleted", "", "success");
                            } else {
                                Swal.fire("Failed to delete clusterization " + vendor_code, "", "warning");
                            }

                        }
                    });
                }
            });
        });

        //6.


    });


    // Functions
    function resetFormReportClusterization(mode, supplier = null){
        viewFormReportClusterization('HIDE');
        inputFormReportClusterization('SHOW');
        $('#report-clusterization-modal-role-name').html(mode);
        $('#report-clusterization-form-output').html('');
        $('#report-clusterization-modal-form')[0].reset();
        $('#report-clusterization-modal-form').attr('action', crudSupplierReport_url);
        preselectSupplier('#report-clusterization-modal-supplier', supplier);
    }

    function inputFormReportClusterization(action){
        if(action == 'SHOW'){
            $('input').show();
            $('textarea').show();
            $('#report-clusterization-modal-submit').show();
        } else if(action == 'HIDE'){
            $('input').hide();
            $('textarea').hide();
            $('#report-clusterization-modal-submit').hide();
        }
    }

    function viewFormReportClusterization(action){
        if(action == 'SHOW'){
            $('.report-clusterization-form-view').show();
        } else if(action == 'HIDE'){
            $('.report-clusterization-form-view').hide();
        }
    }

    function resetFormReportInformation(mode){
        viewFormReportInformation('HIDE');
        inputFormReportInformation('SHOW');
        $('#report-information-modal-role-name').html(mode);
        $('#report-information-form-output').html('');
        $('#report-information-modal-form')[0].reset();
        $('#report-information-modal-form').attr('action', crudSupplierReport_url);
    }

    function inputFormReportInformation(action){
        if(action == 'SHOW'){
            $('input').show();
            $('textarea').show();
            $('#report-information-modal-submit').show();
        } else if(action == 'HIDE'){
            $('input').hide();
            $('textarea').hide();
            $('#report-information-modal-submit').hide();
        }
    }

    function viewFormReportInformation(action){
        if(action == 'SHOW'){
            $('.report-information-form-view').show();
        } else if(action == 'HIDE'){
            $('.report-information-form-view').hide();
        }
    }

    function resetFormReportParameter(mode){
        viewFormReportParameter('HIDE');
        inputFormReportParameter('SHOW');
        $('#report-parameter-modal-role-name').html(mode);
        $('#report-parameter-form-output').html('');
        $('#report-parameter-modal-form')[0].reset();
        $('#report-parameter-modal-form').attr('action', crudSupplierReport_url);
    }

    function inputFormReportParameter(action){
        if(action == 'SHOW'){
            $('input').show();
            $('textarea').show();
            $('#report-parameter-modal-submit').show();
        } else if(action == 'HIDE'){
            $('input').hide();
            $('textarea').hide();
            $('#report-parameter-modal-submit').hide();
        }
    }

    function viewFormReportParameter(action){
        if(action == 'SHOW'){
            $('.report-parameter-form-view').show();
        } else if(action == 'HIDE'){
            $('.report-parameter-form-view').hide();
        }
    }

    function preselectSupplier(id, vendcode = null){
        if ( vendcode !== null ){
            var route = "{{ route('tms.manufacturing.supplier-distribution.supplier.select2', ':vendcode') }}";
                route = route.replace(':vendcode', vendcode);
            $.ajax({
                type: 'GET',
                url: route
            }).then(function (data){
                var text = data.vendcode + ' :: ' + data.company;
                var option = new Option(text, data.vendcode, true, true);
                $(id).append(option).trigger('change');

                $(id).trigger({
                    type: 'select2:select2',
                    params: {
                        data: data
                    }
                })
            });
        } else {
            $(id).find('option').remove().end();
            $(id).select2("destroy");
            initializeSelect2(id, select2Supplier_url, "Select Supplier");
        }
    }

    // Modal Submit Function
    $('#report-parameter-modal-form').on('submit', function(event){
        event.preventDefault();
        Swal.fire({
            title: 'Save report parameter?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        })
        .then((result) => {
            if (result.value) {
                var formData  = $(this).serialize();
                var url = $('#report-parameter-modal-form').attr('action');
                //console.log(url);
                //console.log(formData);
                $.ajax({
                    url: url,
                    method: "POST",
                    data: formData,
                    dataType: "json",
                    success:function(data){
                        //console.log(data);
                        resetFormReportParameter();
                        if(data.status == 1){
                            $notif = buildNotif('success', data.message);
                            $('#report-parameter-form-output').html($notif);
                            Swal.fire(data.message, "", "success");

                            var delayInMilliseconds = 250;
                            setTimeout(function() {
                                $('#modal-setup-supplier-report-parameter-form').modal('hide');
                            }, delayInMilliseconds);

                        } else {
                            $notif = buildNotif('danger', data.message);
                            Swal.fire(data.message, "", "danger");
                        }
                        $('#dtReportParameter').DataTable().ajax.reload();
                    }
                });
            }
        })
    });

    $('#report-clusterization-modal-form').on('submit', function(event){
        event.preventDefault();
        Swal.fire({
            title: 'Save report clusterization?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        })
        .then((result) => {
            if (result.value) {
                var formData  = $(this).serialize();
                var url = $('#report-clusterization-modal-form').attr('action');
                //console.log(url);
                //console.log(formData);
                $.ajax({
                    url: url,
                    method: "POST",
                    data: formData,
                    dataType: "json",
                    success:function(data){
                        //console.log(data);
                        resetFormReportClusterization();
                        if(data.status == 1){
                            $notif = buildNotif('success', data.message);
                            $('#report-clusterization-form-output').html($notif);
                            Swal.fire(data.message, "", "success");

                            var delayInMilliseconds = 250;
                            setTimeout(function() {
                                $('#modal-setup-supplier-report-clusterization-form').modal('hide');
                            }, delayInMilliseconds);

                        } else {
                            $notif = buildNotif('danger', data.message);
                            Swal.fire(data.message, "", "danger");
                        }
                        $('#dtRawMaterialMappingByModel').DataTable().ajax.reload();
                    }
                });
            }
        })
    });

</script>

@endpush
