@extends('master')

@section('title', 'TMS | Manufacturing - Raw Material - Setup Supplier Mapping')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/Responsive-2.2.5/css/responsive.dataTables.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/select2/css/select2.min.css') }}">

@endsection

@section('content')

@include('tms.__layouts.tms-menuRawMaterial-horizontal')
@include('tms.manufacturing.raw-material.setup-supplier-distribution-modal')
@include('tms.manufacturing.raw-material.setup-supplier-distribution-doubleMapping-modal')

<div class="main-content-inner">

    <div id="div-unsticky">
        <div class="row" id='row-form'>
            <div class="col-12 mt-3" id="col-form">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                @php echo $ActionButton @endphp
                            </div>
                            <div class="col-md-auto">
                                @php echo $WarningButton2 @endphp
                            </div>
                            <div class="col-md-auto">
                                @php echo $WarningButton1 @endphp
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
                        <h4 class="card-header-title">Mapping Supplier Data</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="data-tables datatable-dark">
                                <table id="dtMappedRawMaterialWithSupplier" class="table table-striped" style="width:100%">
                                    {{ csrf_field() }}
                                    <thead class="text-center">
                                        <tr>
                                            <th>Id</th>
                                            <th>Code</th>
                                            <th>Company</th>
                                            <th>Item Code</th>
                                            <th>Part Name</th>
                                            <th>Model</th>
                                            <th>%Distr</th>
                                            <th>Factor</th>
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
    var crud_url = "{{ route('tms.manufacturing.raw-material.setup-supplier-distribution.control_setupSupplierDistributionRawMaterial') }}"

    // Select2 Route
    var select2Item_url = "{{ route('tms.manufacturing.raw-material.setup-supplier-distribution.get_datSupplierDistribution', ['flag'=>':flag', 'itemcode'=>':itemcode', 'vendcode'=>':vendcode']) }}";
        select2Item_url = select2Item_url.replace(':flag', 4);
        select2Item_url = select2Item_url.replace(':vendcode', null);
        select2Item_url = select2Item_url.replace(':itemcode', 'ALL');
    var select2Supplier_url = "{{ route('tms.manufacturing.raw-material.setup-supplier-distribution.get_datSupplierDistribution', ['flag'=>':flag', 'itemcode'=>':itemcode', 'vendcode'=>':vendcode']) }}";
        select2Supplier_url = select2Supplier_url.replace(':flag', 5);
        select2Supplier_url = select2Supplier_url.replace(':vendcode', 'ALL');
        select2Supplier_url = select2Supplier_url.replace(':itemcode', null);

    var user = "{{ Auth::user()->FullName }}";

    $(document).ready(function() {

        // Load Select2 Item :: Function in custom-select2.js
        initializeSelect2('#modal-item-code', select2Item_url, "Select Item");
        initializeSelect2('#modal-supplier', select2Supplier_url, "Select Supplier");

        // @@ Load Datatable
        var datSupplierDistribution_url = "{{ route('tms.manufacturing.raw-material.setup-supplier-distribution.get_datSupplierDistribution', ['flag'=>':flag', 'itemcode'=>':itemcode', 'vendcode'=>':vendcode']) }}";
        datSupplierDistribution_url  = datSupplierDistribution_url.replace(':flag', 1);
        get_dtMappedRawMaterialWithSupplier('#dtMappedRawMaterialWithSupplier', datSupplierDistribution_url);

        // 2. Add Button
        $('#add-btn').click(function() {
            resetForm('New');
            $('#modal-setup-supplier-distribution-form').modal('show');
            $('#modal-id').val(0);
            $('#modal-flag').val('ADD');
            $('#modal-by_user').val(user);
        });

        // 3. Edit Button
        $(document).on('click', '.edit', function(){
            var id = $(this).attr('row-id');
            var item_code = $(this).attr('row-item_code');
            var supplier = $(this).attr('row-supplier');
            var distribution = $(this).attr('row-distribution');

            resetForm('Edit', item_code, supplier);
            setTimeout(function(){
                $('#modal-setup-supplier-distribution-form').modal('show');
            }, 1000);


            $('#modal-id').val(id);
            $('#modal-flag').val('EDIT');
            $('#modal-by_user').val(user);
            $('#modal_distribution').val(distribution);
        });

        // 4. Delete Button
        $(document).on('click', '.delete', function(){
            var id   = $(this).attr('row-id');
            var item_code = $(this).attr('row-item_code');
            var url  = crud_url;

            Swal.fire({
                title: 'Delete Mapping ' + item_code,
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
                        url: url,
                        method: 'GET',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                            "flag":"DELETE",
                            "by_user":user,
                            "item_code":item_code,
                            "supplier":'',
                            "distribution":'',
                        },
                        success:function(data){
                            if(data.status == 1){
                                $('#dtMappedRawMaterialWithSupplier').DataTable().ajax.reload();
                                Swal.fire("Mapping " + item_code + " is deleted", "", "success");
                            } else {
                                Swal.fire("Failed to delete mapping " + item_code, "", "warning");
                            }

                        }
                    });
                }
            });
        });

        //5. View Double Mapping Button
        $('#viewDoubleMapping-btn').click(function() {
            resetFormDoubleMapping('Double Mapping Distribution Warning', 'Mapping Freq');
            $('#modal-setup-supplier-distribution-doubleMapping-form').modal('show');
            var datSupplierDistribution_url = "{{ route('tms.manufacturing.raw-material.setup-supplier-distribution.get_datSupplierDistribution', ['flag'=>':flag', 'itemcode'=>':itemcode', 'vendcode'=>':vendcode']) }}";
            datSupplierDistribution_url  = datSupplierDistribution_url.replace(':flag', 2);
            get_dtMappingDistributionWarning('#dtMappingDistributionWarning', datSupplierDistribution_url);
        });

        //6. View %Distribution Button
        $('#viewErrorDistributionMapping-btn').click(function() {
            resetFormDoubleMapping('%Distribution Mapping Warning', '%Distribution');
            $('#modal-setup-supplier-distribution-doubleMapping-form').modal('show');
            var datSupplierDistribution_url = "{{ route('tms.manufacturing.raw-material.setup-supplier-distribution.get_datSupplierDistribution', ['flag'=>':flag', 'itemcode'=>':itemcode', 'vendcode'=>':vendcode']) }}";
            datSupplierDistribution_url  = datSupplierDistribution_url.replace(':flag', 3);
            get_dtMappingDistributionWarning('#dtMappingDistributionWarning', datSupplierDistribution_url);
        });


    });


    /*
    | -------------------------------------------------------------
    |   Custom Pre-select Select2
    | -------------------------------------------------------------
    |       1. Pre-select Select2 Item
    |       2. Pre-select Select2 Vendor
    | -------------------------------------------------------------
    */

    // 1. Pre-select Select2 Item
    function preselectItem(id, itemcode = null){
        if ( itemcode !== null ) {
            var route = "{{ route('tms.manufacturing.raw-material.setup-supplier-distribution.get_datSupplierDistribution', ['flag'=>':flag', 'itemcode'=>':itemcode', 'vendcode'=>':vendcode']) }}";
                route = route.replace(':flag', 4);
                route = route.replace(':vendcode', null);
                route = route.replace(':itemcode', itemcode);
            $.ajax({
                type: 'GET',
                url: route
            }).then(function (data){
                var text = data.itemcode + ' :: ' + data.descript + ' :: ' + data.descript1;
                var option = new Option(text, data.itemcode, true, true);
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
            initializeSelect2(id, select2Item_url, "Select Item");
        }
    }

    // 2. Pre-select Select2 Supplier
    function preselectSupplier(id, vendcode = null){
        if ( vendcode !== null ){
            var route = "{{ route('tms.manufacturing.raw-material.setup-supplier-distribution.get_datSupplierDistribution', ['flag'=>':flag', 'itemcode'=>':itemcode', 'vendcode'=>':vendcode']) }}";
                route = route.replace(':flag', 5);
                route = route.replace(':vendcode', vendcode);
                route = route.replace(':itemcode', null);
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

    /*
    | -------------------------------------------------------------
    |  End of Custom Pre-select Select2
    | -------------------------------------------------------------
    */

    function resetFormDoubleMapping(mode1, mode2){
        viewForm('HIDE');
        inputForm('SHOW');

        $('#modal-role-header').html(mode1);
        $('#modal-role-sub_header').html(mode2);
    }

    function resetForm(mode, item_code = null, supplier = null){
        viewForm('HIDE');
        inputForm('SHOW');
        $('#modal-role-name').html(mode);
        $('#form-output').html('');
        $('#modal-form')[0].reset();
        $('#modal-form').attr('action', crud_url);
        preselectItem('#modal-item-code', item_code);
        preselectSupplier('#modal-supplier', supplier);
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

    $('#modal-form').on('submit', function(event){
        event.preventDefault();
        Swal.fire({
            title: 'Save supplier mapping?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        })
        .then((result) => {
            if (result.value) {
                var formData  = $(this).serialize();
                var url = $('#modal-form').attr('action');
                //console.log(url);
                //console.log(formData);
                $.ajax({
                    url: url,
                    method: "GET",
                    data: formData,
                    dataType: "json",
                    success:function(data){
                        //console.log(data);
                        resetForm();
                        if(data.status == 1){
                            $notif = buildNotif('success', data.message);
                            $('#form-output').html($notif);
                            Swal.fire(data.message, "", "success");

                            var delayInMilliseconds = 250;
                            setTimeout(function() {
                                $('#modal-setup-supplier-distribution-form').modal('hide');
                            }, delayInMilliseconds);

                        } else {
                            $notif = buildNotif('danger', data.message);
                            Swal.fire(data.message, "", "danger");
                        }
                        $('#dtMappedRawMaterialWithSupplier').DataTable().ajax.reload();
                    }
                });
            }
        })
    });

</script>

@endpush
