@extends('master')

@section('title', 'TMS | TTF ENTRY')

@section('css')

<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/Responsive-2.2.5/css/responsive.dataTables.min.css') }}">
<style>
    .invoice{
        cursor: pointer;
    }
    .goodScroll{
        height: 65vh;
        overflow: auto;
    }
    .scrollGood{
        height: 20vh;
        overflow: auto;
    }

    #tes {
        margin-left: 12px;
    }

</style>

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

    <div class="page-title-area">
    <div class="row" >
        <div class="col-1">
            <div class="#">
                <a href="#" class="btn btn-primary btn-round" id="add_form" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                    Show Item
                </a>
            </div>
        </div>
    </div>
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> --}}

    <div class="main-content-inner">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif



    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-header-title">Invoice</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" id="isiInput">

                    </div>
                    <div class="row mt-3" style="height: 35vh;overflow: auto">
                        <div class="col">
                            <div class="data-tables datatable-dark">
                                <table id="tms_MasterItem_Datatable" class="table table-striped" style="width:100%">
                                    {{ csrf_field() }}
                                    <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Inv No</th>
                                            <th>Ref No</th>
                                            <th>Tax No</th>
                                            <th>Kwitansi No</th>
                                            <th>Date</th>
                                            <th>Due</th>
                                            <th>$</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>

                                    <tbody id="ttfArlBody">
                                        {{-- <tr style="text-align:center">
                                                <td colspan="10">Silahkan Ditambahkan</td>

                                            </tr> --}}
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
<div class="modal fade satu" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- data table start -->
                @php
                $tgl=date('d-m-Y');
                @endphp
                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <div class="col-1 mb-2">
                                <label>TTF No</label>
                            </div>
                            <div class="col-1 mb-2">
                                <input type="text" name="ttfNo" class="form-control form-control-sm" id="ttfNo"
                                    aria-describedby="" placeholder="No ttf" disabled>
                            </div>
                            <div class="col-md-9 mb-2 align-right">
                                <label>Operator</label>
                            </div>
                            <div class="col-1 mb-2">
                                <input class="form-control form-control-sm" value="{{ Auth::user()->FullName }}"
                                    name="staff" type="text" id="staff_create_stin" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-1 mb-1">
                                <label>Company</label>
                            </div>
                            <div class="col-2 mb-1">
                                <input type="text" name="custcode" autocomplete="off"
                                    class="form-control form-control-sm" id="custcode">
                            </div>
                            <div class="col-6 mb-1">
                                <input type="text" name="company" autocomplete="off"
                                    class="form-control form-control-sm" id="company" disabled>
                            </div>
                            <div class="col-md-2 mb-1 align-right">
                                <label>Printed</label>
                            </div>
                            <div class="col-1 mb-1">
                                <input class="form-control form-control-sm" name="" type="text" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-1 mb-1">
                                <label>Date</label>
                            </div>
                            <div class="col-2 mb-1">
                                <input type="text" name="date" autocomplete="off" class="form-control form-control-sm" value="<?php echo $tgl; ?>"
                                    id="date" placeholder="YYYY-MM-DD">
                            </div>
                            <div class="col-md-8 mb-1 align-right">
                                <label>Posted</label>
                            </div>
                            <div class="col-1 mb-1">
                                <input class="form-control form-control-sm" name="posted" type="text" id="voided"
                                    disabled>
                            </div>
                            <div class="col-md-11 mb-1 align-right">
                                <label>Voided</label>
                            </div>
                            <div class="col-1 mb-1">
                                <input class="form-control form-control-sm" name="voided" type="text" id="voided"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-1 mb-1">
                                <label>Valas</label>
                            </div>
                            <div class="col-2 mb-1">
                                <input type="text" name="valas" autocomplete="off" value="IDR"
                                    class="form-control form-control-sm" id="valas">
                            </div>
                            <div class="col-md-7 mb-1 align-right">
                                <label>No. of Inv</label>
                            </div>
                            <div class="col-1 mb-1">
                                <input class="form-control form-control-sm" name="" type="text" value="0" disabled>
                            </div>
                            <div class="col-md-1">
                                <label>pcs</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-1 mb-1">
                                <label>Remark</label>
                            </div>
                            <div class="col-4 mb-1">
                                <input type="text" name="remark" autocomplete="off" class="form-control form-control-sm"
                                    id="remark" placeholder="">
                            </div>
                            <div class="col-md-5 mb-1 align-right">
                                <label>Total Amount</label>
                            </div>
                            <div class="col-2 mb-1">
                                <input class="form-control form-control-sm" name="" type="text" id="printed_create_stin"
                                   value="0.00"  disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row scrollGood">
                    <div class="col-12 mt-12">
                        <div class="datatable datatable-primary">
                            <div class="table-responsive">
                                <table id="tbl-detail-stin-create" class="table table-bordered table-striped">
                                    {{-- style="background-color: #D3D3D3" --}}
                                    <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Inv No</th>
                                            <th>Ref No</th>
                                            <th>Tax No</th>
                                            <th>Kwitansi No</th>
                                            <th>Date</th>
                                            <th>Due</th>
                                            <th>$</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyTable">
                                        <tr style="text-align:center" class="tableTtf">
                                            <td><input type="text" style="width:50px;" class="form-control form-control-sm" disabled></td>
                                            <td><input type="text" style="width:150px;" class="form-control form-control-sm" id="invNo"></td>
                                            <td><input type="text" style="width:150px;" class="form-control form-control-sm" id="refNo"></td>
                                            <td><input type="text" style="width:150px;" class="form-control form-control-sm" id="taxNo"></td>
                                            <td><input type="text" style="width:200px;" class="form-control form-control-sm" id="kwNo"></td>
                                            <td><input type="text" style="width:150px;" class="form-control form-control-sm" value="<?= $tgl; ?>"></td>
                                            <td><input type="text" style="width:150px;" class="form-control form-control-sm" id="due"></td>
                                            <td><input type="text" style="width:50px;" class="form-control form-control-sm" id="dollar" value="IDR"></td>
                                            <td><input type="text" style="width:150px;" class="form-control form-control-sm" id="totAmount"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-toggle="tooltip" data-placement="top" title="Add Item" class="btn btn-success"
                    id="addBtn" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-dismiss="modal">New Customer
                    </button>

                {{-- <button type="button" class="btn btn-info" id="addRow" data-bs-dismiss="modal">Add Row</button> --}}
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal">Delete</button> --}}
                <button type="button" class="btn btn-info addStin" id="saveBtn" data-bs-dismiss="modal"><i class="ti-check"></i> Add</button>
                <button type="button" class="btn btn-info" id="editBtn" data-bs-dismiss="modal">Edit</button>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#exampleModal1">Delete</button>
                <button type="button" class="btn btn-info addStin" id="saveRow" data-bs-dismiss="modal"><i class="ti-check"></i> Ok</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade dua" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col">
                <h4 class="header-title">Entry of Invoice Data</h4>
              </div>
          </div>
          <div class="row goodScroll">
              <div class="col-12">
                <table id="tms_MasterItem_Datatable" class="table table-striped" style="width:100%">
                        {{ csrf_field() }}
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Company</th>
                                    <th>Contact</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach($datasInvoices as $data)
                                <tr class="invoice" data-id="{{$data['id']}}" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-dismiss="modal">
                                    <td>{{$i++}}</td>
                                    <td class="tdCustcode">{{$data['custcode']}}</td>
                                    <td>{{$data['company']}}</td>
                                    <td>{{$data['contact']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
              </div>
          </div>
        <!-- data table start -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
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
        // const trS = document.querySelectorAll('.invoice');
        // trS.forEach(tr=>tr.addEventListener('click',function (e) {
        //     console.log(e.target);
        //  }))
    } );
    // const trS = document.querySelectorAll('.invoice');
    //     trS.forEach(tr=>tr.addEventListener('click',function (e) {
    //         console.log(e.target.dataset.id);
    //         $.get('/tms/acc',{
    //             id:e.target.dataset.id
    //         },function (data) {
    //             $("#tms_MasterItem_Datatable").html(data)
    //          })
        //  }))

    // console.log(dataId);



</script>
<script src="{{asset('/js/scriptTtfEntry.js')}}"></script>
@endpush
