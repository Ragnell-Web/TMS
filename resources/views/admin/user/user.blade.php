@extends('master')

@section('title', 'TMS | Admin - Users')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">

@endsection


@section('content')           
    
<div class="main-content-inner">
    <!-- <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <a class="btn btn-primary" href=""><i class="ti-plus"></i> Add New</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Users</h4>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="data-tables datatable-dark">
                                <table id="user-datatable" class="table table-striped" style="width:100%">
                                    {{ csrf_field() }}
                                    <thead class="text-center">
                                        <tr>
                                            <th>NIK</th>
                                            <th>Name</th>
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
    
    $(document).ready(function() {
        $('#user-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.users.getDatatables') }}",
            columnDefs: [
                {"className": "align-right", "targets": 2},
                {"className": "vertical-center", "targets": "_all"},
                {"className": "align-left", "targets": [0, 1]}
                
            ],
            columns: [
                { data: 'UserID', name: 'UserID' },
                { data: 'FullName', name: 'FullName' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        $(document).on('click', '.delete', function(){
            var id   = $(this).attr('id');
            var name = $(this).attr('name');
            var url  = "{{ route('admin.modules.delete', ':id') }}";
            url      = url.replace(':id', id);
            Swal.fire({
                title: 'Delete Module ' + name,
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
                                $('#module-datatable').DataTable().ajax.reload();
                                Swal.fire("Module "+name+" is deleted", "", "success");
                            } else {
                                Swal.fire("Failed to delete Module "+name, "", "warning");
                            }
                            
                        }
                    });
                }
            });
        });
        
    });
</script>

@endpush