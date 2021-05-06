@extends('master')

@section('title', 'TMS | Customer Invoice')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/Responsive-2.2.5/css/responsive.dataTables.min.css') }}">

@endsection

<!-- @section('tms_content_menuHorizontal')
<div class="page-title-area">
    <div class="row" >
        <div class="#">
            <a href="#" class="btn btn-primary btn-round" id="add_form">
                Add Item
            </a>
        </div>
    </div>
</div>
@endsection -->

@section('content')

    @include('tms.__layouts.tms-menuMaster-horizontal')
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> --}}

    <div class="main-content-inner">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div id="form_addItem" >
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Entry of Invoice Data</h4>
                    <form action="/tms/acc/add" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="invoice">Invoice</label>
                            <input type="text" name="invoice" class="form-control" id="invoice   " aria-describedby="emailHelp" placeholder="Enter No Invoice">
                        </div>
                        <div class="form-group">
                            <label for="inv_type">Inv_Type</label>
                            <input type="text" name="inv_type" class="form-control" id="inv_type   " aria-describedby="emailHelp" placeholder="Enter No Inv_Type">
                        </div>
                        <div class="form-group">
                            <label for="ref_no">Ref_No</label>
                            <input type="text" name="ref_no" class="form-control" id="ref_no   " aria-describedby="emailHelp" placeholder="Enter No Ref_No">
                        </div>
                        <div class="form-group">
                            <label for="period">Period</label>
                            <input type="text" name="period" class="form-control" id="period   " aria-describedby="emailHelp" placeholder="Enter No Period">
                        </div>
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" name="company" class="form-control" id="company   " aria-describedby="emailHelp" placeholder="Enter No Company">
                        </div>
                        {{-- <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> --}}
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Invoice</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="data-tables datatable-dark">
                                <table id="tms_MasterItem_Datatable" class="table table-striped" style="width:100%">
                                    {{ csrf_field() }}
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Invoice</th>
                                            <th>Inv_Type</th>
                                            <th>Ref_no</th>
                                            <th>Period</th>
                                            <th>Company</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach($datas as $data)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$data['invoice']}}</td>
                                            <td>{{$data['inv_type']}}</td>
                                            <td>{{$data['ref_no']}}</td>
                                            <td>{{$data['period']}}</td>
                                            <td>{{$data['company']}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>

    <!-- <div id="data_table"> -->
        <!-- data table start -->
        <!-- <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Master Item TMS</h4>
                    <div class="data-tables datatable-dark">
                        <table id="tms_MasterItem_Datatable" class="table table-striped" style="width:100%"> -->
                        <!-- <table id="tms_MasterItem_Datatable"
                            class="table table-striped text-center cell-border display compact"
                            style="width:100%"> -->
                            <!-- <thead class="text-uppercase">
                                <tr>
                                    <th>Item Code</th>
                                    <th>Part Number</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Cust</th>
                                    <th>Group</th>
                                    <th>Type</th>
                                    <th>State</th>
                                    <th>Track</th>
                                    <th>BoM</th>
                                    <th>Unit</th>
                                    <th>Fac_Qty</th>
                                    <th>Fac_Unit</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- data table end -->
    <!-- </div> -->
</div>
<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="MoviedetailmodalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="MoviedetailmodalLabel">Keterangan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('js')

<script src="{{ asset('vendor/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/Datatables/Responsive-2.2.5/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/custom_tms_datatable.js') }}"></script>

<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).ready(function() {
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // JS Function On Load
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        populate_dtItem('#tms_MasterItem_Datatable');

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // JS Function On Other Function Changes
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        $('#add_form').click(function() {
            $('#form_addItem').toggle();
        });

        $('#post_Item').click(function() {
            var email = $('#exampleInputEmail1').val();
            if(email != ''){
                post_entryItem(email);
            } else {
                alert('Fill all fields');
            };
        });

        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // JS Nested Function
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function post_entryItem(email){
            $.ajax({
                type:'POST',
                url:'post_entryItem', //Make sure your URL is correct
                dataType: 'json', //Make sure your returning data type dffine as json
                data:{
                    _token: CSRF_TOKEN,
                    email: email
                },
                success:function(response){
                    if(response == 'success'){
                        Swal.fire("Data posting successfully!", "", "success");
                        $('#form_addItem').toggle();
                        populate_dtItem('#tms_MasterItem_Datatable');
                    } else {
                        Swal.fire("Data posting failed!", "", "warning");
                    }
                }
            });
        };

    } );
</script>
@endpush
