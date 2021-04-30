@extends('master')

@section('title', 'TMS | Warehouse - Products')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">

@endsection

@section('content')          

<div class="main-content-inner">
    
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Products</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="data-tables datatable-dark">
                                <table id="product-datatable" class="table table-striped" style="width:100%">
                                    {{ csrf_field() }}
                                    <thead class="text-center">
                                        <tr>
                                            <th>Item Code</th>
                                            <th>Item Code</th>
                                            <th>State</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Part No.</th>
                                            <th>Customer Code</th>
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

</div>
        
@endsection

@push('js')

<!-- Datatables -->
<script src="{{ asset('vendor/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/Datatables/dataTables.bootstrap4.min.js') }}"></script>


<script>

    $(document).ready(function() {
        // Load Datatable
        loadDatatable('#product-datatable');
    });

    function loadDatatable(id){
        $(id).DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('tms.warehouse.products.datatables') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST"
            },
            order: [[ 0, 'asc']],
            columnDefs: [
                {"targets": [ 0 ], "visible": false},
                {"className": "align-left", "targets": 3},
                {"className": "align-center vertical-center", "targets": "_all"}
            ],
            columns: [
                { data: 'itemcode', name: 'itemcode' },
                { data: 'link-itemcode', name: 'link-itemcode'},
                { data: 'state', name: 'state' },
                { data: 'descript', name: 'descript' },
                { data: 'descript1', name: 'descript1' },
                { data: 'part_no', name: 'part_no' },
                { data: 'custcode', name: 'custcode' }
            ]
        });
    }

    function formatDate (input) {
        if (input !== null) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = datePart[1], day = datePart[2];
            return day+'/'+month+'/'+year;
        } else {
            return null;
        }
    }

</script>

@endpush