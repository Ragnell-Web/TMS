@extends('master')

@section('title', 'TMS | Admin - Modules')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/nestable/nestable.css') }}">

@endsection



@section('content')           

@include('admin.module.module-item-modal')

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
                    <h4 class="card-header-title">Module Builder ({{ $module->name }})</h4>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="dd" id="nestable">
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
<!-- Nestable -->
<script src="{{ asset('vendor/nestable/jquery.nestable.js') }}"></script>


<script>

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

        /*  
        | -------------------------------------------------------------------
        | NESTABLE
        | -------------------------------------------------------------------
        */

        // 1. Load Nestable Data
        loadNestable('#nestable');
        
        // 3. Nestable Onchange Function
        $('#nestable').on('change', function() {
            event.preventDefault();
            var module_id = "{{ $module->id }}";
            var orderData = $(this).nestable('serialize');
            var url       = "{{ route('admin.modules.item.reorder', ':id') }}";
                url       = url.replace(':id', module_id);
            $.ajax({
                url: url,
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

        /*  
        | -------------------------------------------------------------------
        | MODAL
        | -------------------------------------------------------------------
        */
        $('#add-btn').click(function() {
            $('#modal-item-name').html('New');
            $('#modal-item-form').modal('show');
            resetForm();
        });

        $('#item-icon').bind('input', function() {
            $('#icon-preview').removeClass();
            $('#icon-preview').addClass($(this).val());
        });

        // 1. Add or Edit
        $('#item-form').on('submit', function(event){
            event.preventDefault();
            var formData  = $(this).serialize();
            var itemID    = $('#item-id').val()
            var module_id = "{{ $module->id }}";

            if(itemID == ''){
                var url   = "{{ route('admin.modules.item.add', ':id') }}";
                url       = url.replace(':id', module_id);
            } else {
                var url   = "{{ route('admin.modules.item.edit', ':id') }}";
                url       = url.replace(':id', module_id);
            }
            
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
                    loadNestable('#nestable');
                }
            });
        });

        $(document).on('click', '.edit', function(){
            var module_id = "{{ $module->id }}";
            var item_id   = $(this).attr('item-id');
            var url       = "{{ route('admin.modules.item.detail', ['id' => ':id', 'item_id' => ':item_id']) }}";
                url       = url.replace(':id', module_id);
                url       = url.replace(':item_id', item_id);
            $.ajax({
                url: url,
                method: 'get',
                dataType: 'json',
                success:function(data){
                    resetForm();
                    $('#modal-item-name').html(data.title);
                    $('#item-id').val(data.id);
                    $('#item-title').val(data.title);
                    $('#item-url').val(data.url);
                    $('#item-icon').val(data.icon_class);
                    $('#icon-preview').addClass(data.icon_class);
                    $('#modal-item-form').modal('show');
                }
            });
        });

        // 2. Delete
        $(document).on('click', '.delete', function(){
            var module_id = "{{ $module->id }}";
            var item_id   = $(this).attr('item-id');
            var name      = $(this).attr('name');
            var url       = "{{ route('admin.modules.item.delete', ['id' => ':id', 'item_id' => ':item_id']) }}";
                url       = url.replace(':id', module_id);
                url       = url.replace(':item_id', item_id);
            Swal.fire({
                title: 'Delete ' + name,
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
                            "id": item_id
                        },
                        success:function(data){
                            if(data.status = 1){
                                loadNestable('#nestable');
                                Swal.fire(data.message, "", "success");
                            } else {
                                Swal.fire(data.message, "", "warning");
                            }
                        }
                    });
                }
            });
        });

    });

    /*  
    | -------------------------------------------------------------------
    | FUNCTION
    | -------------------------------------------------------------------
    */
    function loadNestable(tagId){
        var id   = "{{ $module->id }}";
        var url  = "{{ route('admin.modules.item.nestable', ':id') }}";
        url      = url.replace(':id', id);
        $.ajax({
            url: url,
            method: 'get',
            success:function(data){
                $(tagId).html('');        
                $(tagId).html(data);
                $(tagId).nestable();
            }
        });
    }

    function resetForm(){
        $('#form-output').html('');
        $('#item-id').val('');
        $('#item-title').val('');
        $('#item-url').val('');
        $('#item-icon').val('');
        $('#icon-preview').removeClass();
    }

</script>

@endpush