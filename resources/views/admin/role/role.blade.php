@extends('master')

@section('title', 'TMS | Admin - Roles')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">

@endsection


@section('content')          

@include('admin.role.role-modal')
    
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
                    <h4 class="card-header-title">Roles</h4>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="data-tables datatable-dark">
                                <table id="role-datatable" class="table table-striped" style="width:100%">
                                    {{ csrf_field() }}
                                    <thead class="text-center">
                                        <tr>
                                            <th>Role Name</th>
                                            <th>Descriptions</th>
                                            <th>Table Actions</th>
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


<script>

    var add_url     = "{{ route('admin.roles.add') }}";
    var detail_url  = "{{ route('admin.roles.detail', ':id') }}"
    var edit_url    = "{{ route('admin.roles.edit', ':id') }}"
    var delete_url  = "{{ route('admin.roles.delete', ':id') }}"
    
    $(document).ready(function() {
        
        // @@ Load Datatable
        loadDatatable('#role-datatable');

        // 1. Add Button
        $('#add-btn').click(function() {
            resetForm();
            $('#modal-role-form').modal('show');
        });

        // 2. View Button
        $(document).on('click', '.view', function(){
            var id = $(this).attr('role-id');
            getDetail(id, 'VIEW')
        });

        // 3. Edit Button
        $(document).on('click', '.edit', function(){
            var id = $(this).attr('role-id');
            getDetail(id, 'FORM')
        });

        // 4. Delete Button
        $(document).on('click', '.delete', function(){
            var id   = $(this).attr('role-id');
            var name = $(this).attr('role-name');
            var url  = delete_url.replace(':id', id);
            Swal.fire({
                title: 'Delete Role ' + name,
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
                        method: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success:function(data){
                            if(data.status = 1){
                                $('#role-datatable').DataTable().ajax.reload();
                                Swal.fire("Role " + name + " is deleted", "", "success");
                            } else {
                                Swal.fire("Failed to delete Role " + name, "", "warning");
                            }
                            
                        }
                    });
                }
            });
        });

        // 5. Submit Form
        $('#role-form').on('submit', function(event){
            event.preventDefault();
            var formData  = $(this).serialize();
            var url = $('#role-form').attr('action');
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
                    $('#role-datatable').DataTable().ajax.reload();
                }
            });
        });

        
        
    });

    function resetForm(){
        viewForm('HIDE');
        inputForm('SHOW');
        $('#modal-role-name').html('New');
        $('#form-output').html('');
        $('#role-form')[0].reset();
        $('#role-form').attr('action', add_url);
    }

    function inputForm(action){
        if(action == 'SHOW'){
            $('input').show();
            $('textarea').show();
            $('#role-submit').show();
        } else if(action == 'HIDE'){
            $('input').hide();
            $('textarea').hide();
            $('#role-submit').hide();
        }
    }

    function viewForm(action){
        if(action == 'SHOW'){
            $('.form-view').show();
        } else if(action == 'HIDE'){
            $('.form-view').hide();
        }
    }

    function getDetail(id, method){
        var detailURL  = detail_url.replace(':id', id);
        var editURL    = edit_url.replace(':id', id);
        $.ajax({
            url: detailURL,
            method: 'get',
            dataType: 'json',
            success:function(data){
                resetForm();
                if(method == 'FORM') {
                    $('#role-form').attr('action', editURL);
                    $('#modal-role-name').html(data.name);
                    $('#role-id').val(data.id);
                    $('#role-name').val(data.name);
                    $('#role-description').val(data.description);
                } else if(method == 'VIEW') {
                    viewForm('SHOW');
                    inputForm('HIDE');
                    $('#modal-role-name').html(data.name)
                    $('#role-id').val(data.id);
                    $('#role-view-name').html(data.name);
                    $('#role-view-description').html(data.description);
                }
                $('#modal-role-form').modal('show');
            }
        });
    }

    function loadDatatable(id){
        $(id).DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.roles.datatable') }}",
            columnDefs: [
                {"className": "align-left", "targets": [0, 1]},
                {"className": "align-right", "targets": 2},
                {"className": "vertical-center", "targets": "_all"}
            ],
            columns: [
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    }
</script>

@endpush