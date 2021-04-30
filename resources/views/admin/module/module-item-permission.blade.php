@extends('master')

@section('title', 'TMS | Admin - Modules')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/nestable/nestable.css') }}">

@endsection


@section('content')

@include('admin.module.module-item-permission-modal')
    
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            @php echo $ActionButton @endphp
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Permission ({{ $moduleItem->title }} )</h4>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="dd" id="permission-nestable"></div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>


@endsection

@push('js')
<!-- Nestable -->
<script src="{{ asset('vendor/nestable/jquery.nestable.js') }}"></script>

<script>

    // Global Variable
    var module_id     = "{{ $module->id }}";
    var moduleItem_id = "{{ $moduleItem->id }}";
    var nestable_url = "{{ route('admin.modules.item.permission.nestable', ['id' => ':id', 'item_id' => ':item_id']) }}";
        nestable_url = nestable_url.replace(':id', module_id);        
        nestable_url = nestable_url.replace(':item_id', moduleItem_id);
    var add_url       = "{{ route('admin.modules.item.permission.add', ['id' => ':id', 'item_id' => ':item_id']) }}";
        add_url       = add_url.replace(':id', module_id);        
        add_url       = add_url.replace(':item_id', moduleItem_id);
    var edit_url      = "{{ route('admin.modules.item.permission.edit', ['id' => ':id', 'item_id' => ':item_id', 'permission_id' => ':permission_id']) }}";
        edit_url      = edit_url.replace(':id', module_id);        
        edit_url      = edit_url.replace(':item_id', moduleItem_id);
    var detail_url    = "{{ route('admin.modules.item.permission.detail', ['id' => ':id', 'item_id' => ':item_id', 'permission_id' => ':permission_id']) }}";
        detail_url    = detail_url.replace(':id', module_id);        
        detail_url    = detail_url.replace(':item_id', moduleItem_id);
    var delete_url    = "{{ route('admin.modules.item.permission.delete', ['id' => ':id', 'item_id' => ':item_id', 'permission_id' => ':permission_id']) }}";
        delete_url    = delete_url.replace(':id', module_id);        
        delete_url    = delete_url.replace(':item_id', moduleItem_id);
    var reorder_url   = "{{ route('admin.modules.item.permission.reorder', ['id' => ':id', 'item_id' => ':item_id']) }}";
        reorder_url   = reorder_url.replace(':id', module_id);        
        reorder_url   = reorder_url.replace(':item_id', moduleItem_id);

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    
    $(document).ready(function() {

        // @@ Load Nestable Data
        loadNestable('#permission-nestable');
        
        // 1. Add Button
        $('#add-btn').click(function() {
            resetForm();
            $('#modal-permission-form').modal('show');
        });

        // 2. View Button
        $(document).on('click', '.view', function(){
            var permission_id = $(this).attr('id');
            getDetail(permission_id, 'VIEW');
            $('#modal-permission-form').modal('show');
        });

        // 2. Edit Button
        $(document).on('click', '.edit', function(){
            var permission_id = $(this).attr('id');
            getDetail(permission_id, 'FORM');
            $('#modal-permission-form').modal('show');
        });

        // 3. Delete Button
        $(document).on('click', '.delete', function(){
            var id        = $(this).attr('id');
            var name      = $(this).attr('name');
            var url = delete_url.replace(':permission_id', id);
            Swal.fire({
                title: 'Delete Permission ' + name,
                text: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if(result.value) {
                    $.ajax({
                        url: url,
                        method: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success:function(data){
                            if(data.status = 1){
                                loadNestable('#permission-nestable');
                                Swal.fire("Permission " + name + " is deleted", "", "success");
                            } else {
                                Swal.fire("Failed to delete Permission " + name, "", "warning");
                            }
                        }
                    });
                }
            });
        });

        // 4. Form Submit
        $('#permission-form').on('submit', function(event){
            event.preventDefault();
            var formData  = $(this).serialize();
            var url = $('#permission-form').attr('action');
            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                dataType: "json",
                success:function(data){
                    resetForm();
                    if(data.status = 1){
                        $notif = buildNotif('success', data.message);
                        $('#form-output').html($notif);
                    } else {
                        $notif = buildNotif('danger', data.message);
                    }
                    loadNestable('#permission-nestable');
                }
            });
        });

        // 5. Nestable Onchange Function
        $('#permission-nestable').on('change', function() {
            event.preventDefault();
            var orderData = $(this).nestable('serialize');
            $.ajax({
                url: reorder_url,
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "data": orderData
                },
                dataType: "json",
                success:function(data){
                    if(data.status = 1){
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        });
                    } else {
                        Toast.fire({
                            icon: 'danger',
                            title: data.message
                        });
                    }   
                }
            });
        });
    });

    function resetForm(){
        viewForm('HIDE');
        inputForm('SHOW');
        $('#form-output').html('');
        $('#permission-form').attr('action', add_url);
        $('#modal-permission-name').html('New');
        $('#permission-id').val('');
        $('#permission-name').val('');
        $('#permission-key').val('');
        $('#permission-controller').val('');
        $('#permission-method').val('');
        $('#permission-description').val('');
    }

    function inputForm(action){
        if(action == 'SHOW'){
            $('input').show();
            $("#label-at").css("bottom", "13px");
            $('textarea').show();
            $('#permission-submit').show();
        } else if(action == 'HIDE'){
            $('input').hide();
            $('textarea').hide();
            $("#label-at").css("bottom", "0px");
            $('#permission-submit').hide();
        }
    }

    function viewForm(action){
        if(action == 'SHOW'){
            $('.form-view').show();
            $("#label-at").css("bottom", "13px");
            $('#permission-submit').hide();
        } else if(action == 'HIDE'){
            $('.form-view').hide();
            $("#label-at").css("bottom", "0px");
            $('#permission-submit').show();
        }
    }

    function getDetail(permission_id, method){
        var detailURL  = detail_url.replace(':permission_id', permission_id);
        var editURL    = edit_url.replace(':permission_id', permission_id);
        $.ajax({
            url: detailURL,
            method: 'get',
            dataType: 'json',
            success:function(data){
                if(method == 'FORM') {
                    resetForm();
                    $('#permission-form').attr('action', editURL);
                    $('#modal-permission-name').html(data.key);
                    $('#permission-id').val(data.id);
                    $('#permission-name').val(data.name);
                    $('#permission-key').val(data.key);
                    $('#permission-controller').val(data.controller);
                    $('#permission-method').val(data.method);
                    $('#permission-description').val(data.description);
                } else if(method == 'VIEW') {
                    viewForm('SHOW');
                    inputForm('HIDE');
                    $('#permission-view-name').html(data.name);
                    $('#permission-view-key').html(data.key);
                    $('#permission-view-controller').html(data.controller);
                    $('#permission-view-method').html(data.method);
                    $('#permission-view-description').html(data.description);
                }
            }
        });
    }

    function loadNestable(tagId){
        $.ajax({
            url: nestable_url,
            method: 'get',
            success:function(data){
                $(tagId).html('');        
                $(tagId).html(data);
                $(tagId).nestable();
            }
        });
    }
</script>

@endpush